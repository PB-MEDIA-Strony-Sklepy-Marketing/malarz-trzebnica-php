# Agenci AI - Malarz Trzebnica PHP

> Przewodnik po agentach AI wspierajacych rozwoj projektu

## Wprowadzenie

Ten katalog zawiera definicje agentow AI zoptymalizowanych do pracy z projektem strony internetowej firmy Malarz Trzebnica. Agenci zostali skonfigurowani do wsparcia roznych aspektow rozwoju - od generowania kodu PHP, przez optymalizacje SEO, po tworzenie dokumentacji.

## Szybki Przeglad Platform AI

| Platforma | Plik Konfiguracyjny | Zastosowanie |
|-----------|---------------------|--------------|
| Claude (Anthropic) | [CLAUDE.md](CLAUDE.md) | Glowny asystent rozwoju, architektura MVC |
| Ollama (lokalne) | [OLLAMA.md](OLLAMA.md) | Praca offline, szybkie operacje |
| Qwen (Alibaba) | [QWEN.md](QWEN.md) | Alternatywny model, wsparcie wielojezyczne |
| GitHub Copilot | [GITHUB-COPILOT.md](GITHUB-COPILOT.md) | Autouzupelnianie kodu w IDE |
| Cursor IDE | [CURSOR.md](CURSOR.md) | Zintegrowane srodowisko z AI |

## Katalog Agentow Specjalistycznych

### Rozwoj i Kod (Development)

| Agent | Specjalizacja | Model |
|-------|---------------|-------|
| `4.1-Beast.agent.md` | Autonomiczne rozwiazywanie zlozonych problemow | GPT-4.1 |
| `gpt-5-beast-mode.agent.md` | Beast Mode 2.0 - zaawansowane zadania | GPT-5 |
| `Thinking-Beast-Mode.agent.md` | Zaawansowany tryb myslenia | Claude |
| `debugger.md` | Analiza bledow i root cause analysis | haiku |
| `tdd-refactor.agent.md` | Refaktoryzacja TDD, bezpieczenstwo | sonnet |
| `frontend-developer.md` | React/Vue/Angular, dostepnosc | sonnet |
| `architect-review.md` | Architektura, mikrouslugi, DDD | sonnet |

### Infrastruktura i DevOps

| Agent | Specjalizacja | Model |
|-------|---------------|-------|
| `deployment-engineer.md` | CI/CD, GitOps, automatyzacja | sonnet |
| `terraform-specialist.md` | Terraform/OpenTofu, IaC | sonnet |
| `dx-optimizer.md` | Developer Experience, narzedzia | haiku |
| `playwright-tester.agent.md` | Testowanie E2E z Playwright | haiku |

### Dokumentacja i API

| Agent | Specjalizacja | Model |
|-------|---------------|-------|
| `api-documenter.md` | OpenAPI 3.1, portale developerskie | sonnet |
| `docs-architect.md` | Dokumentacja techniczna | sonnet |
| `reference-builder.md` | Referencje techniczne, API docs | sonnet |
| `tutorial-engineer.md` | Tutoriale, materialy edukacyjne | sonnet |
| `mermaid-expert.md` | Diagramy Mermaid (ERD, flowcharts) | haiku |

### SEO i Content Marketing

| Agent | Specjalizacja | Model |
|-------|---------------|-------|
| `seo-keyword-strategist.md` | Strategia slow kluczowych | haiku |
| `seo-content-planner.md` | Planowanie tresci SEO | haiku |
| `seo-content-writer.md` | Pisanie tresci zoptymalizowanych | sonnet |
| `seo-content-auditor.md` | Audyt tresci, E-E-A-T | sonnet |
| `seo-content-refresher.md` | Odswiezanie tresci | haiku |
| `seo-meta-optimizer.md` | Optymalizacja meta tagow | haiku |
| `seo-structure-architect.md` | Architektura tresci | haiku |
| `seo-cannibalization-detector.md` | Wykrywanie kanibalizacji | haiku |
| `seo-authority-builder.md` | Budowanie autorytetu | haiku |
| `seo-snippet-hunter.md` | Optymalizacja snippetow | haiku |
| `search-ai-optimization-expert.agent.md` | AI-powered SEO | sonnet |

### Content i Marketing

| Agent | Specjalizacja | Model |
|-------|---------------|-------|
| `content-creator.md` | Tworzenie tresci cross-platform | sonnet |
| `content-marketer.md` | Strategia content marketingu | sonnet |
| `search-specialist.md` | Research webowy, analiza | haiku |

### Prompt Engineering

| Agent | Specjalizacja | Model |
|-------|---------------|-------|
| `prompt-engineer.agent.md` | Analiza i ulepszanie promptow | sonnet |
| `prompt-builder.agent.md` | Tworzenie promptow | sonnet |
| `generate-copilot-instructions.md` | Instrukcje dla Copilot | haiku |

