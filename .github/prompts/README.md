# 🤖 AI Prompts Collection

This directory contains specialized prompts for AI-assisted development, testing, and auditing of the Kancelaria Adwokacka Katarzyna Maj website.

## 📁 New Project-Specific Prompts

### [code-review-prompt.md](./code-review-prompt.md)
**Purpose:** AI-assisted PHP code review  
**Size:** ~13KB  
**For:** PHP 8.4, PSR-12 compliance  
**Covers:**
- Architecture and structure validation
- PSR-12 coding standard compliance
- OWASP Top 10 security checks
- PHP 8.4 best practices (strict types, match expressions, named arguments)
- Code quality, performance, testability
- Documentation standards

**Use when:** Reviewing pull requests, validating new code, ensuring code quality

---

### [seo-audit-prompt.md](./seo-audit-prompt.md)
**Purpose:** Comprehensive SEO audit  
**Size:** ~14KB  
**For:** Local legal services website  
**Covers:**
- Keyword research and strategy validation
- On-page SEO (titles, meta descriptions, headings, URLs)
- Technical SEO (performance, mobile, HTTPS, sitemap, schema)
- Local SEO (Google My Business, citations, NAP consistency)
- Off-page SEO and backlink analysis
- Competitor analysis

**Use when:** Auditing SEO performance, optimizing pages, planning content strategy

---

### [accessibility-prompt.md](./accessibility-prompt.md)
**Purpose:** WCAG 2.2 Level AA compliance check  
**Size:** ~13KB  
**Standard:** WCAG 2.2 Level AA  
**Covers:**
- WCAG POUR principles (Perceivable, Operable, Understandable, Robust)
- Alt text, color contrast, keyboard navigation
- Form accessibility, focus indicators
- ARIA implementation
- Screen reader compatibility
- Component-specific checks (nav, forms, modals)

**Use when:** Testing accessibility, before deployment, ensuring compliance

---

### [security-prompt.md](./security-prompt.md)
**Purpose:** Security vulnerability assessment  
**Size:** ~23KB  
**Standard:** OWASP Top 10 2021, RODO/GDPR  
**Covers:**
- Complete OWASP Top 10 checklist
- XSS, CSRF, SQL injection prevention
- Contact form security (rate limiting, validation)
- Input validation and sanitization
- Session security, error handling
- Security headers, logging
- RODO/GDPR compliance

**Use when:** Security audits, before deployment, reviewing forms and user input handling

---

## 🎯 How to Use These Prompts

### With GitHub Copilot
1. Open the prompt file
2. Copy the entire content or relevant sections
3. Paste into GitHub Copilot chat
4. Ask Copilot to review your code/page using the prompt
5. Follow the recommendations

### With Claude/ChatGPT
1. Start a new conversation
2. Paste the prompt content
3. Provide the code/page to review
4. Receive detailed analysis and recommendations

### As a Checklist
Use the prompts as comprehensive checklists for:
- Manual code reviews
- Pre-deployment testing
- Quality assurance

---

## 📊 Prompt Categories

### Code Quality
- [code-review-prompt.md](./code-review-prompt.md) - PHP code review

### SEO & Content
- [seo-audit-prompt.md](./seo-audit-prompt.md) - SEO optimization

### Accessibility
- [accessibility-prompt.md](./accessibility-prompt.md) - WCAG compliance

### Security
- [security-prompt.md](./security-prompt.md) - Security assessment

---

## 🔄 Using Prompts in CI/CD

You can integrate these prompts into your CI/CD pipeline:

```yaml
# Example GitHub Action
- name: AI Code Review
  run: |
    # Use GitHub Copilot CLI or API
    gh copilot review --prompt .github/prompts/code-review-prompt.md
```

---

## 📝 Best Practices

1. **Read the entire prompt** before using it to understand the scope
2. **Adapt as needed** - prompts are templates, customize for specific needs
3. **Combine prompts** - use multiple prompts for comprehensive review
4. **Document results** - save AI responses for future reference
5. **Iterate** - use prompts multiple times during development

---

## 🆕 Creating New Prompts

When creating new prompts:
1. Start with a clear purpose and scope
2. Use markdown formatting for readability
3. Include checklists for systematic review
4. Provide examples (good vs bad)
5. Add AI instructions at the end
6. Include version and last updated date

---

## 🔄 Maintenance

**Update Frequency:**
- **code-review-prompt.md:** When PHP version or standards change
- **seo-audit-prompt.md:** Quarterly (as SEO best practices evolve)
- **accessibility-prompt.md:** When WCAG updates
- **security-prompt.md:** When new OWASP Top 10 is released

---

**Last Updated:** 2024-12-15  
**Version:** 1.0.0  
**Owner:** Kancelaria Adwokacka Katarzyna Maj
