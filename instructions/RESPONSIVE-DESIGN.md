# Responsive Design - Malarz Trzebnica PHP

## Bootstrap Breakpoints

| Breakpoint | Viewport | Class Infix |
|------------|----------|-------------|
| Extra small | <576px | - |
| Small | ≥576px | sm |
| Medium | ≥768px | md |
| Large | ≥992px | lg |
| Extra large | ≥1200px | xl |
| XXL | ≥1400px | xxl |

## Mobile-First Approach

```css
/* Base styles (mobile) */
.header {
  padding: 10px;
}

/* Tablet and up */
@media (min-width: 768px) {
  .header {
    padding: 20px;
  }
}

/* Desktop */
@media (min-width: 1200px) {
  .header {
    padding: 30px;
  }
}
```

## Testing

- Chrome DevTools Device Mode
- BrowserStack
- Real devices (iPhone, Android)

---
**Malarz Trzebnica** - Precyzja, Perfekcja, Profesjonalizm
