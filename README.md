# Digital CV Application (Laravel)

A **production-ready, single-page digital résumé application** built with **Laravel 12**.
This project demonstrates **clean architecture, SOLID principles, and practical backend decision-making** using a deliberately small but real-world problem domain.

---

## Why This Project

This application is not about displaying a CV - it’s about showing:

* how I structure maintainable Laravel applications
* how I separate business logic from infrastructure
* how I design for testability and future change
* how I make pragmatic technical trade-offs

The scope is intentionally small so architecture and code quality are easy to evaluate.

---

## What It Does

* Renders a single-page digital CV
* Loads content from **Markdown + JSON**
* Converts Markdown to HTML server-side
* Caches processed content for performance
* Exports the CV as a **print-optimized PDF**
* Works without a database

---

## Architecture Highlights

* **Service-oriented design** (`CvService`)
* **Dependency inversion** via interfaces
* Markdown and PDF engines are **swappable**
* Framework concerns stay at the edges
* Business logic is easy to test in isolation

```
Controller → CvService → Interfaces → Infrastructure
```

---

## Technology Stack

* **Backend:** Laravel 12 (PHP 8.2+)
* **Rendering:** Blade (SSR)
* **Styling:** Tailwind CSS (web), custom print CSS (PDF)
* **Markdown:** CommonMark (via interface)
* **PDF:** DomPDF (adapter-based)
* **Testing:** Pest (unit + feature)
* **Data:** File-based (JSON + Markdown)

---

## Testing Approach

* Feature tests cover HTTP behavior and PDF download
* Unit tests focus on business logic
* External libraries are mocked behind interfaces
* Tests are fast, deterministic, and refactor-safe

---

## Design Principles Demonstrated

* SOLID without over-engineering
* Clear separation of concerns
* Content-first design
* Testability as a first-class concern
* Simplicity over unnecessary abstractions

---

## Intended Audience

* Recruiters evaluating backend skill
* Engineers reviewing architectural decisions
* Teams looking for clean Laravel examples

---

## Final Note

This project is intentionally small, but intentionally **well-engineered**.
It reflects how I approach real production systems: **clarity, maintainability, and long-term thinking**.

## 🛠️ Local Development Setup

1) Clone and enter the project:

```bash
git clone https://github.com/jombastic/cv
cd cv
```

2) Install PHP dependencies:

```bash
composer install
```

3) Configure environment:

```bash
cp .env.example .env
php artisan key:generate
```

4)  Install Frontend Dependencies & Build Assets

```bash
npm install
npm run build
```

5) Serve locally:

```bash
composer run dev
```
