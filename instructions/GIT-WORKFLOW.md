# Git Workflow - Malarz Trzebnica PHP

> **Przewodnik po strategii kontroli wersji i Git workflow dla projektu**

## Branch Strategy

### Model GitFlow Simplified

```
main (produkcja) → www.malarz.trzebnica.pl
  ↑
develop (deweloperska)
  ↑
feature/* (nowe funkcjonalności)
bugfix/* (poprawki błędów)
hotfix/* (pilne poprawki produkcyjne)
```

## Commit Guidelines

### Conventional Commits

Format: `type(scope): description`

**Typy Commitów:**
- `feat` - Nowa funkcjonalność
- `fix` - Poprawka błędu
- `docs` - Dokumentacja
- `style` - Formatowanie, CSS
- `refactor` - Refaktoryzacja
- `test` - Dodanie testów
- `chore` - Konfiguracja, deps
- `perf` - Optymalizacja

**Przykłady:**
```bash
git commit -m "feat(contact): Add email validation"
git commit -m "fix(gallery): Correct lightbox z-index"
git commit -m "docs(readme): Update installation steps"
```

## Pull Request Process

1. **Przygotowanie PR**
```bash
git checkout feature/my-feature
git rebase origin/develop
git push origin feature/my-feature --force-with-lease
```

2. **Code Review** - wymagane minimum 1 approval

3. **Merge** - Squash and Merge preferowane

## Best Practices

✅ **DO:**
- Commit often - małe, atomowe commity
- Pull before push
- Descriptive branch names
- Test before push

❌ **DON'T:**
- Nie commituj do main bezpośrednio
- Nie pushuj credentials
- Nie force push do main/develop

---

**Malarz Trzebnica** - Precyzja, Perfekcja, Profesjonalizm
