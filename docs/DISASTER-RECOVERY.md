# Disaster Recovery Plan - Malarz Trzebnica

## Scenariusze Awaryjne

### 1. Awaria Serwera

**Objawy:** Strona nie odpowiada, błąd 500/503

**Działania:**
1. Sprawdź status serwera (hosting panel)
2. Sprawdź logi Apache/PHP
3. Restart serwisu web (jeśli masz dostęp)
4. Kontakt z hosting support

**Czas odzysku:** < 30 min

### 2. Zhackowana Strona

**Objawy:** Podejrzane przekierowania, zmieniona treść

**Działania:**
1. Odetnij dostęp (zmień hasła FTP/cPanel)
2. Przywróć z backup
3. Scan malware (ClamAV, Wordfence)
4. Zaktualizuj wszystkie dependencies
5. Wzmocnij security headers

**Czas odzysku:** < 4h

### 3. Utrata Danych

**Objawy:** Brak plików, usunięta baza danych

**Działania:**
1. Sprawdź ostatni backup (`.github/workflows/backup.yml`)
2. Przywróć z backup: `bash scripts/restore.sh backup_file.tar.gz`
3. Weryfikuj integralność danych
4. Test wszystkich funkcjonalności

**Czas odzysku:** < 2h

### 4. Błąd w Kodzie (po deploy)

**Objawy:** Strona nie działa po wdrożeniu

**Działania:**
1. Git revert do poprzedniego commita
2. Redeploy poprzedniej wersji
3. Debuguj na środowisku local/staging
4. Fix i redeploy

**Czas odzysku:** < 15 min

## Backupy

### Automatyczne (GitHub Actions)

- **Częstotliwość:** Co tydzień (niedziela 02:00)
- **Retencja:** 30 dni
- **Lokalizacja:** GitHub Artifacts

### Manualne

```bash
# Backup plików
bash scripts/backup.sh

# Backup bazy (jeśli używana)
mysqldump -u root -p malarz_trzebnica > backup.sql
```

## Kontakty Awaryjne

**Hosting Support:**  
Email: support@hosting.pl  
Telefon: +48 XX XXX XXXX

**Developer:**  
Email: dev@malarz.trzebnica.pl  
Telefon: +48 452 690 824

---
**Malarz Trzebnica** - Precyzja, Perfekcja, Profesjonalizm
