# Configurazione MariaDB e phpMyAdmin con Docker su NixOS

Dockerfile e docker-compose.yml presi da [qui](https://github.com/br0kenpixel/xampp2docker)
e personalizzati per funzionare "out of the box" su Project IDX (NixOS).

## Obiettivo
Configurare un ambiente di sviluppo cloud per web-app con MariaDB e phpMyAdmin utilizzando Docker, assicurando che:
- Il DB sia accessibile da remoto con PHPMyAdmin.
- L'ambiente funzioni correttamente su NixOS.
- Sia possibile accedere a qualsiasi risorsa presente nel server accedendo alla specifica porta (3000).

Nota: potrebbe essere necessario rendere pubblici i link di accesso nella sezione "Backend Ports".

## Modifiche principali

### 1. **File `dev.nix`**
Il file `dev.nix` è stato configurato per:
- Installare Docker e Docker Compose.
- Abilitare il servizio Docker.
- Eseguire uno script personalizzato all'avvio del workspace per configurare MariaDB.

### 2. **Script `setup-mariadb.sh`**
Questo script:
1. Rimuove e ricrea la directory `mariadb_run` per evitare conflitti con i permessi di MariaDB.
2. Avvia i container definiti in `docker-compose.yml`.
3. Configura MariaDB per accettare connessioni da qualsiasi host (`%`).
4. Configura Apache per servire anche file senza estensione php (utile per alcuni progetti, ad esempio link shortener) trasferendo il file `.htaccess`.

### 3. **File di configurazione `Docker`**
- `docker-compose.yml` è stato adattato per consentire l'avvio di MariaDB ed evitare problemi di permessi su NixOS (cartella `mariadb_run`)
- `Dockefile` è stato modificato per installare il gestore pacchetti di PHP (composer)

## Integrazione con Github
Se il push automatico fallisce, loggarsi manualmente da terminale con `gh auth login`, e successivamente dare `git push` sempre dalla shell.
Può essere d'aiuto resettare l'istanza dopo aver eseguito il login da terminale.

## Troubleshooting

### Corrupted MariaDB `tc.log`
**Sintomo:** Il container del database (`db`) si riavvia in un ciclo infinito, impedendo l'avvio completo dell'ambiente. I log del container mostrano un errore `Bad magic header in tc log`.

**Causa:** Il file di log delle transazioni di MariaDB (`tc.log`), situato nella cartella `mariadb_data`, è corrotto. Questo file è essenziale per il ripristino del database dopo un crash, e la sua corruzione impedisce a MariaDB di avviarsi.

**Soluzione:** Il file `tc.log` corrotto deve essere eliminato. Poiché l'ambiente Project IDX non fornisce l'accesso `sudo`, non è possibile eliminare il file direttamente a causa dei permessi. La soluzione consiste nell'utilizzare un container temporaneo per eliminare il file:

1.  **Arrestare i servizi:**
    ```bash
    docker-compose down
    ```
2.  **Eliminare il file `tc.log` corrotto:**
    ```bash
    docker run --rm -v $(pwd)/mariadb_data:/data alpine rm /data/tc.log
    ```
3.  **Riavviare i servizi:**
    ```bash
    docker-compose up -d
    ```

Questo processo rimuove in modo sicuro il file corrotto senza intaccare gli altri dati del database, consentendo a MariaDB di avviarsi e ricreare un file di log pulito.