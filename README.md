# BookLoop

Universitet daxilində fiziki “Götür–Qoy” BookPoint rəflərini aktivləşdirən web-first platformadır.

> **Cari vəziyyət:** README docs/readme-onboarding branch-ində hazırlanır. Laravel foundation faylları hazırda feature/foundation branch-indədir. Foundation develop-ə merge olunandan sonra aşağıdakı addımlar develop üzərində işləyəcək. Bu branch-də Laravel faylları yoxdursa, əvvəlcə foundation Pull Request-inin merge olunmasını gözləyin.

## Mündəricat

- [BookLoop nədir?](#bookloop-nədir)
- [MVP statusu](#mvp-statusu)
- [Texnologiyalar](#texnologiyalar)
- [Başlamazdan əvvəl](#başlamazdan-əvvəl)
- [Repository-ni yükləmək](#repository-ni-yükləmək)
- [İlk quraşdırma](#ilk-quraşdırma)
- [Database](#database)
- [Gündəlik Git prosesi](#gündəlik-git-prosesi)
- [Git terminləri](#git-terminləri)
- [Komanda bölgüsü](#komanda-bölgüsü)
- [Codex ilə işləmək](#codex-ilə-işləmək)
- [Test və troubleshooting](#test-və-troubleshooting)
- [Təhlükəsizlik](#təhlükəsizlik)
- [İlk gün checklist](#ilk-gün-checklist)
- [Faydalı sənədlər](#faydalı-sənədlər)

## BookLoop nədir?

BookLoop kitabxana idarəetmə sistemi deyil. Universitetdəki fiziki BookPoint rəflərini tələbələr arasında paylaşım platforması ilə əlaqələndirir.

Axın: fiziki BookPoint mövcud olur; kitaba unikal sticker ID və QR kod verilir; tələbə kitabı rəfə əlavə edir; başqa tələbə kitabı götürür; kitab istənilən aktiv BookPoint-ə qoyula bilər; hərəkətlər tarixçədə saxlanılır; wishlist, bildiriş, coin və XP iştirakçılığı dəstəkləyir.

Bütün funksiyalar hələ hazır deyil. Take/put, QR scanner, wishlist notification, reminder, reward logic və admin CRUD foundation-dan sonrakı işlərdir.

## MVP statusu

feature/foundation branch-indəki foundation:

- Laravel 12, Blade, Tailwind, Vite və Livewire;
- registration, login, logout və qorunan dashboard;
- User, Book, BookCopy, BookPoint, Sticker, BookMovement, Wishlist, CoinTransaction və XpTransaction modelləri;
- migration, foreign key, index, relationship və uniqueness qaydaları;
- deterministic seed data və PHPUnit foundation testləri;
- docs/ daxilində architecture, database, setup, Git workflow, ownership və API contract.

Hələ tamamlanmayıb: take/put Actions və Services, BookPoint CRUD, sticker/QR axını, wishlist matching, notifications, 10 günlük reminder, Coin/XP qaydaları, Filament admin və production PWA.

## Texnologiyalar

| Texnologiya | İzah |
|---|---|
| PHP | Laravel-in proqramlaşdırma dili. |
| Laravel 12 | Routing, authentication, migrations, testing və backend skeleti. |
| Composer | PHP dependency-lərinin quraşdırıcısı. |
| PostgreSQL | Tövsiyə olunan əsas database. |
| SQLite | Lokal/test fallback database. |
| Blade | Server-side HTML template sistemi. |
| Livewire | Blade üçün interaktiv komponentlər; dependency kimi quraşdırılıb. |
| Tailwind CSS | CSS class-ları ilə responsive dizayn. |
| Alpine.js | Hazırkı package.json-da yoxdur; planlaşdırıla bilər. |
| Vite | CSS və JavaScript build aləti. |
| Node.js/npm | Frontend dependency və build mühiti. |
| Git/GitHub | Tarixçə, branch, review və Pull Request. |

Əlavə dependency uydurma; əvvəl composer.json və package.json-a bax.

## Başlamazdan əvvəl

Windows üçün quraşdır: [Git](https://git-scm.com/download/win), [PHP](https://windows.php.net/download/), [Composer](https://getcomposer.org/download/), [Node.js LTS](https://nodejs.org/en/download), [PostgreSQL](https://www.postgresql.org/download/windows/) və [VS Code](https://code.visualstudio.com/download).

Faydalı VS Code extension-ları: PHP Intelephense, Laravel Blade Snippets, Tailwind CSS IntelliSense, DotENV və GitLens.

PowerShell-də yoxla:

    git --version
    php -v
    composer --version
    node -v
    npm -v

not recognized xətası proqramın quraşdırılmadığını və ya PATH-ə əlavə edilmədiyini göstərir. Installer-də Add to PATH seçimini yoxla, PowerShell-i bağla və yenidən aç. npm üçün Node.js LTS-i repair/reinstall et.

## Repository-ni yükləmək

GitHub collaborator dəvətini qəbul et. Sonra:

    New-Item -ItemType Directory -Force C:\Users\$env:USERNAME\Desktop\PHPProject | Out-Null
    Set-Location C:\Users\$env:USERNAME\Desktop\PHPProject
    git clone https://github.com/niknok29/bookloop.git
    Set-Location .\bookloop
    git branch -a
    git switch develop
    git pull --ff-only origin develop

Foundation hələ develop-ə merge edilməyibsə, müvəqqəti git switch feature/foundation istifadə et.

## İlk quraşdırma

Repository kökündə ol:

    Set-Location C:\Users\$env:USERNAME\Desktop\PHPProject\bookloop
    Get-ChildItem artisan,composer.json,package.json
    composer install
    npm install
    Copy-Item .env.example .env
    php artisan key:generate

Runtime qovluqları lazım olarsa:

    New-Item -ItemType Directory -Force bootstrap\cache | Out-Null
    New-Item -ItemType Directory -Force storage\framework\cache\data | Out-Null
    New-Item -ItemType Directory -Force storage\framework\sessions | Out-Null
    New-Item -ItemType Directory -Force storage\framework\testing | Out-Null
    New-Item -ItemType Directory -Force storage\framework\views | Out-Null
    New-Item -ItemType Directory -Force storage\logs | Out-Null

.env-də database-ni konfiqurasiya et, sonra:

    php artisan migrate --seed
    npm run build
    php artisan serve

Ayrıca terminalda npm run dev işlət. Hər iki terminal açıq qalsın. Brauzer: http://127.0.0.1:8000.

## Database

### PostgreSQL — tövsiyə olunan

pgAdmin və ya psql-də database yarat:

    CREATE DATABASE bookloop;

.env:

    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=bookloop
    DB_USERNAME=postgres
    DB_PASSWORD=sənin_passwordun
    CACHE_STORE=file
    SESSION_DRIVER=file

Sonra php artisan migrate --seed. connection refused zamanı PostgreSQL service, port, username və password-u yoxla.

### SQLite — sürətli fallback

    New-Item -ItemType File -Force database\database.sqlite | Out-Null

.env:

    DB_CONNECTION=sqlite
    DB_DATABASE=database/database.sqlite
    CACHE_STORE=file
    SESSION_DRIVER=file

Sonra php artisan migrate --seed. .env və database/database.sqlite commit olunmur. Vacib database-də migrate:fresh işlətmə; bütün cədvəlləri silir.

## Gündəlik Git prosesi

    Set-Location C:\Users\$env:USERNAME\Desktop\PHPProject\bookloop
    git switch develop
    git pull --ff-only origin develop
    git switch -c feature/bookpoint-crud
    php artisan test
    npm run build
    git status
    git diff
    git add app routes tests
    git diff --staged
    git commit -m "feat: add bookpoint crud foundation"
    git push -u origin feature/bookpoint-crud

GitHub-da feature branch-dən develop-ə Pull Request aç. main və develop-ə birbaşa push etmə.

## Git terminləri

- repository: Layihənin kodu və tarixçəsi.
- clone: GitHub surətini kompüterə almaq.
- branch: Ayrı iş xətti.
- commit: Tarixçəyə yadda saxlanmış dəyişiklik.
- staging: git add ilə commit seçimi.
- push: Lokal commit-i GitHub-a göndərmək.
- pull: GitHub dəyişikliklərini almaq.
- merge: Branch-ləri birləşdirmək.
- Pull Request: Review və merge təklifi.
- conflict: Eyni sətirlərdə zidd dəyişiklik.
- origin: GitHub remote adı.
- main: Production əsas branch-i.
- develop: İnteqrasiya branch-i.
- feature branch: Bir tapşırıq üçün branch.

## Komanda bölgüsü

[docs/ownership.md](docs/ownership.md) əsasında:

| Developer | Məsuliyyət |
|---|---|
| Developer 1 — Backend & Database Lead | Authentication, models, migrations, security və take/put logic. |
| Developer 2 — Frontend & PWA Lead | Blade/Livewire UI, responsive design, PWA və QR scanning interface. |
| Developer 3 — Notification & Gamification | Wishlist, events/listeners, reminders, notifications, Coin/XP və challenges. |
| Developer 4 — Junior Full-Stack | BookPoint CRUD, sticker generator/activation, Add Book flow və integration tests. |

Migration, model və event contract dəyişikliklərini əvvəlcədən razılaşdırın.

## Codex ilə işləmək

Codex-də C:\Users\acer\Desktop\PHPProject\bookloop qovluğunu aç. Təhlükəsiz prompt:

    BookLoop repository-də işləyirsən.
    Əvvəl repository-ni və docs/ sənədlərini inspect et.
    Yalnız verdiyim feature üzərində işləy; əlaqəsiz fayllara toxunma.
    Mövcud architecture-a hörmət et, test əlavə et və nəticəni report et.
    Commit və push etmə. .env, secret, vendor, node_modules və lokal database fayllarını dəyişmə.
    Destructive Git command işlətmə.

AI-generated kodu review və test etmədən commit etmə.

## Test və troubleshooting

Əsas yoxlamalar:

    php artisan test
    php artisan route:list
    npm run build
    git status

PASS uğur, FAIL xəta, DEPR isə test keçsə də köhnələ biləcək API/constant deməkdir.

- npm ERR! enoent və package.json missing: düzgün repository qovluğuna keç, package.json yoxla, npm install işlə.
- php/composer/npm not recognized: proqramı quraşdır, PATH-i yoxla, PowerShell-i yenidən aç.
- bootstrap/cache must be present and writable: New-Item -ItemType Directory -Force bootstrap\cache işlə.
- SQLite file does not exist: New-Item -ItemType File -Force database\database.sqlite işlə.
- Vite manifest not found: npm install və npm run build işlə.
- APP_KEY missing: Copy-Item .env.example .env; php artisan key:generate.
- database connection refused: PostgreSQL service və .env bağlantı dəyərlərini yoxla.
- migrations işləməyib: php artisan optimize:clear; php artisan migrate --seed.
- port 8000 doludur: php artisan serve --port=8001.
- Git authentication failed: collaborator dəvətini və GitHub token/Git Credential Manager-i yoxla.
- Merge conflict: git status işlət, conflict marker-larını həll et, sonra git add <fayl> və commit et.
- Səhvən secret stage olunub: git restore --staged .env database/database.sqlite; git status.

## Təhlükəsizlik

- .env, credential və secret commit etmə.
- vendor, node_modules, logs, caches və lokal database commit etmə.
- main/develop-ə force push etmə.
- Anlamadan destructive database/Git command işlətmə.
- Testsiz kodu merge etmə.
- Commit-dən əvvəl git status və git diff --staged yoxla.
- Production database-də migrate:fresh işlətmə.
- AI-generated kodu review və test etmədən qəbul etmə.

## İlk gün checklist

- [ ] GitHub access işləyir.
- [ ] Git, PHP, Composer, Node.js/npm quraşdırılıb.
- [ ] Repository clone edilib.
- [ ] develop checkout və pull edilib.
- [ ] composer install tamamlanıb.
- [ ] npm install tamamlanıb.
- [ ] .env və APP_KEY hazırdır.
- [ ] Database konfiqurasiya edilib.
- [ ] php artisan migrate --seed keçib.
- [ ] php artisan test keçib.
- [ ] npm run build keçib.
- [ ] Sayt brauzerdə açılır.
- [ ] İlk feature branch yaradılıb.

## Faydalı sənədlər

- [Architecture](docs/architecture.md)
- [Database](docs/database.md)
- [API contract](docs/api-contract.md)
- [Git workflow](docs/git-workflow.md)
- [Developer setup](docs/developer-setup.md)
- [Team ownership](docs/ownership.md)

Foundation faylları develop-də görünmürsə foundation Pull Request-inin merge vəziyyətini yoxla.
