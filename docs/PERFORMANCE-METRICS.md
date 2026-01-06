# Performance Metrics - Malarz Trzebnica

## Core Web Vitals Targets

### LCP (Largest Contentful Paint)
**Target:** < 2.5s  
**Optymalizacja:**
- Lazy loading obrazów
- CDN dla static assets
- Server-side caching

### FID (First Input Delay)
**Target:** < 100ms  
**Optymalizacja:**
- Defer non-critical JavaScript
- Code splitting
- Reduce JavaScript execution time

### CLS (Cumulative Layout Shift)
**Target:** < 0.1  
**Optymalizacja:**
- Set width/height dla obrazów
- Reserve space dla dynamic content
- Use transform zamiast top/left

## Lighthouse Scores Goals

- **Performance:** > 90
- **Accessibility:** > 90
- **Best Practices:** > 90
- **SEO:** > 90

## Monitoring

```bash
# Local testing
npx lighthouse https://www.malarz.trzebnica.pl --view

# CI/CD (w GitHub Actions)
# Zobacz .github/workflows/lighthouse-ci.yml
```

## Optimization Checklist

- [ ] Images optimized (WebP format)
- [ ] CSS/JS minified
- [ ] Gzip compression enabled
- [ ] Browser caching configured
- [ ] CDN setup (opcjonalnie)
- [ ] Database queries optimized
- [ ] PHP opcache enabled

---
**Malarz Trzebnica** - Precyzja, Perfekcja, Profesjonalizm