## Zastosowanie w Projekcie Malarz Trzebnica

### Scenariusze Uzycia

#### 1. Rozwoj PHP MVC
```
Agenci: architect-review.md, tdd-refactor.agent.md, debugger.md
Zadania:
- Projektowanie architektury kontrolerow
- Refaktoryzacja widokow PHP
- Debugowanie formularza kontaktowego
```

#### 2. Optymalizacja SEO
```
Agenci: seo-keyword-strategist.md, seo-meta-optimizer.md, seo-content-writer.md
Zadania:
- Slowa kluczowe: "malarz Trzebnica", "uslugi malarskie"
- Optymalizacja meta tagow dla kazdej podstrony
- Tresci zoptymalizowane pod lokalne SEO
```

#### 3. Dokumentacja Projektu
```
Agenci: docs-architect.md, api-documenter.md, tutorial-engineer.md
Zadania:
- Dokumentacja architektury MVC
- Instrukcje instalacji i konfiguracji
- Przewodniki dla uzytkownikow
```

#### 4. Frontend i UX
```
Agenci: frontend-developer.md, dx-optimizer.md
Zadania:
- Optymalizacja Bootstrap/JavaScript
- Poprawa dostepnosci (WCAG)
- Wydajnosc ladowania strony
```

#### 5. Deployment i CI/CD
```
Agenci: deployment-engineer.md, terraform-specialist.md
Zadania:
- GitHub Actions workflows
- Automatyzacja deploymentu FTP/SSH
- Backup i monitoring
```

## Format Plikow Agentow

Kazdy plik agenta uzywa formatu YAML frontmatter:

```yaml
---
name: nazwa-agenta
description: Krotki opis specjalizacji
model: haiku|sonnet|GPT-4.1|GPT-5
---

# Zawartosc agenta

## Expert Purpose
Szczegolowy opis roli agenta...

## Capabilities
- Zdolnosc 1
- Zdolnosc 2

## Approach
1. Krok 1
2. Krok 2
```

## Modele AI - Wybor

### haiku (lekki)
- Szybkie, proste zadania
- Niski koszt/latencja
- Uzywaj dla: keyword analysis, meta tags, quick fixes

### sonnet (sredni)
- Zlozone zadania wymagajace rozumowania
- Balans miedzy jakoscia a kosztem
- Uzywaj dla: architektura, content writing, audyty

### GPT-4.1 / GPT-5 (zaawansowany)
- Autonomiczne rozwiazywanie zlozonych problemow
- Beast mode dla trudnych zadan
- Uzywaj dla: refaktoryzacja calych modulow, debugging zlozonych bledow

## Integracja z Projektem

### Struktura Katalogow
```
malarz-trzebnica-php/
├── agents/                    # Lokalne kopie agentow
│   ├── AGENTS.md             # Ten plik
│   ├── CLAUDE.md             # Instrukcje Claude
│   ├── OLLAMA.md             # Instrukcje Ollama
│   ├── QWEN.md               # Instrukcje Qwen
│   ├── GITHUB-COPILOT.md     # Instrukcje Copilot
│   ├── CURSOR.md             # Instrukcje Cursor
│   └── *.agent.md            # Agenci specjalistyczni
│
└── .github/
    └── agents/               # Kopie dla GitHub (identyczne)
```

### Synchronizacja
Pliki w `agents/` i `.github/agents/` sa zsynchronizowane. Edytuj w jednym miejscu i skopiuj do drugiego.

## Wskazowki Praktyczne

### Wybor Agenta
1. **Proste zadanie** → haiku agent
2. **Zlozone zadanie** → sonnet agent
3. **Autonomiczne rozwiazywanie** → Beast mode agent

### Laczenie Agentow
Dla zlozonych zadan mozesz laczyc agentow:
```
1. architect-review.md → Zaprojektuj architekture
2. tdd-refactor.agent.md → Zaimplementuj z testami
3. docs-architect.md → Udokumentuj rozwiazanie
4. seo-meta-optimizer.md → Zoptymalizuj pod SEO
```

### Kontekst Projektu
Zawsze podawaj agentowi kontekst:
- Nazwa projektu: Malarz Trzebnica
- Technologie: PHP 7.4+, Bootstrap 5, jQuery
- Architektura: MVC w katalogu dist/
- Jezyk tresci: Polski
- Domena: www.malarz.trzebnica.pl

## Aktualizacje

Ostatnia aktualizacja: Styczen 2025

Lista zmian:
- Dodano 33 agentow specjalistycznych
- Skonfigurowano agentow dla PHP MVC
- Dodano agentow SEO dla lokalnego pozycjonowania
- Zintegrowano z GitHub Copilot i Cursor IDE

---

**Malarz Trzebnica** - Precyzja, Perfekcja, Profesjonalizm
