# BookLoop

BookLoop universitet daxilində fiziki “Götür–Qoy” BookPoint rəflərini aktivləşdirən web-first platformadır.

> **Cari vəziyyət:** EnvKit istifadə edən Windows development mühiti üçün bu onboarding guide-dır. Laravel foundation faylları checkout-da yoxdursa, əvvəlcə foundation dəyişikliklərinin develop branch-inə merge olunduğunu yoxlayın.

## Mündəricat

- [BookLoop nədir?](#bookloop-nədir)
- [MVP statusu](#mvp-statusu)
- [Texnologiyalar](#texnologiyalar)
- [EnvKit](#envkit)
- [Başlamazdan əvvəl](#başlamazdan-əvvəl)
- [Repository-ni yükləmək](#repository-ni-yükləmək)
- [İlk quraşdırma](#ilk-quraşdırma)
- [Database](#database)
- [Gündəlik iş prosesi](#gündəlik-iş-prosesi)
- [Komanda və Codex](#komanda-və-codex)
- [Test və xətalar](#test-və-xətalar)
- [Təhlükəsizlik](#təhlükəsizlik)
- [İlk gün checklist](#ilk-gün-checklist)
- [Faydalı sənədlər](#faydalı-sənədlər)

## BookLoop nədir?

BookLoop kitabxana idarəetmə sistemi deyil. Fiziki BookPoint rəflərini tələbələr arasında paylaşım platforması ilə əlaqələndirir.

Axın: kitaba unikal sticker ID və QR kod verilir; tələbə kitabı BookPoint-ə qoyur; başqa tələbə götürür; kitab istənilən aktiv BookPoint-ə qoyula bilər; hərəkətlər tarixçədə saxlanılır; wishlist, bildiriş, coin və XP iştirakçılığı dəstəkləyir.

Take/put, QR scanner, wishlist notification, reminder, reward logic və admin CRUD foundation mərhələsindən sonrakı işlərdir.

## MVP statusu

Foundation aşağıdakıları nəzərdə tutur:

- Laravel 12, Blade, Tailwind, Vite və Livewire;
- registration, login, logout və qorunan dashboard;
- User, Book, BookCopy, BookPoint, Sticker, BookMovement, Wishlist, CoinTransaction və XpTransaction modelləri;
- migration, relationship, foreign key, index və uniqueness qaydaları;
- seed data və PHPUnit testləri;
- docs/ daxilində architecture, database, setup, Git workflow, ownership və API contract.

Hələ tamamlanmayıb: take/put Actions və Services, BookPoint CRUD, sticker/QR axını, wishlist matching, notifications, 10 günlük reminder, Coin/XP qaydaları, Filament admin və production PWA.

## Texnologiyalar

| Texnologiya | İzah |
|---|---|
| PHP | Laravel-in proqramlaşdırma dilidir. EnvKit bu kompüterdə PHP 8.5.9 təqdim edir. |
| Laravel 12 | Routing, authentication, migration, testing və backend skeletidir. |
| Composer | PHP dependency-lərini quraşdırır. EnvKit site üçün PHP ilə işlədə bilər. |
| PostgreSQL | Tövsiyə olunan əsas database-dir; EnvKit-də 14.23 quraşdırılıb. |
| SQLite | Lokal/test fallback database-dir; EnvKit tərəfindən idarə edilmir. |
| Blade | Server-side HTML template sistemidir. |
| Livewire | Blade üçün interaktiv komponentdir və foundation dependency-lərindədir. |
| Tailwind CSS | Responsive dizayn üçün CSS framework-dür. |
| Alpine.js | Hazırkı package.json-da yoxdur; özbaşına əlavə etməyin. |
| Vite | CSS və JavaScript build edir. |
| Node.js/npm | Frontend dependency və build mühitidir; EnvKit-də Node.js quraşdırılmayıb. |
| Git/GitHub | Kod tarixçəsi, branch, review və Pull Request üçündür. |

## EnvKit

Bu kompüterdə real yoxlama:

- EnvKit release: 0.33.0-beta.37;
- Qeyd: bəzi terminallarda `envkit --version` ayrıca CLI wrapper versiyasını (`0.1.0`) göstərə bilər. Bu rəqəm EnvKit release versiyası ilə eyni olmaya bilər;
- quraşdırma yeri: C:\ProgramData\envkit;
- projects directory: C:\Users\acer\Desktop\PHPProject;
- Nginx: 1.28.0;
- PHP: 8.5.9;
- PostgreSQL: 14.23, port 5432;
- BookLoop EnvKit sites siyahısında mövcuddur;
- Node.js, Redis, Memcached və Mailpit EnvKit-də quraşdırılmayıb.

EnvKit PHP, Composer, Laravel Artisan, Nginx, PostgreSQL, site registration, PATH, host/config apply və servis statusuna kömək edir. EnvKit Node/npm dependency-lərini, Laravel .env dəyərlərini, APP_KEY, migration, seed və BookLoop biznes məntiqini sizin yerinizə konfiqurasiya etmir.

EnvKit installer/download URL-i repository-də yoxdur. Buna görə README uydurma installer command vermir. EnvKit quraşdırılmayıbsa, təsdiqlənmiş installer-i IT sahibindən və ya komanda rəhbərindən alın.

Yoxlama:

    envkit --version
    envkit --help
    envkit sites
    envkit status
    envkit services

İlkin config/data qovluqları:

    envkit init

Servis və host/config idarəsi:

    envkit start nginx php-fpm postgres
    envkit status
    envkit apply

Dayandırmaq üçün:

    envkit stop nginx php-fpm postgres

EnvKit-in servis idarə etdiyini yoxlayın; hər servisi kor-koranə başlatmayın. BookLoop üçün PostgreSQL və Nginx kifayətdir.

## Başlamazdan əvvəl

Windows 10/11-də quraşdırın:

- [Git for Windows](https://git-scm.com/download/win)
- [Visual Studio Code](https://code.visualstudio.com/download)
- [Node.js LTS](https://nodejs.org/en/download)
- PHP və Composer üçün komanda standartı EnvKit-dir.
- PostgreSQL üçün komanda standartı EnvKit-dir.

Faydalı VS Code extension-ları: PHP Intelephense, Laravel Blade Snippets, Tailwind CSS IntelliSense, DotENV və GitLens.

PowerShell:

    git --version
    envkit --version
    envkit php -v
    envkit composer --version
    node -v
    npm -v

envkit, php və ya composer tanınmırsa EnvKit və ya PATH problemi var. node/npm tanınmırsa Node.js LTS ayrıca quraşdırılmalıdır.

## Repository-ni yükləmək

GitHub collaborator dəvətini qəbul edin:

    New-Item -ItemType Directory -Force C:\Users\$env:USERNAME\Desktop\PHPProject | Out-Null
    Set-Location C:\Users\$env:USERNAME\Desktop\PHPProject
    git clone https://github.com/niknok29/bookloop.git
    Set-Location .\bookloop
    git switch develop
    git pull --ff-only origin develop

Foundation hələ develop-də deyilsə, müvəqqəti:

    git switch feature/foundation

## İlk quraşdırma

Repository root-da artisan, composer.json və package.json olmalıdır:

    Set-Location C:\Users\acer\Desktop\PHPProject\bookloop
    Get-ChildItem artisan,composer.json,package.json

EnvKit project-aware komandaları:

    envkit composer install
    npm install
    Copy-Item .env.example .env
    envkit artisan key:generate

Runtime qovluqları lazım olarsa:

    New-Item -ItemType Directory -Force bootstrap\cache | Out-Null
    New-Item -ItemType Directory -Force storage\framework\cache\data | Out-Null
    New-Item -ItemType Directory -Force storage\framework\sessions | Out-Null
    New-Item -ItemType Directory -Force storage\framework\testing | Out-Null
    New-Item -ItemType Directory -Force storage\framework\views | Out-Null
    New-Item -ItemType Directory -Force storage\logs | Out-Null

BookLoop-u EnvKit site kimi qeydiyyata almaq üçün:

    envkit sites-link C:\Users\acer\Desktop\PHPProject\bookloop
    envkit sites
    envkit apply

sites-link faylları köçürmür, sadəcə mövcud qovluğu qeydiyyata alır. Sonra .env database dəyərlərini doldurun:

    envkit artisan migrate --seed
    npm run build
    envkit artisan serve

Ayrı terminalda npm run dev saxlayın. Brauzer: http://127.0.0.1:8000. EnvKit host mapping tətbiq olunubsa http://bookloop.test də işləyə bilər.

## Database

### PostgreSQL — tövsiyə olunan

    envkit start postgres
    envkit status

EnvKit PostgreSQL servisinin process və portunu idarə edir, lakin database adı və credential yaratma qaydasını repository müəyyən etmir. pgAdmin və ya psql ilə lokal bookloop database yaradın.

.env:

    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=bookloop
    DB_USERNAME=lokal_username
    DB_PASSWORD=lokal_password
    CACHE_STORE=file
    SESSION_DRIVER=file

Sonra:

    envkit artisan migrate --seed

### SQLite — sürətli fallback

EnvKit SQLite yaratmır:

    New-Item -ItemType File -Force database\database.sqlite | Out-Null

.env:

    DB_CONNECTION=sqlite
    DB_DATABASE=database/database.sqlite
    CACHE_STORE=file
    SESSION_DRIVER=file

Sonra envkit artisan migrate --seed. .env və database/database.sqlite commit edilmir. Vacib database-də migrate:fresh işlətməyin.

## Gündəlik iş prosesi

    Set-Location C:\Users\acer\Desktop\PHPProject\bookloop
    envkit status
    git switch develop
    git pull --ff-only origin develop
    git switch -c feature/bookpoint-crud
    envkit artisan test
    npm run build
    envkit artisan route:list
    git status
    git diff
    git add app routes tests
    git diff --staged
    git commit -m "feat: add bookpoint crud foundation"
    git push -u origin feature/bookpoint-crud

GitHub-da feature branch-dən develop-ə Pull Request açın. main və develop-ə birbaşa push etməyin.

## Git terminləri

- repository: Kod və tarixçə.
- clone: GitHub surətini kompüterə almaq.
- branch: Ayrı iş xətti.
- commit: Tarixçəyə yadda saxlanmış dəyişiklik.
- staging: git add ilə commit seçimi.
- push: Commit-i GitHub-a göndərmək.
- pull: GitHub dəyişikliklərini almaq.
- merge: Branch-ləri birləşdirmək.
- Pull Request: Review və merge təklifi.
- conflict: Zidd dəyişiklik.
- origin: GitHub remote adı.
- main: Production əsas branch-i.
- develop: İnteqrasiya branch-i.
- feature branch: Bir tapşırıq branch-i.

## Komanda bölgüsü

[docs/ownership.md](docs/ownership.md) əsasında:

| Developer | Məsuliyyət |
|---|---|
| Developer 1 — Backend & Database Lead | Authentication, models, migrations, security və take/put logic. |
| Developer 2 — Frontend & PWA Lead | Blade/Livewire UI, responsive design, PWA və QR interface. |
| Developer 3 — Notification & Gamification | Wishlist, events/listeners, reminders, notifications, Coin/XP və challenges. |
| Developer 4 — Junior Full-Stack | BookPoint CRUD, sticker activation, Add Book flow və integration tests. |

Migration və event contract dəyişikliklərini əvvəlcədən razılaşdırın.

## Codex ilə işləmək

Codex-də C:\Users\acer\Desktop\PHPProject\bookloop qovluğunu açın. Prompt:

    Əvvəl repository-ni və docs/ sənədlərini inspect et.
    Yalnız verdiyim feature üzərində işləy; əlaqəsiz fayllara toxunma.
    Mövcud architecture-a hörmət et, test əlavə et və nəticəni report et.
    Commit və push etmə.
    .env, secret, vendor, node_modules və lokal database fayllarını dəyişmə.
    Destructive Git command işlətmə.

AI-generated kodu review və test etmədən commit etməyin.

## Test və yoxlamalar

    envkit artisan test
    envkit artisan route:list
    npm run build
    git status

PASS uğur, FAIL xəta, DEPR isə test keçsə də köhnələ biləcək API/constant deməkdir.

## Xətalar və həllər

- envkit not recognized: EnvKit quraşdırılmayıb və ya PATH-də deyil; IT-dən təsdiqlənmiş installer alın.
- envkit php/composer işləmir: envkit status, site registration və project root-u yoxlayın.
- node/npm not recognized: Node.js LTS-i ayrıca quraşdırın.
- package.json missing: düzgün root-a keçin və foundation merge vəziyyətini yoxlayın.
- bootstrap/cache writable deyil: New-Item -ItemType Directory -Force bootstrap\cache işlədin.
- APP_KEY missing: Copy-Item .env.example .env; envkit artisan key:generate.
- Vite manifest not found: npm install; npm run build.
- database connection refused: envkit start postgres; envkit status; .env dəyərlərini yoxlayın.
- SQLite file yoxdur: New-Item -ItemType File -Force database\database.sqlite.
- migrations işləməyib: envkit artisan optimize:clear; envkit artisan migrate --seed.
- port 8000 doludur: envkit artisan serve --port=8001.
- site görünmür: envkit sites-link ...; envkit apply.
- Git authentication failed: collaborator, remote və Credential Manager-i yoxlayın.
- merge conflict: git status, marker-ları həll et, git add <fayl>, sonra commit.
- .env stage olunub: git restore --staged .env database/database.sqlite.

## Təhlükəsizlik

- .env, credential, password və token commit etməyin.
- vendor, node_modules, logs, caches və lokal database commit etməyin.
- main/develop-ə force push etməyin.
- Anlamadan destructive database/Git command işlətməyin.
- Testsiz kodu merge etməyin.
- Commit-dən əvvəl git status və git diff --staged yoxlayın.
- Production database-də migrate:fresh işlətməyin.
- EnvKit-in secret/config fayllarını repository-yə köçürməyin.

## İlk gün checklist

- [ ] Git və VS Code quraşdırılıb.
- [ ] EnvKit quraşdırılıb: envkit --version.
- [ ] envkit status-da PHP və PostgreSQL görünür.
- [ ] Node.js və npm ayrıca quraşdırılıb.
- [ ] Repository clone edilib, develop checkout edilib.
- [ ] BookLoop sites-link edilib.
- [ ] envkit composer install tamamlanıb.
- [ ] npm install tamamlanıb.
- [ ] .env və APP_KEY hazırdır.
- [ ] Database konfiqurasiya edilib.
- [ ] envkit artisan migrate --seed keçib.
- [ ] envkit artisan test keçib.
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

Foundation faylları develop-də görünmürsə, foundation Pull Request-inin merge vəziyyətini yoxlayın.
