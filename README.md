# Wiki GESFINANCIERO - Documentación Completa


## Tabla de Contenidos

- [1. Overview](#1-overview)
  - [1.1 Getting Started](#11-getting-started)
  - [1.2 Repository Structure](#12-repository-structure)
- [2. Application Entry Points](#2-application-entry-points)
  - [2.1 Main Application Entry (index.php)](#21-main-application-entry-indexphp)
  - [2.2 Home Application Entry (home.php)](#22-home-application-entry-homephp)
- [3. Controller Layer](#3-controller-layer)
  - [3.1 IndexCtrl - Main Application Controller](#31-indexctrl-main-application-controller)
  - [3.2 HomeCtrl - Public Home Controller](#32-homectrl-public-home-controller)
  - [3.3 Rest - REST API Handler](#33-rest-rest-api-handler)
- [4. Business Logic Layer](#4-business-logic-layer)
  - [4.1 OperacionesCtrl - Core Operations](#41-operacionesctrl-core-operations)
  - [4.2 OperacionesHomeCtrl - Home Operations](#42-operacioneshomectrl-home-operations)
- [5. Data Layer](#5-data-layer)
  - [5.1 Singleton - Database Connection Manager](#51-singleton-database-connection-manager)
  - [5.2 Clsdatos - ORM and Data Access](#52-clsdatos-orm-and-data-access)
  - [5.3 Data Models](#53-data-models)
- [6. Configuration and Infrastructure](#6-configuration-and-infrastructure)
  - [6.1 System Configuration (Corporation.php)](#61-system-configuration-corporationphp)
  - [6.2 Static Data Resources](#62-static-data-resources)
- [7. Module System](#7-module-system)
  - [7.1 Anexos Module](#71-anexos-module)
  - [7.2 Avatar Module](#72-avatar-module)
  - [7.3 Communication Module (com)](#73-communication-module-com)
  - [7.4 Processing Module (proc)](#74-processing-module-proc)
  - [7.5 Resources Module (recursos)](#75-resources-module-recursos)
  - [7.6 Users Module (usuarios)](#76-users-module-usuarios)
  - [7.7 Corporate Module (corp)](#77-corporate-module-corp)
- [8. Libraries and Utilities](#8-libraries-and-utilities)
  - [8.1 ApiboxLib - API Key Management](#81-apiboxlib-api-key-management)
  - [8.2 MagicPagesLib - Temporary Page System](#82-magicpageslib-temporary-page-system)
  - [8.3 Email System (PHPMailer)](#83-email-system-phpmailer)
- [9. API Reference](#9-api-reference)
  - [9.1 REST API Endpoints](#91-rest-api-endpoints)
  - [9.2 AJAX API Endpoints](#92-ajax-api-endpoints)
  - [9.3 User Management APIs](#93-user-management-apis)
  - [9.4 Document and Workflow APIs](#94-document-and-workflow-apis)
- [10. Security and Authentication](#10-security-and-authentication)
  - [10.1 Authentication System](#101-authentication-system)
  - [10.2 Token Management](#102-token-management)
  - [10.3 Account Activation and Recovery](#103-account-activation-and-recovery)
- [11. Deployment and Configuration](#11-deployment-and-configuration)
  - [11.1 Environment Configuration](#111-environment-configuration)
  - [11.2 Security Hardening](#112-security-hardening)

---

## 1. Overview

## Purpose and Scope

This page provides a high-level introduction to the GESFINANCIERO system, covering its purpose, core features, technology stack, and architectural design. This document is intended for developers, system architects, and technical contributors who need to understand the overall structure of the application before diving into specific subsystems.

For detailed information about specific components, see:
- Application bootstrapping and initialization: [Application Entry Points](#2)
- Controller architecture and request handling: [Controller Layer](#3)
- Business logic implementation: [Business Logic Layer](#4)
- Database interaction patterns: [Data Layer](#5)
- System configuration details: [Configuration and Infrastructure](#6)

**Sources:** README.md, LICENSE.txt, src/Version.php

---

## What is GESFINANCIERO?

**GESFINANCIERO** is a web-based institutional financial management platform designed for managing financial workflows, approvals, user roles, and budgets. The system is built to support both on-premises and cloud deployments, emphasizing transparency, efficiency, and open access to public technology solutions.

The current version is `v1.21.7.50` as defined in [src/Version.php:6]().

The project is licensed under the MIT License, making it fully open source and freely available for use, modification, and distribution by any entity or organization.

**Sources:** README.md:1-4, README.md:56-61, src/Version.php:6, LICENSE.txt:1-22

---

## Core Features

GESFINANCIERO provides the following key capabilities:

| Feature | Description |
|---------|-------------|
| **Financial Workflow Management** | Track and control financial flows with multi-level approval processes |
| **User & Role Administration** | Comprehensive user management with differentiated permission levels |
| **Real-time Financial Reports** | Generate and download financial reports with current data |
| **Flexible Architecture** | Deploy to local environments or cloud infrastructure |
| **Secure Authentication** | Multiple authentication methods including LDAP integration |
| **Activity Logging** | Complete audit trail of system activities |
| **Responsive Interface** | Bootstrap 5+ based web UI accessible from any device |
| **REST & AJAX APIs** | Dual API paradigms supporting modern and legacy integrations |
| **Email Notifications** | Template-based email system for workflow notifications |
| **Document Management** | Handle templates, digital signatures, and attachments |

**Sources:** README.md:8-16

---

## Technology Stack

GESFINANCIERO is built using the following technologies:

| Component | Technology |
|-----------|------------|
| **Backend** | PHP 7.4+ |
| **Database** | MySQL (database: `nuevapp_apps`) |
| **Frontend** | Bootstrap 5+, JavaScript, HTML5, CSS3 |
| **Web Server** | Apache / Nginx |
| **Email** | PHPMailer with SMTP (smtp.ipage.com:25) |
| **Authentication** | Session-based + Bearer tokens + LDAP |
| **Version Control** | Git + GitHub |

**Sources:** README.md:19-28

---

## High-Level Architecture

### Architectural Pattern

GESFINANCIERO follows a **layered MVC architecture with modular plugin extensions**. The system is organized into distinct layers with clear separation of concerns:

```mermaid
graph TB
    subgraph "Entry Layer"
        index["index.php"]
        home["home.php"]
    end
    
    subgraph "Controller Layer"
        IndexCtrl["IndexCtrl<br/>100+ API endpoints"]
        HomeCtrl["HomeCtrl<br/>Page routing"]
        Rest["Rest<br/>REST API handler"]
    end
    
    subgraph "Business Logic Layer"
        OperacionesCtrl["OperacionesCtrl<br/>Core operations"]
        OperacionesHomeCtrl["OperacionesHomeCtrl<br/>Home operations"]
    end
    
    subgraph "Data Layer"
        Singleton["Singleton<br/>DB connection"]
        Clsdatos["Clsdatos<br/>ORM base class"]
        Models["Model classes<br/>src/modelo/*"]
    end
    
    subgraph "Infrastructure"
        Corporation["Corporation<br/>Configuration"]
        Libraries["Libraries<br/>src/libs/*"]
        Modules["Modules<br/>repo/*"]
    end
    
    subgraph "External Systems"
        MySQL["MySQL Database<br/>nuevapp_apps"]
        SMTP["SMTP Server"]
        LDAP["LDAP Directory"]
    end
    
    index --> IndexCtrl
    home --> HomeCtrl
    IndexCtrl --> Rest
    
    IndexCtrl --> OperacionesCtrl
    HomeCtrl --> OperacionesHomeCtrl
    Rest --> OperacionesCtrl
    
    OperacionesCtrl --> Singleton
    OperacionesHomeCtrl --> Singleton
    
    Singleton --> Clsdatos
    Clsdatos --> Models
    
    Singleton --> MySQL
    OperacionesCtrl --> SMTP
    OperacionesHomeCtrl --> LDAP
    
    Singleton -.-> Corporation
    OperacionesCtrl -.-> Libraries
    IndexCtrl -.-> Modules
```

**Diagram: GESFINANCIERO Layered Architecture with Code Entities**

**Sources:** README.md, architecture diagrams provided

---

## System Components

### Entry Points

The application provides two primary entry points that bootstrap different execution contexts:

| File | Purpose | Primary Controller |
|------|---------|-------------------|
| `index.php` | Main application entry for authenticated operations | `IndexCtrl` |
| `home.php` | Public-facing home page and external authentication | `HomeCtrl` |

Both entry points initialize the PHP environment, load dependencies, configure error reporting, and instantiate their respective controllers.

**Sources:** Architecture diagrams

---

### Core Controllers

```mermaid
graph LR
    IndexCtrl["IndexCtrl<br/>src/controlador/IndexCtrl.php"]
    HomeCtrl["HomeCtrl<br/>src/controlador/HomeCtrl.php"]
    Rest["Rest<br/>src/controlador/Rest.php"]
    
    subgraph "Request Types"
        AJAX["AJAX Requests<br/>POST data"]
        REST["REST API<br/>PATH_INFO"]
        Pages["Page Renders<br/>GET requests"]
    end
    
    subgraph "Business Logic"
        OperacionesCtrl["OperacionesCtrl<br/>src/controlador/OperacionesCtrl.php"]
        OperacionesHomeCtrl["OperacionesHomeCtrl<br/>src/controlador/OperacionesHomeCtrl.php"]
    end
    
    AJAX --> IndexCtrl
    REST --> Rest
    Pages --> IndexCtrl
    
    Rest --> OperacionesCtrl
    IndexCtrl --> OperacionesCtrl
    HomeCtrl --> OperacionesHomeCtrl
    
    Pages --> HomeCtrl
```

**Diagram: Request Routing Through Controllers**

| Controller | Location | Responsibilities |
|------------|----------|------------------|
| `IndexCtrl` | `src/controlador/IndexCtrl.php` | Main application controller with 100+ API endpoints for user management, documents, workflows, and system configuration |
| `HomeCtrl` | `src/controlador/HomeCtrl.php` | Public page routing, external authentication, template rendering |
| `Rest` | `src/controlador/Rest.php` | REST API gateway with Bearer token authentication |
| `OperacionesCtrl` | `src/controlador/OperacionesCtrl.php` | Core business logic hub for authentication, email, file operations, user management |
| `OperacionesHomeCtrl` | `src/controlador/OperacionesHomeCtrl.php` | Home-specific operations including account activation, LDAP authentication, document listing |

**Sources:** Architecture diagrams

---

### Data Access Layer

The data layer implements a three-tier abstraction pattern:

| Component | Location | Function |
|-----------|----------|----------|
| `Singleton` | `src/modelo/Singleton.php` | Database connection manager with classic and safe query methods |
| `Clsdatos` | `src/modelo/Clsdatos.php` | ORM-like base class providing CRUD operations |
| Model Classes | `src/modelo/*.php` | Specific models extending `Clsdatos` (e.g., `userselecto`, `perfilselecto`, `docsestados`) |

**Key Methods:**

- `Singleton::_safeSelect()`, `_safeInsert()`, `_safeUpdate()`, `_safeDelete()` - Prepared statement queries
- `Singleton::_classicRead()`, `_classicInsert()`, `_classicUpdate()`, `_classicDelete()` - Legacy string-based queries
- `Clsdatos::readInfo()`, `saveData()`, `updateData()`, `deleteById()` - CRUD operations

**Sources:** Architecture diagrams

---

### Configuration System

System-wide configuration is centralized in the `Corporation` class:

| Class | Location | Contains |
|-------|----------|----------|
| `Corporation` | `repo/corp/Corporation.php` | Database credentials, SMTP configuration, system constants |

**Critical Security Note:** The `Corporation` class contains hardcoded database and SMTP credentials directly in source code. See [Security Hardening](#11.2) for recommendations on externalizing these values.

**Sources:** Architecture diagrams

---

### Module System

The `repo/` directory implements a plugin-like module architecture:

```mermaid
graph TB
    repo["repo/<br/>Module Root"]
    
    subgraph "Tracked Entry Points"
        anexos_idx["anexos/index.php<br/>Attachments"]
        avatar_idx["avatar/index.php<br/>User Images"]
        proc_idx["proc/index.php<br/>Processing"]
        com_idx["com/index.php<br/>Communications"]
        recursos_idx["recursos/index.php<br/>Resources"]
        usuarios_idx["usuarios/index.php<br/>User Data"]
        corp_idx["corp/index.php<br/>Corporate Config"]
    end
    
    subgraph "Runtime Data (Ignored)"
        runtime["Generated files<br/>Uploads<br/>Cached data<br/>User content"]
    end
    
    repo --> anexos_idx
    repo --> avatar_idx
    repo --> proc_idx
    repo --> com_idx
    repo --> recursos_idx
    repo --> usuarios_idx
    repo --> corp_idx
    
    anexos_idx -.-> runtime
    avatar_idx -.-> runtime
    proc_idx -.-> runtime
```

**Diagram: Module Architecture with Tracked Entry Points**

Each module has:
- **Entry Point** (`index.php`) - Tracked in Git, defines module interface
- **Runtime Data** - Ignored by Git, contains user-generated content

| Module | Directory | Purpose |
|--------|-----------|---------|
| `anexos` | `repo/anexos/` | Attachment management |
| `avatar` | `repo/avatar/` | User profile images |
| `proc` | `repo/proc/` | Processing operations |
| `com` | `repo/com/` | Communication utilities |
| `recursos` | `repo/recursos/` | Resource file management |
| `usuarios` | `repo/usuarios/` | User-specific data |
| `corp` | `repo/corp/` | Corporate configuration (contains `Corporation.php`) |

**Sources:** Architecture diagrams

---

### Library Components

Reusable libraries are organized in `src/libs/`:

| Library | Location | Purpose |
|---------|----------|---------|
| `ApiboxLib` | `src/libs/Apibox/` | API key and token management |
| `MagicPagesLib` | `src/libs/MagicPages/` | Temporary secure page generation |
| `PHPMailer` | `src/libs/PHPMailer-61/` | Email sending via SMTP |
| `phpqrcode` | `src/libs/phpqrcode/` | QR code generation |

**Sources:** Architecture diagrams

---

## API Architecture

GESFINANCIERO provides two API paradigms that coexist in the system:

### REST API

- **Handler:** `Rest` class in `src/controlador/Rest.php`
- **Authentication:** Bearer token via `Authorization` header
- **Detection:** Presence of `PATH_INFO` server variable
- **Response:** JSON with early termination using `die()`

### AJAX API

- **Handler:** `IndexCtrl` class methods
- **Authentication:** Session-based
- **Detection:** POST request with operation parameter
- **Response:** JSON or HTML depending on endpoint

This dual approach indicates evolutionary development, with the REST API being a more recent addition to support modern integrations while maintaining backward compatibility with legacy AJAX endpoints.

**Sources:** Architecture diagrams

---

## Authentication Mechanisms

The system supports multiple authentication methods:

| Method | Implementation | Use Case |
|--------|----------------|----------|
| **Session-based** | `OperacionesCtrl::AutenticaUsuarioSis()` | Traditional web application login |
| **Bearer Token** | `Rest::handler()` with token validation | REST API authentication |
| **LDAP Integration** | `OperacionesHomeCtrl::LoginLdapUsur()` | Corporate directory authentication |
| **External Auth** | `HomeCtrl::LoginFromExterno()` | Third-party authentication providers |
| **Temporary Codes** | `OperacionesHomeCtrl::activarCuenta()` | Account activation via email |

**Sources:** Architecture diagrams

---

## Database Architecture

The system uses a single MySQL database:

| Database | Tables | Access Pattern |
|----------|--------|----------------|
| `nuevapp_apps` | User tables (`userselecto`, `extusers`), Document tables (`docsestados`, `adjuntosflujos`), System tables (`apibox`, `codigoactiva`, `magicpages`) | Via `Singleton` connection manager with prepared statements (safe) or string queries (classic) |

**Connection Flow:**
1. Controllers call `OperacionesCtrl` or `OperacionesHomeCtrl`
2. Operations call model methods or `Singleton` directly
3. `Singleton` executes queries against `nuevapp_apps` database
4. Results flow back through the call stack

**Sources:** Architecture diagrams

---

## Request Processing Flow

```mermaid
sequenceDiagram
    participant User
    participant WebServer
    participant Entry as "index.php or home.php"
    participant Controller as "IndexCtrl or HomeCtrl"
    participant Operations as "OperacionesCtrl"
    participant Singleton
    participant Database as "MySQL nuevapp_apps"
    
    User->>WebServer: "HTTP Request"
    WebServer->>Entry: "Route to entry point"
    Entry->>Entry: "Load dependencies<br/>Configure environment"
    Entry->>Controller: "Instantiate controller"
    Controller->>Controller: "Check authentication"
    
    alt "REST API Request"
        Controller->>Controller: "Detect PATH_INFO"
        Controller->>Operations: "Call REST operation"
    else "AJAX Request"
        Controller->>Controller: "Detect POST data"
        Controller->>Operations: "Call AJAX operation"
    else "Page Render"
        Controller->>Operations: "Load page data"
    end
    
    Operations->>Singleton: "Database query"
    Singleton->>Database: "Execute SQL"
    Database-->>Singleton: "Return results"
    Singleton-->>Operations: "Return data"
    Operations-->>Controller: "Return response"
    Controller-->>WebServer: "Send response"
    WebServer-->>User: "HTTP Response"
```

**Diagram: End-to-End Request Processing**

**Sources:** Architecture diagrams

---

## Technical Debt and Security Considerations

Based on the architectural analysis, the following areas warrant attention:

| Issue | Location | Impact | Priority |
|-------|----------|--------|----------|
| Hardcoded credentials | `repo/corp/Corporation.php` | Security risk - credentials in source control | High |
| Mixed query methods | `Singleton` class | SQL injection vulnerability in classic methods | High |
| Dual API paradigms | `IndexCtrl`, `Rest` | Maintenance complexity and duplication | Medium |
| Empty module entry points | `repo/*/index.php` | Incomplete implementation or unused code | Low |
| No connection pooling | `Singleton` | Potential performance bottleneck | Medium |

See [Security Hardening](#11.2) for detailed recommendations and mitigation strategies.

**Sources:** Architecture diagrams, analysis notes

---

## Getting Started

To begin working with GESFINANCIERO:

1. **Setup:** See [Getting Started](#1.1) for installation and configuration
2. **Understand Structure:** Review [Repository Structure](#1.2) to navigate the codebase
3. **Entry Points:** Learn about [Application Entry Points](#2) to understand initialization
4. **Controllers:** Explore [Controller Layer](#3) to see request handling
5. **Data Layer:** Study [Data Layer](#5) to understand database interaction
6. **Security:** Review [Security and Authentication](#10) for authentication mechanisms

**Sources:** README.md:31-46

---

## Contributing

GESFINANCIERO is an open source project welcoming contributions from individuals and institutions. The project follows standard Git workflow:

1. Fork the repository at `https://github.com/JARDIN-BOTANICO-JCM/gesfinanciero`
2. Create a feature branch (`git checkout -b feature/nueva-funcionalidad`)
3. Commit changes with descriptive messages
4. Push to your fork and create a Pull Request

The project is licensed under MIT License, allowing free use, modification, and distribution with preservation of copyright notice.

**Sources:** README.md:31-46, README.md:49-61, LICENSE.txt:1-22

---

---

## 1.1 Getting Started

## Purpose and Scope

This document provides setup instructions for the GESFINANCIERO application, including prerequisites, installation steps, configuration requirements, and an explanation of the application's entry points and initialization sequence. 

For detailed information about the repository structure and module organization, see [Repository Structure](#1.2). For configuration details specific to the `Corporation` class, see [System Configuration](#6.1). For deployment and security hardening, see [Deployment and Configuration](#11).

---

## Prerequisites

GESFINANCIERO requires the following software components to be installed and configured before deployment:

| Component | Requirement | Notes |
|-----------|-------------|-------|
| **PHP** | 7.4 or higher | Must have CLI and web server integration |
| **Web Server** | Apache or Nginx | Configured to serve PHP applications |
| **MySQL** | 5.7 or higher | Database server for persistent storage |
| **Git** | Latest stable | For version control and cloning repository |
| **Composer** | Latest stable | Dependency management (PHPMailer) |

### PHP Extensions Required

The application requires the following PHP extensions to be enabled:

- `mysqli` - MySQL database connectivity
- `json` - JSON encoding/decoding operations
- `mbstring` - Multi-byte string handling
- `openssl` - Cryptographic operations and SSL/TLS
- `ldap` - LDAP authentication integration (optional, for corporate auth)
- `gd` or `imagick` - Image processing for avatars and uploads

**Sources:** [README.md:19-27]()

---

## Installation

### Step 1: Clone Repository

Clone the GESFINANCIERO repository to your web server's document root or a subdirectory:

```bash
git clone https://github.com/JARDIN-BOTANICO-JCM/gesfinanciero.git
cd gesfinanciero
```

### Step 2: Install Composer Dependencies

The application uses PHPMailer for email functionality. Install dependencies using Composer:

```bash
composer install
```

If Composer is not available, PHPMailer is bundled in the repository at [src/libs/PHPMailer-61/]().

### Step 3: Configure Web Server

Configure your web server to serve the application. The document root should point to the repository root directory.

**Apache Example (.htaccess):**
```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]
```

**Nginx Example:**
```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

### Step 4: Set File Permissions

Ensure the web server has write permissions to runtime data directories:

```bash
chmod -R 775 repo/anexos
chmod -R 775 repo/avatar
chmod -R 775 repo/proc
chmod -R 775 repo/com
chmod -R 775 repo/recursos
chmod -R 775 repo/usuarios
chmod -R 775 repo/corp
```

**Sources:** [README.md:31-46](), High-Level Diagram 5 (Module Architecture)

---

## Configuration Requirements

### Database Configuration

The application expects a MySQL database named `nuevapp_apps`. Configuration is managed through the `Corporation` class located at [repo/corp/Corporation.php]().

**Database Setup:**
```sql
CREATE DATABASE nuevapp_apps CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'gesfinanciero_user'@'localhost' IDENTIFIED BY 'secure_password';
GRANT ALL PRIVILEGES ON nuevapp_apps.* TO 'gesfinanciero_user'@'localhost';
FLUSH PRIVILEGES;
```

### Corporation.php Configuration

Edit [repo/corp/Corporation.php]() to configure database and SMTP credentials:

```php
<?php
class Corporation {
    // Database Configuration
    const DB_HOST = 'localhost';
    const DB_NAME = 'nuevapp_apps';
    const DB_USER = 'gesfinanciero_user';
    const DB_PASS = 'secure_password';
    
    // SMTP Configuration
    const SMTP_HOST = 'smtp.example.com';
    const SMTP_PORT = 587;
    const SMTP_USER = 'noreply@example.com';
    const SMTP_PASS = 'smtp_password';
    const SMTP_FROM = 'noreply@example.com';
    
    // Application Configuration
    const APP_NAME = 'GESFINANCIERO';
    const APP_URL = 'https://your-domain.com';
}
```

**Security Note:** The current implementation uses hardcoded credentials in `Corporation.php`. For production deployments, see [Security Hardening](#11.2) for recommendations on externalizing configuration to environment variables.

### Timezone Configuration

Both entry points set the timezone to `America/Bogota`. To change this, edit:
- [index.php:2]()
- [home.php:2]()

```php
date_default_timezone_set('America/Bogota');
```

**Sources:** [index.php:1-4](), [home.php:1-4](), High-Level Diagram 1 (Configuration & Libraries)

---

## Entry Points and Bootstrap Process

GESFINANCIERO has two distinct entry points, each serving different application contexts:

### Entry Point Architecture

```mermaid
graph TD
    subgraph "Web Server"
        REQUEST["HTTP Request"]
    end
    
    subgraph "Entry Points"
        INDEX["index.php<br/>Authenticated Application"]
        HOME["home.php<br/>Public Home"]
    end
    
    subgraph "Controllers"
        INDEXCTRL["IndexCtrl<br/>100+ API Endpoints"]
        HOMECTRL["HomeCtrl<br/>Public Pages"]
    end
    
    subgraph "Bootstrap Components"
        UTILES["Utiles<br/>Utility Functions"]
        CONFIG["Config<br/>App Settings"]
        PAGINA["Pagina<br/>Page Rendering"]
        CORREO["Correo<br/>Email Functions"]
        SINGLETON["Singleton<br/>DB Manager"]
        CLSDATOS["Clsdatos<br/>ORM Base"]
        MODELS["Model Classes<br/>src/modelo/*"]
        SEGURIDAD["Seguridad<br/>Security Layer"]
        MENUBAR["Menubar<br/>Menu UI"]
        HEADERBAR["Headerbar<br/>Header UI"]
        CAMPOS["Campos<br/>Form Fields"]
        QRLIB["qrlib.php<br/>QR Code Gen"]
    end
    
    REQUEST -->|"Authenticated Routes"| INDEX
    REQUEST -->|"Public Routes"| HOME
    
    INDEX --> INDEXCTRL
    HOME --> HOMECTRL
    
    INDEX --> UTILES
    INDEX --> CONFIG
    INDEX --> PAGINA
    INDEX --> CORREO
    INDEX --> SINGLETON
    INDEX --> CLSDATOS
    INDEX --> MODELS
    INDEX --> SEGURIDAD
    INDEX --> MENUBAR
    INDEX --> HEADERBAR
    INDEX --> CAMPOS
    INDEX --> QRLIB
    
    HOME --> UTILES
    HOME --> CONFIG
    HOME --> PAGINA
    HOME --> CORREO
    HOME --> SINGLETON
    HOME --> CLSDATOS
    HOME --> MODELS
    HOME --> SEGURIDAD
    HOME --> MENUBAR
    HOME --> HEADERBAR
    HOME --> QRLIB
    
    INDEXCTRL -->|"render()"| RESPONSE["HTTP Response"]
    HOMECTRL -->|"render()"| RESPONSE
```

**Sources:** [index.php:1-19](), [home.php:1-19](), High-Level Diagram 1 (Entry Layer)

### Bootstrap Sequence Comparison

| Step | index.php | home.php | Purpose |
|------|-----------|----------|---------|
| 1 | Line 1 | Line 1 | Set UTF-8 content type header |
| 2 | Line 2 | Line 2 | Configure timezone to America/Bogota |
| 3 | Lines 3-4 | Lines 3-4 | Enable error reporting (development mode) |
| 4 | Line 5 | Line 5 | Include `Utiles` utility class |
| 5 | Line 6 | Line 6 | Include `Config` configuration class |
| 6 | Line 7 | Line 7 | Include `Pagina` page rendering class |
| 7 | Line 8 | Line 8 | Include `Correo` email handling class |
| 8 | Line 9 | Line 9 | Include `Singleton` database manager |
| 9 | Line 10 | Line 10 | Include `Clsdatos` ORM base class |
| 10 | Line 11 | Line 11 | Dynamically include all models from `src/modelo/` |
| 11 | Line 12 | Line 12 | Include `Seguridad` security layer |
| 12 | Line 13 | Line 13 | Include `Menubar` menu UI component |
| 13 | Line 14 | Line 14 | Include `Headerbar` header UI component |
| 14 | Line 15 | **Not Included** | Include `Campos` form fields (index.php only) |
| 15 | Line 16 | Line 15 | Include controller (`IndexCtrl` or `HomeCtrl`) |
| 16 | Line 17 | Line 17 | Include QR code library |
| 17 | Line 18 | Line 18 | Instantiate controller |
| 18 | Line 19 | Line 19 | Execute `render()` method |

**Key Difference:** The `index.php` entry point includes the `Campos` class for form field rendering [index.php:15](), while `home.php` does not. This reflects that `index.php` serves the full authenticated application with complex forms, while `home.php` serves simplified public pages.

**Sources:** [index.php:1-19](), [home.php:1-19]()

---

## Bootstrap Process Details

### Phase 1: Environment Configuration

The first four lines of each entry point configure the PHP environment:

```php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('America/Bogota');
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

This ensures:
- UTF-8 encoding for all HTTP responses
- Consistent timezone handling
- Full error reporting during development

**Sources:** [index.php:1-4](), [home.php:1-4]()

### Phase 2: System Layer Loading

Lines 5-8 load core system utilities:

```php
include_once ( dirname( __FILE__ ) . '/src/sistema/Utiles.php');
include_once ( dirname( __FILE__ ) . '/src/sistema/Config.php');
include_once ( dirname( __FILE__ ) . '/src/sistema/Pagina.php');
include_once ( dirname( __FILE__ ) . '/src/sistema/Correo.php');
```

These provide:
- `Utiles`: File operations, directory scanning, utility functions
- `Config`: Application configuration and settings
- `Pagina`: HTML page rendering and templating
- `Correo`: Email composition and delivery

**Sources:** [index.php:5-8](), [home.php:5-8]()

### Phase 3: Data Layer Loading

Lines 9-11 establish database connectivity and model loading:

```php
include_once ( dirname( __FILE__ ) . '/src/datos/Singleton.php');
include_once ( dirname( __FILE__ ) . '/src/datos/Clsdatos.php');
Utiles::IncluirArchivos( dirname( __FILE__ ) . '/src/modelo' );
```

The `Utiles::IncluirArchivos()` call dynamically includes all PHP files in `src/modelo/`, making all model classes available without explicit includes.

**Sources:** [index.php:9-11](), [home.php:9-11]()

### Phase 4: Security and UI Components

Lines 12-14 load security and user interface components:

```php
include_once ( dirname( __FILE__ ) . '/src/sistema/Seguridad.php');
include_once ( dirname( __FILE__ ) . '/src/sistema/Menubar/Menubar.php');
include_once ( dirname( __FILE__ ) . '/src/sistema/Headerbar/Headerbar.php');
```

**Sources:** [index.php:12-14](), [home.php:12-14]()

### Phase 5: Controller Loading and Execution

The final lines load the appropriate controller, instantiate it, and execute the `render()` method:

**For index.php:**
```php
include_once ( dirname( __FILE__ ) . '/src/sistema/Campos.php');
include_once ( dirname( __FILE__ ) . '/src/ctrls/IndexCtrl.php');
include_once ( dirname( __FILE__ ) . '/src/libs/phpqrcode/qrlib.php');
$index = new IndexCtrl();
$index->render();
```

**For home.php:**
```php
include_once ( dirname( __FILE__ ) . '/src/ctrls/HomeCtrl.php');
include_once ( dirname( __FILE__ ) . '/src/libs/phpqrcode/qrlib.php');
$index = new HomeCtrl();
$index->render();
```

**Sources:** [index.php:15-19](), [home.php:15-19]()

---

## File System Structure

### Required Directory Structure

```mermaid
graph TB
    ROOT["Root Directory"]
    
    subgraph "Entry Points"
        INDEXPHP["index.php"]
        HOMEPHP["home.php"]
    end
    
    subgraph "src/"
        SRC_SISTEMA["sistema/<br/>Core System Classes"]
        SRC_DATOS["datos/<br/>Singleton, Clsdatos"]
        SRC_MODELO["modelo/<br/>Model Classes<br/>(Dynamic Load)"]
        SRC_CTRLS["ctrls/<br/>IndexCtrl, HomeCtrl"]
        SRC_LIBS["libs/<br/>Third-party Libraries"]
    end
    
    subgraph "repo/"
        REPO_ANEXOS["anexos/<br/>Attachments"]
        REPO_AVATAR["avatar/<br/>User Images"]
        REPO_PROC["proc/<br/>Processing"]
        REPO_COM["com/<br/>Communication"]
        REPO_RECURSOS["recursos/<br/>Resources"]
        REPO_USUARIOS["usuarios/<br/>User Data"]
        REPO_CORP["corp/<br/>Corporation.php"]
    end
    
    ROOT --> INDEXPHP
    ROOT --> HOMEPHP
    ROOT --> SRC_SISTEMA
    ROOT --> SRC_DATOS
    ROOT --> SRC_MODELO
    ROOT --> SRC_CTRLS
    ROOT --> SRC_LIBS
    ROOT --> REPO_ANEXOS
    ROOT --> REPO_AVATAR
    ROOT --> REPO_PROC
    ROOT --> REPO_COM
    ROOT --> REPO_RECURSOS
    ROOT --> REPO_USUARIOS
    ROOT --> REPO_CORP
    
    SRC_SISTEMA -.->|"Utiles.php<br/>Config.php<br/>Pagina.php<br/>Correo.php<br/>Seguridad.php<br/>Menubar/<br/>Headerbar/<br/>Campos.php"| INDEXPHP
    
    SRC_DATOS -.->|"Singleton.php<br/>Clsdatos.php"| INDEXPHP
    
    SRC_MODELO -.->|"*.php<br/>(All Models)"| INDEXPHP
    
    SRC_CTRLS -.->|"IndexCtrl.php<br/>HomeCtrl.php"| INDEXPHP
    
    SRC_LIBS -.->|"PHPMailer-61/<br/>phpqrcode/<br/>Apibox/<br/>MagicPages/"| INDEXPHP
```

**Sources:** [index.php:5-17](), [home.php:5-17](), High-Level Diagram 5 (Module and Plugin Architecture)

---

## Verification

After completing installation and configuration, verify the application is working correctly:

### Step 1: Database Connection Test

Create a simple test script `test_db.php` in the root directory:

```php
<?php
require_once 'repo/corp/Corporation.php';

$mysqli = new mysqli(
    Corporation::DB_HOST,
    Corporation::DB_USER,
    Corporation::DB_PASS,
    Corporation::DB_NAME
);

if ($mysqli->connect_error) {
    die('Database Connection Failed: ' . $mysqli->connect_error);
}

echo 'Database Connection Successful';
$mysqli->close();
```

Access via web browser: `http://your-domain.com/test_db.php`

### Step 2: Access Home Page

Navigate to the public home page:
```
http://your-domain.com/home.php
```

This should load the `HomeCtrl` controller and render the public-facing home interface.

### Step 3: Access Main Application

Navigate to the main application entry point:
```
http://your-domain.com/index.php
```

This should load the `IndexCtrl` controller. If authentication is configured, you will be prompted to log in.

### Step 4: Check Error Logs

Review PHP error logs and web server logs for any warnings or errors during bootstrap:

```bash
# Apache error log
tail -f /var/log/apache2/error.log

# Nginx error log
tail -f /var/log/nginx/error.log

# PHP error log
tail -f /var/log/php/error.log
```

**Sources:** [index.php:3-4](), [home.php:3-4]()

---

## Next Steps

After successful installation and verification:

1. **Configure Authentication**: Set up user accounts and authentication mechanisms. See [Authentication System](#10.1) for details on user login, LDAP integration, and session management.

2. **Explore API Endpoints**: Review available API endpoints in `IndexCtrl`. See [API Reference](#9) for comprehensive documentation of REST and AJAX endpoints.

3. **Configure Modules**: Initialize module-specific settings in the `repo/` directory. See [Module System](#7) for details on each module's purpose and configuration.

4. **Security Hardening**: Before production deployment, implement security recommendations including credential externalization and prepared statement migration. See [Security Hardening](#11.2).

5. **Understand Controllers**: Learn about the controller layer and request routing. See [Controller Layer](#3) for detailed documentation of `IndexCtrl`, `HomeCtrl`, and the `Rest` API handler.

6. **Review Data Models**: Familiarize yourself with the data models in `src/modelo/`. See [Data Models](#5.3) for model organization and usage patterns.

**Sources:** [README.md:1-92](), High-Level Diagrams 1-5

---

---

## 1.2 Repository Structure

## Purpose and Scope

This document explains the directory organization of the GESFINANCIERO codebase, the module system architecture in `repo/`, and the version control strategy that separates tracked code from runtime-generated data. Understanding this structure is essential for navigating the codebase and adding new functionality.

For information about setting up and running the application, see [Getting Started](#1.1). For details about specific modules, see [Module System](#7).

---

## Root Directory Organization

The repository follows a structured layout with clear separation between application code, configuration, and modular components.

### Primary Entry Points

| File | Purpose | Controller | Documentation |
|------|---------|------------|---------------|
| `index.php` | Main application entry for authenticated users | `IndexCtrl` | [Main Application Entry](#2.1) |
| `home.php` | Public-facing home page entry | `HomeCtrl` | [Home Application Entry](#2.2) |

### Top-Level Directory Structure

```
gesfinanciero/
├── index.php              # Main application entry point
├── home.php               # Home/public entry point
├── src/                   # Source code and libraries
│   ├── libs/              # Third-party and custom libraries
│   ├── modelo/            # Data model classes
│   ├── Singleton.php      # Database connection manager
│   ├── Clsdatos.php       # ORM/Data access base class
│   ├── IndexCtrl.php      # Main application controller
│   ├── HomeCtrl.php       # Home controller
│   ├── OperacionesCtrl.php    # Core business logic
│   ├── OperacionesHomeCtrl.php # Home business logic
│   └── Rest.php           # REST API handler
├── repo/                  # Module system (plugin architecture)
│   ├── anexos/            # Attachments module
│   ├── avatar/            # User avatars module
│   ├── com/               # Communication module
│   ├── corp/              # Corporate configuration module
│   ├── proc/              # Processing module
│   ├── recursos/          # Resources module
│   └── usuarios/          # Users module
├── css/                   # Stylesheets
├── js/                    # JavaScript files
└── data.json              # Static data resource
```

**Sources:** [.gitignore:1-30](), [README.md:1-92]()

---

## Directory Structure Diagram

The following diagram shows the relationship between directories and their roles in the application architecture.

```mermaid
graph TB
    ROOT["Root Directory"]
    
    ENTRIES["Entry Points<br/>index.php<br/>home.php"]
    
    SRC["src/<br/>Source Code"]
    SRC_CONTROLLERS["Controllers<br/>IndexCtrl.php<br/>HomeCtrl.php<br/>OperacionesCtrl.php<br/>OperacionesHomeCtrl.php<br/>Rest.php"]
    SRC_DATA["Data Layer<br/>Singleton.php<br/>Clsdatos.php"]
    SRC_LIBS["src/libs/<br/>Libraries"]
    SRC_MODELO["src/modelo/<br/>Model Classes"]
    
    REPO["repo/<br/>Module System"]
    REPO_MODULES["Module Directories<br/>anexos/<br/>avatar/<br/>com/<br/>corp/<br/>proc/<br/>recursos/<br/>usuarios/"]
    
    STATIC["Static Assets<br/>css/<br/>js/<br/>data.json"]
    
    ROOT --> ENTRIES
    ROOT --> SRC
    ROOT --> REPO
    ROOT --> STATIC
    
    SRC --> SRC_CONTROLLERS
    SRC --> SRC_DATA
    SRC --> SRC_LIBS
    SRC --> SRC_MODELO
    
    REPO --> REPO_MODULES
    
    ENTRIES -.->|"bootstrap"| SRC_CONTROLLERS
    SRC_CONTROLLERS -.->|"use"| SRC_DATA
    SRC_CONTROLLERS -.->|"use"| SRC_LIBS
    SRC_DATA -.->|"load"| SRC_MODELO
```

**Sources:** [.gitignore:1-30]()

---

## Source Directory (src/)

The `src/` directory contains all application source code organized by architectural layer.

### Core Controllers and Logic

| File | Class | Purpose | Documentation |
|------|-------|---------|---------------|
| `IndexCtrl.php` | `IndexCtrl` | Main application controller with 100+ API endpoints | [IndexCtrl](#3.1) |
| `HomeCtrl.php` | `HomeCtrl` | Public home page controller | [HomeCtrl](#3.2) |
| `OperacionesCtrl.php` | `OperacionesCtrl` | Core business logic service layer | [OperacionesCtrl](#4.1) |
| `OperacionesHomeCtrl.php` | `OperacionesHomeCtrl` | Home-specific business operations | [OperacionesHomeCtrl](#4.2) |
| `Rest.php` | `Rest` | REST API handler with token authentication | [Rest](#3.3) |

### Data Access Layer

| File | Class | Purpose | Documentation |
|------|-------|---------|---------------|
| `Singleton.php` | `Singleton` | Database connection manager with classic and safe query methods | [Singleton](#5.1) |
| `Clsdatos.php` | `Clsdatos` | Base ORM class providing CRUD operations | [Clsdatos](#5.2) |

### Libraries (src/libs/)

The `src/libs/` directory contains reusable library components:

| Library | Purpose | Documentation |
|---------|---------|---------------|
| `Apibox/` | API key and token management | [ApiboxLib](#8.1) |
| `MagicPages/` | Temporary secure page generation | [MagicPagesLib](#8.2) |
| `PHPMailer-61/` | Email sending via SMTP (Composer-managed) | [Email System](#8.3) |
| `phpqrcode/` | QR code generation | - |

### Models (src/modelo/)

The `src/modelo/` directory contains data model classes that extend `Clsdatos`. Models are dynamically loaded during bootstrap and follow an Active Record pattern. Examples include:

- `userselecto` - User authentication and management
- `perfilselecto` - User profile data
- `estadoselecto` - Status/state management
- `docsestados` - Document status tracking
- `adjuntosflujos` - Workflow attachments
- `apibox` - API token storage
- `codigoactiva` - Activation code management
- `magicpages` - Temporary page storage

See [Data Models](#5.3) for detailed documentation.

**Sources:** [.gitignore:1-30]()

---

## Module System Architecture (repo/)

The `repo/` directory implements a plugin-like module architecture with a distinctive version control strategy.

### Module Entry Point Pattern

Each module follows a consistent structure:

```
repo/
├── <module-name>/
│   ├── index.php          # TRACKED in Git - Module entry point
│   └── *                  # IGNORED in Git - Runtime data
```

This pattern creates clear separation between:
- **Code** (tracked): Module entry points and routing logic
- **Data** (ignored): User uploads, generated files, cached content

### Module List

The following diagram maps each module to its architectural purpose:

```mermaid
graph LR
    REPO["repo/<br/>Module System"]
    
    ANEXOS["anexos/<br/>Attachments Module"]
    AVATAR["avatar/<br/>User Avatars Module"]
    COM["com/<br/>Communication Module"]
    CORP["corp/<br/>Corporate Config Module"]
    PROC["proc/<br/>Processing Module"]
    RECURSOS["recursos/<br/>Resources Module"]
    USUARIOS["usuarios/<br/>Users Data Module"]
    
    ANEXOS_INDEX["index.php<br/>TRACKED"]
    ANEXOS_DATA["Runtime Data<br/>IGNORED"]
    
    AVATAR_INDEX["index.php<br/>TRACKED"]
    AVATAR_DATA["User Images<br/>IGNORED"]
    
    COM_INDEX["index.php<br/>TRACKED"]
    COM_DATA["Communication Data<br/>IGNORED"]
    
    CORP_INDEX["index.php<br/>TRACKED"]
    CORP_CLASS["Corporation.php<br/>TRACKED"]
    CORP_DATA["Corporate Data<br/>IGNORED"]
    
    PROC_INDEX["index.php<br/>TRACKED"]
    PROC_DATA["Processing Data<br/>IGNORED"]
    
    RECURSOS_INDEX["index.php<br/>TRACKED"]
    RECURSOS_DATA["Resource Files<br/>IGNORED"]
    
    USUARIOS_INDEX["index.php<br/>TRACKED"]
    USUARIOS_DATA["User-Specific Data<br/>IGNORED"]
    
    REPO --> ANEXOS
    REPO --> AVATAR
    REPO --> COM
    REPO --> CORP
    REPO --> PROC
    REPO --> RECURSOS
    REPO --> USUARIOS
    
    ANEXOS --> ANEXOS_INDEX
    ANEXOS --> ANEXOS_DATA
    
    AVATAR --> AVATAR_INDEX
    AVATAR --> AVATAR_DATA
    
    COM --> COM_INDEX
    COM --> COM_DATA
    
    CORP --> CORP_INDEX
    CORP --> CORP_CLASS
    CORP --> CORP_DATA
    
    PROC --> PROC_INDEX
    PROC --> PROC_DATA
    
    RECURSOS --> RECURSOS_INDEX
    RECURSOS --> RECURSOS_DATA
    
    USUARIOS --> USUARIOS_INDEX
    USUARIOS --> USUARIOS_DATA
```

### Module Purposes

| Module | Directory | Inferred Purpose |
|--------|-----------|------------------|
| Attachments | `repo/anexos/` | Document attachment storage and management |
| Avatars | `repo/avatar/` | User profile image uploads and processing |
| Communication | `repo/com/` | Communication utilities or common resources |
| Corporate | `repo/corp/` | Corporate configuration (houses `Corporation.php`) |
| Processing | `repo/proc/` | Data processing operations and workflows |
| Resources | `repo/recursos/` | Static resource file management |
| Users | `repo/usuarios/` | User-specific data and file storage |

For detailed documentation of each module, see [Module System](#7).

**Sources:** [.gitignore:16-29]()

---

## Version Control Strategy

The `.gitignore` file implements a strategic pattern that separates version-controlled code from runtime-generated data.

### Git Ignore Pattern

```
# Ignore entire module directories
repo/anexos/*
repo/avatar/*
repo/proc/*
repo/com/*
repo/recursos/*
repo/usuarios/*

# But track module entry points
!repo/anexos/index.php
!repo/avatar/index.php
!repo/proc/index.php
!repo/com/index.php
!repo/recursos/index.php
!repo/usuarios/index.php
```

This pattern uses Git's negation rules (`!`) to explicitly track `index.php` files while ignoring everything else in module directories.

**Sources:** [.gitignore:15-29]()

### Tracked Files

| Category | Files | Rationale |
|----------|-------|-----------|
| Entry Points | `index.php`, `home.php` | Application bootstrap code |
| Source Code | `src/**/*.php` | All controllers, models, data layer, libraries |
| Module Entry Points | `repo/*/index.php` | Module routing and interface definitions |
| Static Assets | `css/`, `js/`, `data.json` | Version-controlled UI and configuration |
| Configuration | `Corporation.php` | System configuration constants |
| Documentation | `README.md` | Project documentation |

### Ignored Files

| Category | Pattern | Rationale |
|----------|---------|-----------|
| System Files | `.DS_Store`, `Thumbs.db` | OS-generated metadata |
| IDE Configuration | `.buildpath`, `.project`, `.settings/` | Editor-specific settings |
| Dependencies | `node_modules/`, `vendor/`, `dist/` | Package manager downloads |
| Module Runtime Data | `repo/*/* (except index.php)` | User uploads, generated content, cached data |

**Sources:** [.gitignore:1-14]()

---

## Architectural Benefits

### Code and Data Separation

The repository structure provides clear boundaries between:

```mermaid
graph TB
    subgraph "Version Control - Git Repository"
        CODE["Application Code<br/>src/**/*.php<br/>index.php, home.php"]
        ENTRY["Module Entry Points<br/>repo/*/index.php"]
        STATIC["Static Assets<br/>css/, js/"]
    end
    
    subgraph "Runtime Environment - Not in Git"
        UPLOADS["User Uploads<br/>repo/anexos/*<br/>repo/avatar/*"]
        GENERATED["Generated Data<br/>repo/proc/*<br/>repo/recursos/*"]
        USERDATA["User-Specific Data<br/>repo/usuarios/*"]
    end
    
    CODE -.->|"creates/modifies"| UPLOADS
    CODE -.->|"generates"| GENERATED
    CODE -.->|"stores"| USERDATA
    
    ENTRY -.->|"manages"| UPLOADS
    ENTRY -.->|"manages"| GENERATED
    ENTRY -.->|"manages"| USERDATA
```

### Key Advantages

1. **Security**: Prevents accidental commits of sensitive user data or uploaded files
2. **Clean Repository**: Keeps Git history focused on code changes, not data changes
3. **Multi-Environment Deployment**: Same codebase deploys to multiple environments with different runtime data
4. **Scalability**: Module structure allows horizontal scaling by adding new `repo/` directories
5. **Plugin Architecture**: New modules can be added without modifying core code
6. **Storage Flexibility**: Runtime data directories can be symlinked to separate storage volumes

**Sources:** [.gitignore:15-29]()

---

## Navigation and File Location

### Finding Controllers

All controllers are located in `src/`:

- Main application: [src/IndexCtrl.php]()
- Home page: [src/HomeCtrl.php]()
- Core operations: [src/OperacionesCtrl.php]()
- Home operations: [src/OperacionesHomeCtrl.php]()
- REST API: [src/Rest.php]()

### Finding Data Layer Components

Database interaction classes are in `src/`:

- Connection manager: [src/Singleton.php]()
- ORM base class: [src/Clsdatos.php]()
- Model classes: [src/modelo/]()

### Finding Libraries

Third-party and custom libraries are in [src/libs/]():

- API management: [src/libs/Apibox/]()
- Temporary pages: [src/libs/MagicPages/]()
- Email sending: [src/libs/PHPMailer-61/]()
- QR codes: [src/libs/phpqrcode/]()

### Finding Configuration

System configuration is split between:

- **Database and SMTP credentials**: [repo/corp/Corporation.php]() (see [System Configuration](#6.1))
- **Static data**: [data.json]() at repository root (see [Static Data Resources](#6.2))

### Finding Module Entry Points

Each module has a single entry point:

- `repo/anexos/index.php`
- `repo/avatar/index.php`
- `repo/com/index.php`
- `repo/corp/index.php`
- `repo/proc/index.php`
- `repo/recursos/index.php`
- `repo/usuarios/index.php`

**Note**: Most module entry points are currently empty or minimal, suggesting either incomplete implementation or that routing is delegated to the main controllers.

**Sources:** [.gitignore:24-29]()

---

## Adding New Modules

To add a new module to the system:

1. **Create module directory** under `repo/`:
   ```bash
   mkdir repo/newmodule
   ```

2. **Create entry point** with module interface:
   ```bash
   touch repo/newmodule/index.php
   ```

3. **Update .gitignore** to follow the pattern:
   ```gitignore
   # Ignore module contents
   repo/newmodule/*
   
   # Track entry point
   !repo/newmodule/index.php
   ```

4. **Implement routing** in the entry point or delegate to controllers

5. **Document the module** in [Module System](#7) section

This pattern ensures new modules follow the established architectural conventions.

**Sources:** [.gitignore:15-29]()

---

## Summary

The GESFINANCIERO repository structure implements a clean separation between:

- **Application code** (tracked in Git) in `src/` and entry points
- **Module interfaces** (tracked) as `repo/*/index.php` files
- **Runtime data** (ignored) in `repo/*/` subdirectories

This architecture supports:
- Secure version control without sensitive data commits
- Modular plugin-like extensibility
- Multi-environment deployments
- Clear code navigation patterns

For implementation details of specific components, see:
- [Application Entry Points](#2) for bootstrap process
- [Controller Layer](#3) for request handling
- [Business Logic Layer](#4) for operations
- [Data Layer](#5) for database interaction
- [Module System](#7) for individual module documentation

**Sources:** [.gitignore:1-30](), [README.md:1-92]()

---

---

## 2. Application Entry Points

## Purpose and Scope

This document provides an overview of the GESFINANCIERO application's two primary entry points: `index.php` and `home.php`. These files serve as the initial bootstrap and routing gateways for all HTTP requests into the system. This page covers their shared initialization sequence, differences in purpose, and how they delegate to their respective controllers.

For detailed documentation of each entry point's specific behavior, see:
- [Main Application Entry (index.php)](#2.1) - authenticated application interface
- [Home Application Entry (home.php)](#2.2) - public-facing home interface

For information about the controllers instantiated by these entry points, see [Controller Layer](#3).

## Overview

The GESFINANCIERO system uses a **dual entry point architecture** where requests are handled by one of two PHP files at the application root:

| Entry Point | Controller | Primary Purpose |
|-------------|-----------|-----------------|
| `index.php` | `IndexCtrl` | Main authenticated application interface with 100+ API endpoints |
| `home.php` | `HomeCtrl` | Public-facing home page with external authentication |

Both entry points follow an identical bootstrap sequence, differing only in which controller they instantiate. This design provides **separation of concerns** between public and authenticated contexts while maximizing code reuse in the initialization phase.

Sources: [index.php:1-19](), [home.php:1-19]()

## Entry Point Architecture

```mermaid
graph TB
    subgraph "HTTP Requests"
        REQ_AUTH["Authenticated<br/>Requests"]
        REQ_PUBLIC["Public/Home<br/>Requests"]
    end
    
    subgraph "Entry Points"
        INDEX["index.php"]
        HOME["home.php"]
    end
    
    subgraph "Bootstrap Sequence"
        BOOT["1. HTTP Headers<br/>2. Timezone Setup<br/>3. Error Reporting<br/>4. Dependency Loading"]
    end
    
    subgraph "Controllers"
        INDEXCTRL["IndexCtrl"]
        HOMECTRL["HomeCtrl"]
    end
    
    subgraph "Response"
        RENDER["render() method<br/>generates HTTP response"]
    end
    
    REQ_AUTH --> INDEX
    REQ_PUBLIC --> HOME
    
    INDEX --> BOOT
    HOME --> BOOT
    
    BOOT --> INDEX
    BOOT --> HOME
    
    INDEX --> INDEXCTRL
    HOME --> HOMECTRL
    
    INDEXCTRL --> RENDER
    HOMECTRL --> RENDER
```

**Entry Point Selection Diagram**

The web server configuration (not shown in code) routes requests to either entry point based on URL patterns or routing rules.

Sources: [index.php:1-19](), [home.php:1-19]()

## Bootstrap Sequence

Both entry points execute an identical multi-phase initialization sequence before instantiating their respective controllers:

### Phase 1: Environment Configuration

```mermaid
graph LR
    START["Request<br/>Received"] --> HEADER["Set UTF-8<br/>Header"]
    HEADER --> TZ["Configure<br/>Timezone"]
    TZ --> ERROR["Enable Error<br/>Reporting"]
```

**Phase 1: Environment Configuration**

| Step | Line | Action | Purpose |
|------|------|--------|---------|
| 1 | 1 | `header('Content-Type: text/html; charset=utf-8')` | Set response encoding to UTF-8 |
| 2 | 2 | `date_default_timezone_set('America/Bogota')` | Configure timezone for date/time operations |
| 3 | 3-4 | `error_reporting(E_ALL)` and `ini_set('display_errors', 1)` | Enable full error reporting for debugging |

Sources: [index.php:1-4](), [home.php:1-4]()

### Phase 2: Core System Loading

```mermaid
graph TB
    START["Phase 1<br/>Complete"] --> UTILES["Utiles.php<br/>Utility Functions"]
    UTILES --> CONFIG["Config.php<br/>Configuration"]
    CONFIG --> PAGINA["Pagina.php<br/>Page Management"]
    PAGINA --> CORREO["Correo.php<br/>Email Support"]
    CORREO --> NEXT["Phase 3"]
```

**Phase 2: Core System Components**

The entry points load fundamental system components in a specific order:

| Order | Component | File Path | Purpose |
|-------|-----------|-----------|---------|
| 1 | Utilities | `src/sistema/Utiles.php` | Helper functions including `IncluirArchivos()` |
| 2 | Configuration | `src/sistema/Config.php` | System configuration and constants |
| 3 | Page Management | `src/sistema/Pagina.php` | Page rendering utilities |
| 4 | Email | `src/sistema/Correo.php` | Email functionality support |

Sources: [index.php:5-8](), [home.php:5-8]()

### Phase 3: Data Layer Initialization

```mermaid
graph TB
    START["Phase 2<br/>Complete"] --> SINGLETON["Singleton.php<br/>DB Connection"]
    SINGLETON --> CLSDATOS["Clsdatos.php<br/>ORM Base"]
    CLSDATOS --> MODELS["Dynamic Model<br/>Loading"]
    MODELS --> NEXT["Phase 4"]
```

**Phase 3: Data Access Layer**

| Order | Component | File Path | Purpose |
|-------|-----------|-----------|---------|
| 1 | Database Manager | `src/datos/Singleton.php` | Singleton database connection manager |
| 2 | ORM Base | `src/datos/Clsdatos.php` | Base class for data access operations |
| 3 | Model Classes | `src/modelo/*` | Dynamically loaded using `Utiles::IncluirArchivos()` |

The dynamic model loading at [index.php:11]() and [home.php:11]() uses `Utiles::IncluirArchivos()` to automatically include all PHP files from the `src/modelo/` directory, enabling the Active Record pattern without explicit model registration.

Sources: [index.php:9-11](), [home.php:9-11]()

### Phase 4: Security and UI Components

```mermaid
graph TB
    START["Phase 3<br/>Complete"] --> SEGURIDAD["Seguridad.php<br/>Security"]
    SEGURIDAD --> MENUBAR["Menubar.php<br/>Menu Component"]
    MENUBAR --> HEADERBAR["Headerbar.php<br/>Header Component"]
    HEADERBAR --> QRLIB["qrlib.php<br/>QR Code Library"]
    QRLIB --> NEXT["Phase 5"]
```

**Phase 4: Security and Interface**

| Order | Component | File Path | Purpose |
|-------|-----------|-----------|---------|
| 1 | Security | `src/sistema/Seguridad.php` | Authentication and authorization |
| 2 | Menu Bar | `src/sistema/Menubar/Menubar.php` | Navigation menu component |
| 3 | Header Bar | `src/sistema/Headerbar/Headerbar.php` | Page header component |
| 4 | QR Library | `src/libs/phpqrcode/qrlib.php` | QR code generation |

Sources: [index.php:12-17](), [home.php:12-17]()

### Phase 5: Controller Loading and Execution

This phase differs between the two entry points:

#### index.php Specific Loading

```mermaid
graph LR
    START["Phase 4<br/>Complete"] --> CAMPOS["Campos.php<br/>Form Fields"]
    CAMPOS --> INDEXCTRL["IndexCtrl.php"]
    INDEXCTRL --> INSTANTIATE["new IndexCtrl()"]
    INSTANTIATE --> RENDER["render()"]
```

**index.php Controller Loading**

| Step | Line | Action | Purpose |
|------|------|--------|---------|
| 1 | 15 | Include `src/sistema/Campos.php` | Form field utilities (index.php only) |
| 2 | 16 | Include `src/ctrls/IndexCtrl.php` | Main controller class |
| 3 | 18 | `$index = new IndexCtrl()` | Instantiate controller |
| 4 | 19 | `$index->render()` | Execute controller logic |

Sources: [index.php:15-19]()

#### home.php Specific Loading

```mermaid
graph LR
    START["Phase 4<br/>Complete"] --> BOTH["IndexCtrl.php<br/>HomeCtrl.php"]
    BOTH --> INSTANTIATE["new HomeCtrl()"]
    INSTANTIATE --> RENDER["render()"]
```

**home.php Controller Loading**

| Step | Line | Action | Purpose |
|------|------|--------|---------|
| 1 | 15 | Include `src/ctrls/IndexCtrl.php` | Main controller (dependency) |
| 2 | 16 | Include `src/ctrls/HomeCtrl.php` | Home controller class |
| 3 | 18 | `$index = new HomeCtrl()` | Instantiate home controller |
| 4 | 19 | `$index->render()` | Execute controller logic |

Note: Despite the variable name `$index`, `home.php` instantiates `HomeCtrl`, not `IndexCtrl`. The variable naming is inconsistent.

Sources: [home.php:15-19]()

## Key Differences Between Entry Points

While the bootstrap sequence is nearly identical, the entry points differ in their final phase:

| Aspect | index.php | home.php |
|--------|-----------|----------|
| **Form Fields Library** | Includes `Campos.php` | Does not include `Campos.php` |
| **Controller Includes** | Only `IndexCtrl.php` | Both `IndexCtrl.php` and `HomeCtrl.php` |
| **Controller Instantiated** | `IndexCtrl` | `HomeCtrl` |
| **Primary Use Case** | Authenticated users, API endpoints | Public access, external authentication |
| **API Endpoints** | 100+ authenticated operations | Limited public operations |

The inclusion of both `IndexCtrl.php` and `HomeCtrl.php` in `home.php` suggests that `HomeCtrl` may have dependencies on `IndexCtrl` or shares certain functionality.

Sources: [index.php:15-19](), [home.php:15-19]()

## Complete Bootstrap Flow

```mermaid
sequenceDiagram
    participant WebServer
    participant EntryPoint as "index.php or<br/>home.php"
    participant Bootstrap as "Bootstrap<br/>Components"
    participant Controller as "IndexCtrl or<br/>HomeCtrl"
    participant Response as "HTTP Response"
    
    WebServer->>EntryPoint: "HTTP Request"
    
    EntryPoint->>EntryPoint: "header('Content-Type')"
    EntryPoint->>EntryPoint: "date_default_timezone_set()"
    EntryPoint->>EntryPoint: "error_reporting(E_ALL)"
    
    EntryPoint->>Bootstrap: "Include Utiles.php"
    EntryPoint->>Bootstrap: "Include Config.php"
    EntryPoint->>Bootstrap: "Include Pagina.php"
    EntryPoint->>Bootstrap: "Include Correo.php"
    
    EntryPoint->>Bootstrap: "Include Singleton.php"
    EntryPoint->>Bootstrap: "Include Clsdatos.php"
    EntryPoint->>Bootstrap: "Utiles::IncluirArchivos('src/modelo')"
    
    EntryPoint->>Bootstrap: "Include Seguridad.php"
    EntryPoint->>Bootstrap: "Include Menubar.php"
    EntryPoint->>Bootstrap: "Include Headerbar.php"
    EntryPoint->>Bootstrap: "Include qrlib.php"
    
    alt index.php
        EntryPoint->>Bootstrap: "Include Campos.php"
        EntryPoint->>Bootstrap: "Include IndexCtrl.php"
        EntryPoint->>Controller: "new IndexCtrl()"
    else home.php
        EntryPoint->>Bootstrap: "Include IndexCtrl.php"
        EntryPoint->>Bootstrap: "Include HomeCtrl.php"
        EntryPoint->>Controller: "new HomeCtrl()"
    end
    
    EntryPoint->>Controller: "render()"
    Controller->>Controller: "Process Request"
    Controller->>Response: "Generate Output"
    Response->>WebServer: "HTTP Response"
```

**Complete Bootstrap and Execution Sequence**

This diagram shows the complete flow from HTTP request receipt through bootstrap to controller execution and response generation.

Sources: [index.php:1-19](), [home.php:1-19]()

## Dependency Loading Order

The bootstrap sequence follows a carefully ordered dependency chain:

```mermaid
graph TB
    UTILES["Utiles<br/>Provides IncluirArchivos()"]
    CONFIG["Config<br/>System Configuration"]
    PAGINA["Pagina<br/>Page Utilities"]
    CORREO["Correo<br/>Email Support"]
    SINGLETON["Singleton<br/>Requires Config"]
    CLSDATOS["Clsdatos<br/>Requires Singleton"]
    MODELS["Models<br/>Extend Clsdatos<br/>Loaded via Utiles"]
    SEGURIDAD["Seguridad<br/>Uses Models"]
    UI["UI Components<br/>Menubar, Headerbar"]
    QRLIB["QR Library"]
    CONTROLLER["Controller<br/>Uses All Components"]
    
    UTILES --> CONFIG
    CONFIG --> PAGINA
    PAGINA --> CORREO
    CORREO --> SINGLETON
    SINGLETON --> CLSDATOS
    UTILES --> MODELS
    CLSDATOS --> MODELS
    MODELS --> SEGURIDAD
    SEGURIDAD --> UI
    UI --> QRLIB
    QRLIB --> CONTROLLER
```

**Dependency Loading Order**

The order ensures that:
1. **Utilities are available first** for use by subsequent components
2. **Configuration loads early** for use by database connections
3. **Data layer loads before models** since models extend `Clsdatos`
4. **Models load before security** since authentication may query user models
5. **UI components load last** before controller instantiation

Sources: [index.php:5-19](), [home.php:5-19]()

## Error Handling Configuration

Both entry points configure maximum error visibility:

```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

This configuration at [index.php:3-4]() and [home.php:3-4]() enables:
- **All error types reported**: Including notices, warnings, and deprecated features
- **Errors displayed in output**: Useful for development but should be disabled in production

**Security Consideration**: These settings are appropriate for development environments but expose sensitive information in production. Production deployments should use error logging instead of display.

Sources: [index.php:3-4](), [home.php:3-4]()

## Timezone Configuration

Both entry points set the application timezone to `America/Bogota` (Colombia):

```php
date_default_timezone_set('America/Bogota');
```

Note the inconsistency in capitalization:
- `index.php` uses `'America/Bogota'` (correct capitalization)
- `home.php` uses `'america/bogota'` (lowercase, but still valid)

This setting affects all date/time operations throughout the application, including database timestamps, email timestamps, and user interface displays.

Sources: [index.php:2](), [home.php:2]()

## Request Routing to Entry Points

While not shown in the entry point files themselves, request routing typically occurs at the web server level:

| URL Pattern | Entry Point | Purpose |
|-------------|-------------|---------|
| `/index.php` or `/` (default) | `index.php` | Main application |
| `/home.php` | `home.php` | Public home page |
| `/repo/*/index.php` | Module entry points | Module-specific operations |

The web server (Apache/Nginx) configuration determines which entry point handles each request based on URL patterns or rewrite rules.

## Entry Point Design Patterns

The dual entry point architecture demonstrates several design patterns:

### 1. Front Controller Pattern
Both `index.php` and `home.php` act as front controllers, providing a single entry point for their respective contexts (authenticated vs public).

### 2. Bootstrap Pattern
The identical initialization sequence in both files implements a consistent bootstrap pattern, ensuring all dependencies are loaded in the correct order.

### 3. Delegation Pattern
After bootstrapping, both entry points immediately delegate to their respective controllers via the `render()` method, maintaining separation of concerns.

### 4. Dependency Injection via Globals
By loading all dependencies at the entry point level, the system makes classes and utilities globally available through PHP's `include_once` mechanism, avoiding the need for explicit dependency injection.

Sources: [index.php:1-19](), [home.php:1-19]()

## Summary

The GESFINANCIERO application uses two nearly identical entry points that:

1. **Bootstrap the application** with a consistent 5-phase initialization sequence
2. **Load dependencies in order** to satisfy dependency chains
3. **Instantiate different controllers** for authenticated vs public contexts
4. **Delegate execution** to controller `render()` methods

This architecture provides:
- **Code reuse** through shared bootstrap logic
- **Separation of concerns** between public and authenticated interfaces
- **Consistent environment** for all application components
- **Clear execution flow** from entry to controller to response

For detailed information about what happens after controller instantiation, see [IndexCtrl - Main Application Controller](#3.1) and [HomeCtrl - Public Home Controller](#3.2).

Sources: [index.php:1-19](), [home.php:1-19]()

---

---

## 2.1 Main Application Entry (index.php)

## Purpose and Scope

This document describes the main application entry point `index.php`, which serves as the primary gateway for authenticated operations in the GESFINANCIERO system. It covers the bootstrap sequence, dependency loading, environment configuration, and the handoff to the main controller.

For the public-facing home entry point, see [Home Application Entry (home.php)](#2.2). For detailed information about the main controller that handles all authenticated operations, see [IndexCtrl - Main Application Controller](#3.1).

---

## File Overview

The `index.php` file is a 19-line bootstrap script that initializes the application environment and delegates all request handling to `IndexCtrl`.

**Key Responsibilities:**
- Configure HTTP headers and timezone
- Enable error reporting for debugging
- Load core system dependencies
- Dynamically include all model classes
- Instantiate the main controller
- Trigger the rendering pipeline

Sources: [index.php:1-19]()

---

## Bootstrap Sequence

The initialization process follows a strict dependency order to ensure all components are available when needed:

```mermaid
graph TD
    START["Request arrives at index.php"]
    HEADERS["Set HTTP Headers<br/>Content-Type: UTF-8"]
    TIMEZONE["Configure Timezone<br/>America/Bogota"]
    ERROR["Enable Error Reporting<br/>E_ALL, display_errors=1"]
    UTILES["Load Utiles<br/>src/sistema/Utiles.php"]
    CONFIG["Load Config<br/>src/sistema/Config.php"]
    PAGINA["Load Pagina<br/>src/sistema/Pagina.php"]
    CORREO["Load Correo<br/>src/sistema/Correo.php"]
    SINGLETON["Load Singleton<br/>src/datos/Singleton.php"]
    CLSDATOS["Load Clsdatos<br/>src/datos/Clsdatos.php"]
    MODELS["Dynamic Model Loading<br/>Utiles::IncluirArchivos<br/>src/modelo/*"]
    SEGURIDAD["Load Seguridad<br/>src/sistema/Seguridad.php"]
    MENUBAR["Load Menubar<br/>src/sistema/Menubar/Menubar.php"]
    HEADERBAR["Load Headerbar<br/>src/sistema/Headerbar/Headerbar.php"]
    CAMPOS["Load Campos<br/>src/sistema/Campos.php"]
    INDEXCTRL["Load IndexCtrl<br/>src/ctrls/IndexCtrl.php"]
    QRLIB["Load QR Library<br/>src/libs/phpqrcode/qrlib.php"]
    INSTANTIATE["Instantiate IndexCtrl<br/>$index = new IndexCtrl()"]
    RENDER["Execute render()<br/>$index->render()"]
    
    START --> HEADERS
    HEADERS --> TIMEZONE
    TIMEZONE --> ERROR
    ERROR --> UTILES
    UTILES --> CONFIG
    CONFIG --> PAGINA
    PAGINA --> CORREO
    CORREO --> SINGLETON
    SINGLETON --> CLSDATOS
    CLSDATOS --> MODELS
    MODELS --> SEGURIDAD
    SEGURIDAD --> MENUBAR
    MENUBAR --> HEADERBAR
    HEADERBAR --> CAMPOS
    CAMPOS --> INDEXCTRL
    INDEXCTRL --> QRLIB
    QRLIB --> INSTANTIATE
    INSTANTIATE --> RENDER
```

Sources: [index.php:1-19]()

---

## Environment Configuration

The first four lines configure the PHP runtime environment:

| Line | Configuration | Purpose |
|------|--------------|---------|
| 1 | `header('Content-Type: text/html; charset=utf-8')` | Set UTF-8 encoding for all output |
| 2 | `date_default_timezone_set('America/Bogota')` | Configure timezone for Colombia |
| 3 | `error_reporting(E_ALL)` | Enable all error types for debugging |
| 4 | `ini_set('display_errors', 1)` | Display errors directly in output |

**Note:** The error reporting configuration suggests this may be a development setting. Production deployments should reconfigure error display.

Sources: [index.php:1-4]()

---

## Dependency Loading Order

The dependency loading follows a layered architecture pattern:

### Layer 1: Core Utilities and Configuration

```mermaid
graph LR
    UTILES["Utiles.php<br/>Helper functions"]
    CONFIG["Config.php<br/>Application constants"]
    PAGINA["Pagina.php<br/>Base page class"]
    CORREO["Correo.php<br/>Email utilities"]
    
    UTILES --> CONFIG
    CONFIG --> PAGINA
    PAGINA --> CORREO
```

**Utiles** provides helper functions including file inclusion utilities. **Config** defines application-wide constants. **Pagina** serves as the base class for page rendering. **Correo** handles email operations.

Sources: [index.php:5-8]()

### Layer 2: Data Access Layer

```mermaid
graph LR
    SINGLETON["Singleton.php<br/>DB Connection Manager"]
    CLSDATOS["Clsdatos.php<br/>ORM Base Class"]
    
    SINGLETON --> CLSDATOS
```

**Singleton** manages database connections and provides query methods. **Clsdatos** implements the ORM pattern for data access. These must be loaded before models because models extend `Clsdatos`.

Sources: [index.php:9-10]()

### Layer 3: Dynamic Model Loading

```php
Utiles::IncluirArchivos( dirname( __FILE__ ) . '/src/modelo' );
```

This single line dynamically includes all PHP files in the `src/modelo/` directory, loading all model classes (e.g., `userselecto`, `perfilselecto`, `apibox`, etc.). Models are loaded after `Clsdatos` because they extend it.

Sources: [index.php:11]()

### Layer 4: Security and UI Components

```mermaid
graph LR
    SEGURIDAD["Seguridad.php<br/>Authentication & Authorization"]
    MENUBAR["Menubar.php<br/>Navigation menu component"]
    HEADERBAR["Headerbar.php<br/>Header UI component"]
    CAMPOS["Campos.php<br/>Form field utilities"]
    
    SEGURIDAD --> MENUBAR
    MENUBAR --> HEADERBAR
    HEADERBAR --> CAMPOS
```

**Seguridad** handles authentication and session management. **Menubar** and **Headerbar** provide UI components. **Campos** provides form field utilities.

Sources: [index.php:12-15]()

### Layer 5: Controller and Libraries

```mermaid
graph LR
    INDEXCTRL["IndexCtrl.php<br/>Main Controller"]
    QRLIB["qrlib.php<br/>QR Code Generation"]
    
    INDEXCTRL --> QRLIB
```

**IndexCtrl** is the main application controller with 100+ API endpoints. **qrlib** provides QR code generation capabilities.

Sources: [index.php:16-17]()

---

## Controller Instantiation and Execution

The final two lines instantiate and execute the controller:

```php
<?php $index = new IndexCtrl(); ?>
<?php $index->render(); ?>
```

### IndexCtrl Constructor Flow

When `new IndexCtrl()` is called, the constructor performs critical routing and authentication checks:

```mermaid
graph TD
    CONSTRUCT["IndexCtrl::__construct()"]
    SESSION_START["Start session if not exists"]
    USER_STATE["Check user state<br/>if logged in"]
    INACTIVE_CHECK{"User state > 1?<br/>(inactive/blocked)"}
    LOGOUT["Seguridad::logout()<br/>Redirect to login"]
    REST_CHECK{"PATH_INFO set?<br/>(REST API request)"}
    LOAD_REST["Load OperacionesCtrl<br/>Load Rest handler"]
    REST_HANDLER["Rest::handler()<br/>Process API request"]
    DIE_REST["die() - Terminate"]
    AJAX_CHECK{"POST['ajax'] set?"}
    URL_VERIFY["Verify session URL<br/>matches current URL"]
    AJAXL_CHECK{"REQUEST['ajaxl'] set?<br/>(file download)"}
    PROCESS_DOWNLOAD["Process file download<br/>CSV, PDF, etc."]
    AJAX_ROUTING["Route to appropriate<br/>API endpoint in OperacionesCtrl"]
    END["Constructor completes"]
    
    CONSTRUCT --> SESSION_START
    SESSION_START --> USER_STATE
    USER_STATE --> INACTIVE_CHECK
    INACTIVE_CHECK -->|Yes| LOGOUT
    INACTIVE_CHECK -->|No| REST_CHECK
    REST_CHECK -->|Yes| LOAD_REST
    LOAD_REST --> REST_HANDLER
    REST_HANDLER --> DIE_REST
    REST_CHECK -->|No| AJAX_CHECK
    AJAX_CHECK -->|Yes| URL_VERIFY
    URL_VERIFY --> AJAXL_CHECK
    AJAXL_CHECK -->|Yes| PROCESS_DOWNLOAD
    AJAXL_CHECK -->|No| AJAX_ROUTING
    AJAX_CHECK -->|No| END
```

**Key Behaviors:**
- **REST API requests** (identified by `PATH_INFO`) are handled immediately and execution terminates with `die()`
- **AJAX requests** are routed to appropriate endpoints and terminate with `die()` after sending JSON response
- **Page requests** allow the constructor to complete, then `render()` is called

Sources: [src/ctrls/IndexCtrl.php:1308-2603]()

### The render() Method

After the constructor completes (for non-API requests), the `render()` method handles page display:

```mermaid
graph TD
    RENDER["render() called"]
    SESSION["Ensure session started"]
    HEADER["Render Encabezado.phtml<br/>(header template)"]
    LOGIN_CHECK{"Seguridad::isLogin()?"}
    LOGOUT_CHECK{"logout parameter?"}
    DO_LOGOUT["Seguridad::logout()<br/>Redirect to index.php"]
    PAGEID_CHECK{"pageid parameter?"}
    LOAD_PAGE["Load requested page<br/>from tpls/"]
    LOAD_WORKSPACE["Load PAGINA_WORKSPACE<br/>(default page)"]
    PROCESS_LOGIN["Process login form<br/>$_POST['cmd']"]
    SHOW_LOGIN["Render PAGINA_LOGIN"]
    FOOTER["Render PAGINA_PIE<br/>(footer template)"]
    CLOSE_HTML["Close HTML tags"]
    
    RENDER --> SESSION
    SESSION --> HEADER
    HEADER --> LOGIN_CHECK
    LOGIN_CHECK -->|Yes| LOGOUT_CHECK
    LOGOUT_CHECK -->|Yes| DO_LOGOUT
    LOGOUT_CHECK -->|No| PAGEID_CHECK
    PAGEID_CHECK -->|Yes| LOAD_PAGE
    PAGEID_CHECK -->|No| LOAD_WORKSPACE
    LOGIN_CHECK -->|No| PROCESS_LOGIN
    PROCESS_LOGIN --> SHOW_LOGIN
    LOAD_PAGE --> FOOTER
    LOAD_WORKSPACE --> FOOTER
    SHOW_LOGIN --> FOOTER
    FOOTER --> CLOSE_HTML
```

**Authentication Flow:**
- If user is logged in: render requested page or workspace
- If user is not logged in: process login attempt or show login page
- All paths eventually render the footer and close HTML tags

Sources: [src/ctrls/IndexCtrl.php:2687-2761]()

---

## Request Processing Patterns

The application handles three distinct request types, all routed through `index.php`:

### 1. REST API Requests

**Identification:** Presence of `$_SERVER['PATH_INFO']`

**Flow:**
1. Constructor loads `OperacionesCtrl.php` and `Rest.php`
2. Calls `Rest::handler()` which validates Bearer tokens
3. Dispatches to business logic in `OperacionesCtrl`
4. Returns JSON response
5. Calls `die()` to prevent further execution

**Example:** `/index.php/api/v1/users/list`

Sources: [src/ctrls/IndexCtrl.php:1323-1334]()

### 2. AJAX/POST Requests

**Identification:** Presence of `$_POST['ajax']` parameter containing MD5 hash of API constant

**Flow:**
1. Constructor validates MD5 hash against API constant (e.g., `md5(self::API_UsuariosAdd)`)
2. Loads `OperacionesCtrl.php`
3. Routes to specific method in `OperacionesCtrl`
4. Returns JSON response
5. Calls `die()` to prevent rendering

**Example:** 
```javascript
// Frontend sends:
{ajax: md5('API_UsuariosAdd'), nombre: 'John', ...}
```

Sources: [src/ctrls/IndexCtrl.php:1401-2601]()

### 3. File Download Requests

**Identification:** Presence of `$_REQUEST['ajaxl']` parameter

**Flow:**
1. Constructor checks `ajaxl` hash against download constants
2. Routes to appropriate handler (`API_LNK_DESCARGAR_ALUMNOS`, `API_LNK_DESCARGAR_PDF`, etc.)
3. Sets appropriate headers (`Content-Type`, `Content-Disposition`)
4. Outputs file content
5. Calls `die()`

**Supported Downloads:**
- `API_LNK_DESCARGAR_ALUMNOS` - CSV export of employee data
- `API_LNK_DESCARGAR_PDF` - PDF document download
- `API_LNK_VISTA_PDF_PROC` - PDF process view
- `API_SESSION_ACTIVA` - Session status check (JSON)

Sources: [src/ctrls/IndexCtrl.php:1350-1398]()

### 4. Standard Page Requests

**Identification:** No special parameters, or `pageid` parameter present

**Flow:**
1. Constructor completes normally
2. `render()` method checks authentication
3. Loads appropriate page template from `src/tpls/`
4. Renders complete HTML response

Sources: [src/ctrls/IndexCtrl.php:2687-2760]()

---

## API Endpoint Registration

The `IndexCtrl` class defines over 100 API endpoint constants using the pattern `API_<Module><Action>`:

| Pattern | Example | Purpose |
|---------|---------|---------|
| `API_<Entity>Add` | `API_EmpleadosAdd` | Create new entity |
| `API_<Entity>Mod` | `API_EmpleadosMod` | Modify existing entity |
| `API_<Entity>Rm` | `API_EmpleadosRm` | Remove entity |
| `API_<Entity>Get` | `API_EmpleadosGet` | Retrieve entity data |
| `API_<Entity>GetAjax` | `API_EmpleadosGetAjax` | Retrieve for DataTables |
| `API_<Entity>HelperAdd` | `API_EmpleadosHelperAdd` | Helper operation for add |

**Routing Mechanism:**

```mermaid
graph LR
    CLIENT["Client sends<br/>POST['ajax'] = md5(constant)"]
    CONSTRUCTOR["IndexCtrl constructor<br/>receives request"]
    COMPARE["Compare against<br/>all API constants"]
    MATCH["Match found"]
    DELEGATE["Call corresponding<br/>OperacionesCtrl method"]
    JSON["Return JSON response"]
    DIE["die() - terminate"]
    
    CLIENT --> CONSTRUCTOR
    CONSTRUCTOR --> COMPARE
    COMPARE --> MATCH
    MATCH --> DELEGATE
    DELEGATE --> JSON
    JSON --> DIE
```

**Security:** The MD5 hash mechanism provides obscurity but not true security. API endpoints should be protected by session authentication and CSRF tokens.

Sources: [src/ctrls/IndexCtrl.php:314-1263](), [src/ctrls/IndexCtrl.php:1406-2600]()

---

## Integration Points

### Database Connection

The `Singleton` class loaded at line 9 establishes database connectivity. It reads credentials from `Corporation::DB_HOST`, `Corporation::DB_NAME`, `Corporation::DB_USER`, and `Corporation::DB_PASS`.

See [Singleton - Database Connection Manager](#5.1) for details.

Sources: [index.php:9]()

### Session Management

The `Seguridad` class loaded at line 12 manages authentication sessions. The constructor checks if users are active and logs them out if inactive.

See [Authentication System](#10.1) for details.

Sources: [index.php:12](), [src/ctrls/IndexCtrl.php:1312-1320]()

### Business Logic

The `OperacionesCtrl` class (loaded dynamically on demand) implements all business logic. The constructor loads it for REST API and AJAX requests.

See [OperacionesCtrl - Core Operations](#4.1) for details.

Sources: [src/ctrls/IndexCtrl.php:1326](), [src/ctrls/IndexCtrl.php:1402]()

---

## Error Handling

### Error Display Configuration

The entry point enables full error reporting:
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

**Security Concern:** This configuration exposes sensitive information in production. These settings should be disabled and errors logged to files instead.

Sources: [index.php:3-4]()

### Exception Handling in Constructor

All API endpoint handlers wrap operations in try-catch blocks:

```php
try {
    $ok = OperacionesCtrl::usuarios_Agregar($_POST);
    echo json_encode($ok);
} catch (Exception $ex) {
    $er = array("err" => $ex->getMessage());
    echo json_encode($er);
}
die("");
```

This pattern ensures JSON error responses even when operations fail.

Sources: [src/ctrls/IndexCtrl.php:1659-1666]()

---

## Security Considerations

### URL Verification

For AJAX requests, the constructor verifies the session URL matches the current request URL:

```php
if ( isset( $_SESSION["url"] ) ) {
    if ( trim(strtolower( $_SESSION["url"] )) != trim(strtolower( Utiles::getBaseUrl())) ) {
        Seguridad::logout();
        echo "<script type=\"text/javascript\">location.href='./index.php';</script>";
        die("");
    }
}
```

This prevents session hijacking across domains.

Sources: [src/ctrls/IndexCtrl.php:1339-1347]()

### User State Validation

The constructor checks if logged-in users are active:

```php
if( $_usu_tmp->getEstado_id() > 1){
    Seguridad::logout();
    echo "<script>alert('Usuario inactivo, bloqueado o eliminado'); location.href='./index.php';</script>";
    die("");
}
```

**User States:**
- `1` = Active
- `>1` = Inactive, blocked, or deleted

Sources: [src/ctrls/IndexCtrl.php:1315-1319]()

### API Constant Hashing

API endpoints are protected by MD5 hashing, requiring clients to know the constant name to call endpoints. While this provides obscurity, it is not a substitute for proper authentication and authorization.

Sources: [src/ctrls/IndexCtrl.php:1411-1419]()

---

## Relationship to Other Entry Points

### Comparison with home.php

| Feature | index.php | home.php |
|---------|-----------|----------|
| **Purpose** | Authenticated operations | Public home page |
| **Controller** | `IndexCtrl` | `HomeCtrl` |
| **Authentication** | Required for most operations | Not required |
| **API Endpoints** | 100+ endpoints | Limited public endpoints |
| **Typical Users** | Administrators, employees | External users, guests |

Both entry points follow similar bootstrap patterns but serve different audiences.

Sources: [index.php:1-19]()

---

## Performance Considerations

### Dynamic Model Loading

Line 11 loads all models in `src/modelo/` directory:
```php
Utiles::IncluirArchivos( dirname( __FILE__ ) . '/src/modelo' );
```

This loads every model file on every request, even if not needed. **Optimization opportunity:** Implement autoloading or lazy loading for models.

Sources: [index.php:11]()

### Early Termination Pattern

API and AJAX requests call `die()` after sending responses, preventing unnecessary page rendering. This is an efficient pattern that avoids loading templates for API calls.

Sources: [src/ctrls/IndexCtrl.php:1334](), [src/ctrls/IndexCtrl.php:1419]()

---

## Summary

The `index.php` entry point provides:

1. **Environment Configuration** - Sets timezone, encoding, and error reporting
2. **Layered Dependency Loading** - Loads utilities, data layer, models, security, UI, and controllers in order
3. **Multi-Pattern Request Handling** - Routes REST, AJAX, download, and page requests appropriately  
4. **Security Enforcement** - Validates sessions, user states, and URLs
5. **Clean Delegation** - Hands off all business logic to `IndexCtrl` and `OperacionesCtrl`

The file serves as a thin bootstrap layer that prepares the environment and delegates to the controller layer for all actual application logic.

Sources: [index.php:1-19](), [src/ctrls/IndexCtrl.php:1-2763]()

---

---

## 2.2 Home Application Entry (home.php)

## Purpose and Scope

This document describes `home.php`, the public-facing entry point for the GESFINANCIERO application. This file serves as the bootstrap for home-related operations including external authentication, public page rendering, and REST API access for the home context.

For documentation of the authenticated application entry point, see [Main Application Entry (index.php)](#2.1). For details on the controller instantiated by this entry point, see [HomeCtrl - Public Home Controller](#3.2). For business logic operations specific to the home context, see [OperacionesHomeCtrl - Home Operations](#4.2).

**Sources:** [home.php:1-19]()

---

## Overview

The `home.php` entry point provides a distinct initialization path from `index.php`, tailored for public-facing operations. It instantiates `HomeCtrl` instead of `IndexCtrl`, enabling a separate routing and authentication context suitable for unauthenticated users and external system integrations.

### Key Characteristics

| Aspect | Description |
|--------|-------------|
| **Entry File** | `home.php` |
| **Controller** | `HomeCtrl` |
| **Operations** | `OperacionesHomeCtrl` |
| **Primary Use Cases** | External authentication, public pages, REST API (home context) |
| **Session Management** | Session initialized on demand during render |
| **Template Location** | `src/tpls/home/` |

**Sources:** [home.php:1-19](), [src/ctrls/HomeCtrl.php:1-201]()

---

## Bootstrap Sequence

The `home.php` file follows a precise initialization sequence to set up the application environment before controller instantiation.

### Initialization Flow Diagram

```mermaid
sequenceDiagram
    participant Client
    participant home.php as home.php<br/>Entry Point
    participant System as System Files
    participant Data as Data Layer
    participant Models as Model Classes
    participant Security as Security Layer
    participant UI as UI Components
    participant HomeCtrl as HomeCtrl<br/>Controller
    
    Client->>home.php: "HTTP Request"
    
    home.php->>home.php: "Set UTF-8 header"
    home.php->>home.php: "Set timezone: america/bogota"
    home.php->>home.php: "Enable error reporting"
    
    home.php->>System: "Include Utiles.php"
    home.php->>System: "Include Config.php"
    home.php->>System: "Include Pagina.php"
    home.php->>System: "Include Correo.php"
    
    home.php->>Data: "Include Singleton.php"
    home.php->>Data: "Include Clsdatos.php"
    
    home.php->>Models: "Utiles::IncluirArchivos(src/modelo)"
    Models-->>home.php: "All models loaded"
    
    home.php->>Security: "Include Seguridad.php"
    
    home.php->>UI: "Include Menubar.php"
    home.php->>UI: "Include Headerbar.php"
    
    home.php->>System: "Include IndexCtrl.php"
    home.php->>System: "Include HomeCtrl.php"
    home.php->>System: "Include qrlib.php"
    
    home.php->>HomeCtrl: "new HomeCtrl()"
    HomeCtrl->>HomeCtrl: "__construct()"
    HomeCtrl-->>home.php: "Controller instance"
    
    home.php->>HomeCtrl: "render()"
    HomeCtrl-->>Client: "HTML Response"
```

**Sources:** [home.php:1-19]()

### Environment Configuration

The bootstrap process begins with environment setup:

```php
// Lines 1-4 from home.php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('america/bogota');
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

| Configuration | Value | Purpose |
|---------------|-------|---------|
| **Content-Type** | `text/html; charset=utf-8` | Ensures proper character encoding |
| **Timezone** | `america/bogota` | Sets Colombia timezone for date operations |
| **Error Reporting** | `E_ALL` | Reports all errors and warnings |
| **Display Errors** | `1` | Shows errors in output (development mode) |

**Sources:** [home.php:1-4]()

### Dependency Loading Sequence

Dependencies are loaded in a specific order to ensure proper class availability:

```mermaid
graph TD
    Start["Start Bootstrap"]
    
    Utiles["Utiles.php<br/>Utility functions"]
    Config["Config.php<br/>Configuration constants"]
    Pagina["Pagina.php<br/>Base page class"]
    Correo["Correo.php<br/>Email functionality"]
    
    Singleton["Singleton.php<br/>DB connection"]
    Clsdatos["Clsdatos.php<br/>ORM base class"]
    
    Models["src/modelo/*<br/>All model classes"]
    
    Seguridad["Seguridad.php<br/>Security utilities"]
    
    Menubar["Menubar.php<br/>Menu component"]
    Headerbar["Headerbar.php<br/>Header component"]
    
    IndexCtrl["IndexCtrl.php<br/>Main controller"]
    HomeCtrl["HomeCtrl.php<br/>Home controller"]
    QRLib["qrlib.php<br/>QR code library"]
    
    Instantiate["new HomeCtrl()"]
    Render["Controller render()"]
    
    Start --> Utiles
    Utiles --> Config
    Config --> Pagina
    Pagina --> Correo
    
    Correo --> Singleton
    Singleton --> Clsdatos
    
    Clsdatos --> Models
    
    Models --> Seguridad
    
    Seguridad --> Menubar
    Menubar --> Headerbar
    
    Headerbar --> IndexCtrl
    IndexCtrl --> HomeCtrl
    HomeCtrl --> QRLib
    
    QRLib --> Instantiate
    Instantiate --> Render
```

**Sources:** [home.php:5-19]()

### Key Dependencies

| Layer | Files | Purpose |
|-------|-------|---------|
| **System Utilities** | `Utiles.php`, `Config.php`, `Pagina.php`, `Correo.php` | Core system functionality and configuration |
| **Data Access** | `Singleton.php`, `Clsdatos.php` | Database connection and ORM |
| **Models** | `src/modelo/*` | Dynamically loaded data models |
| **Security** | `Seguridad.php` | Authentication and authorization utilities |
| **UI Components** | `Menubar.php`, `Headerbar.php` | Navigation and header rendering |
| **Controllers** | `IndexCtrl.php`, `HomeCtrl.php` | Request handling logic |
| **Libraries** | `qrlib.php` | QR code generation |

**Note:** Both `IndexCtrl.php` and `HomeCtrl.php` are loaded, allowing `HomeCtrl` to potentially reference `IndexCtrl` functionality if needed.

**Sources:** [home.php:5-17]()

---

## HomeCtrl Constructor Logic

The `HomeCtrl` constructor performs early request processing before the `render()` method is called. It handles three distinct request types through conditional logic.

### Constructor Request Flow

```mermaid
flowchart TD
    Constructor["HomeCtrl::__construct()"]
    
    LoadOp["Load OperacionesCtrl.php<br/>via renderCtrl()"]
    
    CheckREST{"PATH_INFO<br/>set?"}
    
    LoadRest["Load Rest.php<br/>via renderCtrl()"]
    CallRest["Rest::handler()"]
    DieRest["die() - terminate"]
    
    CheckPOST{"POST data<br/>exists?"}
    
    CheckAjax{"POST['ajax'] ==<br/>md5('Api/IntegraAutentica')?"}
    
    CallLogin["OperacionesHomeCtrl::LoginFromExterno()"]
    EchoJSON["echo json_encode(result)"]
    DieLogin["die() - terminate"]
    
    Continue["Continue to render()"]
    
    Constructor --> LoadOp
    LoadOp --> CheckREST
    
    CheckREST -->|Yes| LoadRest
    LoadRest --> CallRest
    CallRest --> DieRest
    
    CheckREST -->|No| CheckPOST
    CheckPOST -->|Yes| CheckAjax
    CheckPOST -->|No| Continue
    
    CheckAjax -->|Yes| CallLogin
    CallLogin --> EchoJSON
    EchoJSON --> DieLogin
    
    CheckAjax -->|No| Continue
```

**Sources:** [src/ctrls/HomeCtrl.php:58-87]()

### Request Type Handling

The constructor processes three request types in priority order:

#### 1. REST API Requests

When `$_SERVER['PATH_INFO']` is set, the request is treated as a REST API call:

```
Priority: HIGHEST
Detection: isset($_SERVER['PATH_INFO'])
Handler: Rest::handler()
Termination: die("") - prevents further processing
```

**Processing Steps:**
1. Load `Rest.php` via `renderCtrl()`
2. Call `Rest::handler()` to process the API request
3. Terminate execution immediately with `die("")`

**Sources:** [src/ctrls/HomeCtrl.php:64-69]()

#### 2. External Authentication (AJAX)

When `POST['ajax']` matches the MD5 hash of `'Api/IntegraAutentica'`:

```
Priority: MEDIUM
Detection: $_POST["ajax"] == md5("Api/IntegraAutentica")
Handler: OperacionesHomeCtrl::LoginFromExterno($_POST)
Termination: die("") - prevents further processing
```

**Processing Steps:**
1. Validate the AJAX token matches `md5("Api/IntegraAutentica")`
2. Call `OperacionesHomeCtrl::LoginFromExterno()` with POST data
3. Encode the result as JSON
4. Terminate execution with `die("")`

**Error Handling:**
- Wraps the call in a try-catch block
- Returns error message in JSON format on exception

**Sources:** [src/ctrls/HomeCtrl.php:71-84]()

#### 3. Standard Page Rendering

When neither REST API nor AJAX authentication conditions are met:

```
Priority: LOWEST (default)
Detection: No early termination
Handler: render() method (called after constructor)
Termination: Normal completion
```

The request flows through to the `render()` method for standard page display.

**Sources:** [src/ctrls/HomeCtrl.php:58-87]()

### Early Termination Pattern

The constructor uses `die("")` to prevent unnecessary processing:

| Request Type | Terminates Early? | Reason |
|--------------|------------------|---------|
| **REST API** | Yes | Response already sent by `Rest::handler()` |
| **AJAX Auth** | Yes | JSON response already echoed |
| **Page Render** | No | Needs full HTML rendering |

This pattern optimizes performance by avoiding template processing for API responses.

**Sources:** [src/ctrls/HomeCtrl.php:68, 82]()

---

## Page Rendering Process

When neither REST API nor AJAX authentication conditions are met, the `render()` method handles standard page display through a multi-stage template resolution process.

### Render Method Flow

```mermaid
flowchart TD
    Start["HomeCtrl::render()"]
    
    CheckSession{"Session<br/>started?"}
    StartSession["session_start()"]
    
    SetPaths["Set template paths:<br/>url_base = src/tpls/<br/>url_home = src/tpls/home/"]
    
    IncludeHeader["Include Encabezadohome.phtml"]
    
    CheckPageID{"pageid<br/>parameter<br/>exists?"}
    
    GetPageID["urlp = REQUEST['pageid']"]
    
    CheckWorkspace{"pageid ==<br/>PAGINA_WORKSPACE_HOME?"}
    
    LoadWorkspace["Load home workspace template"]
    
    CheckModelos{"File exists in<br/>modelos/ folder?"}
    
    ErrorModelos["Set error message<br/>Render PAGINA_ERROR"]
    
    CheckExists{"Template file<br/>exists?"}
    
    RenderTemplate["renderCtrl(template path)"]
    
    ErrorNotFound["Set error message<br/>Render PAGINA_ERROR"]
    
    DefaultWorkspace["Load default workspace<br/>PAGINA_WORKSPACE_HOME"]
    
    IncludeFooter["Render PAGINA_PIE_HOME"]
    
    CloseHTML["Echo closing body and html tags"]
    
    End["End"]
    
    Start --> CheckSession
    CheckSession -->|No| StartSession
    CheckSession -->|Yes| SetPaths
    StartSession --> SetPaths
    
    SetPaths --> IncludeHeader
    IncludeHeader --> CheckPageID
    
    CheckPageID -->|Yes| GetPageID
    CheckPageID -->|No| DefaultWorkspace
    
    GetPageID --> CheckWorkspace
    
    CheckWorkspace -->|Yes| LoadWorkspace
    CheckWorkspace -->|No| CheckModelos
    
    CheckModelos -->|Yes| ErrorModelos
    CheckModelos -->|No| CheckExists
    
    CheckExists -->|Yes| RenderTemplate
    CheckExists -->|No| ErrorNotFound
    
    LoadWorkspace --> IncludeFooter
    RenderTemplate --> IncludeFooter
    ErrorModelos --> IncludeFooter
    ErrorNotFound --> IncludeFooter
    DefaultWorkspace --> IncludeFooter
    
    IncludeFooter --> CloseHTML
    CloseHTML --> End
```

**Sources:** [src/ctrls/HomeCtrl.php:157-200]()

### Template Path Resolution

The rendering process uses a hierarchical template structure:

```mermaid
graph TD
    BaseTPL["src/tpls/<br/>Base template directory"]
    
    HomeTPL["src/tpls/home/<br/>Home-specific templates"]
    
    ModelosTPL["src/tpls/modelos/<br/>Model templates<br/>BLOCKED from pageid"]
    
    Header["Encabezadohome.phtml<br/>Always loaded first"]
    
    Workspace["PAGINA_WORKSPACE_HOME<br/>Default landing page"]
    
    CustomPage["Custom page from pageid<br/>Dynamic routing"]
    
    ErrorPage["PAGINA_ERROR<br/>Error template"]
    
    Footer["PAGINA_PIE_HOME<br/>Always loaded last"]
    
    BaseTPL --> HomeTPL
    BaseTPL --> ModelosTPL
    
    HomeTPL --> Header
    HomeTPL --> Workspace
    HomeTPL --> ErrorPage
    HomeTPL --> Footer
    
    BaseTPL --> CustomPage
```

**Sources:** [src/ctrls/HomeCtrl.php:162-193]()

### Page ID Routing Logic

The `pageid` parameter determines which template to load:

| Condition | Action | Template Path |
|-----------|--------|---------------|
| No `pageid` parameter | Load default workspace | `src/tpls/home/` + `Config::PAGINA_WORKSPACE_HOME` |
| `pageid` == `PAGINA_WORKSPACE_HOME` | Load workspace explicitly | `src/tpls/home/` + `Config::PAGINA_WORKSPACE_HOME` |
| `pageid` matches file in `modelos/` | Block and show error | `src/tpls/home/` + `Config::PAGINA_ERROR` |
| `pageid` file exists | Load custom page | `src/tpls/` + `pageid` |
| `pageid` file not found | Show error | `src/tpls/home/` + `Config::PAGINA_ERROR` |

**Security Feature:** The check for `modelos/` directory prevents direct access to model templates, which may contain sensitive internal structures.

**Sources:** [src/ctrls/HomeCtrl.php:166-193]()

### Session Management

Sessions are initialized on-demand during rendering:

```php
// Lines 158-160 from HomeCtrl.php
if(!isset($_SESSION)){
    session_start();
}
```

**Behavior:**
- Session starts only if not already active
- No session required for REST API or AJAX auth requests (handled before render)
- Enables session-based state for page navigation

**Sources:** [src/ctrls/HomeCtrl.php:158-160]()

### Template Rendering via renderCtrl()

The `renderCtrl()` method provides intelligent template loading with controller support:

```mermaid
flowchart TD
    Call["renderCtrl(rutaVista)"]
    
    ParsePath["pathinfo(rutaVista)<br/>Extract filename"]
    
    BuildCtrlPath["Construct controller path:<br/>ctrls/ + filename + 'Ctrl.php'"]
    
    CheckCtrl{"Controller file<br/>exists?"}
    
    IncludeCtrl["include_once controller file"]
    
    InstantiateCtrl["Instantiate controller class:<br/>filename + 'Ctrl'"]
    
    CallRender["Call controller->render()"]
    
    IncludeVista["include_once rutaVista"]
    
    End["End"]
    
    Call --> ParsePath
    ParsePath --> BuildCtrlPath
    BuildCtrlPath --> CheckCtrl
    
    CheckCtrl -->|Yes| IncludeCtrl
    CheckCtrl -->|No| IncludeVista
    
    IncludeCtrl --> InstantiateCtrl
    InstantiateCtrl --> CallRender
    CallRender --> End
    
    IncludeVista --> End
```

**Logic:**
1. Attempts to find a controller class matching the template filename
2. If found: Loads controller, instantiates it, calls its `render()` method
3. If not found: Includes the template file directly

This allows templates to have optional associated controller logic.

**Sources:** [src/ctrls/HomeCtrl.php:125-137]()

---

## Key Constants and Configuration

The `HomeCtrl` class defines several constants and relies on `Config` class constants for operation:

### HomeCtrl Constants

```php
const REPO_ARCHIVOS = "repo";
const API_RegEventos = 'Api/RegEventos';
const API_LoginAjaxUsr = 'Api/LoginAjaxUsr';
```

| Constant | Value | Purpose |
|----------|-------|---------|
| `REPO_ARCHIVOS` | `"repo"` | Repository directory for file storage |
| `API_RegEventos` | `'Api/RegEventos'` | API endpoint for event registration |
| `API_LoginAjaxUsr` | `'Api/LoginAjaxUsr'` | API endpoint for AJAX user login |

**Sources:** [src/ctrls/HomeCtrl.php:38-40]()

### Referenced Config Constants

The following constants from `Config` class control page routing:

| Constant | Purpose | Used In |
|----------|---------|---------|
| `Config::PAGINA_WORKSPACE_HOME` | Default home workspace template | Page routing logic |
| `Config::PAGINA_ERROR` | Error page template | Error handling |
| `Config::PAGINA_PIE_HOME` | Home footer template | Page rendering |

**Sources:** [src/ctrls/HomeCtrl.php:170, 174, 181, 186, 191, 195]()

---

## Integration with OperacionesHomeCtrl

The `HomeCtrl` delegates business logic to `OperacionesHomeCtrl`, which is loaded during constructor execution:

### Delegation Pattern

```mermaid
graph LR
    HomeCtrl["HomeCtrl<br/>Controller"]
    
    LoadOp["Load via renderCtrl()<br/>OperacionesCtrl.php"]
    
    OpHomeCtrl["OperacionesHomeCtrl<br/>Business Logic"]
    
    Methods["Key Methods:<br/>- LoginFromExterno()<br/>- activarCuenta()<br/>- LoginUsur()<br/>- LoginLdapUsur()"]
    
    HomeCtrl -->|"Constructor line 61"| LoadOp
    LoadOp -->|"Provides access to"| OpHomeCtrl
    OpHomeCtrl -->|"Contains"| Methods
```

**Loading Mechanism:**
```php
// Line 61 from HomeCtrl.php
$this->renderCtrl($url_baseCtrls . "OperacionesCtrl.php");
```

This loads `OperacionesCtrl.php`, which includes `OperacionesHomeCtrl.php` within it, making all home operations available to the controller.

**Sources:** [src/ctrls/HomeCtrl.php:60-61]()

### External Authentication Integration

The constructor specifically calls `OperacionesHomeCtrl::LoginFromExterno()` for external authentication:

```php
// Lines 75-77 from HomeCtrl.php
$ok = OperacionesHomeCtrl::LoginFromExterno( $_POST );
echo json_encode($ok);
```

**Flow:**
1. Client sends POST with `ajax` parameter set to `md5("Api/IntegraAutentica")`
2. `HomeCtrl` validates the token
3. Delegates to `OperacionesHomeCtrl::LoginFromExterno()`
4. Returns JSON response
5. Terminates with `die("")`

**Sources:** [src/ctrls/HomeCtrl.php:74-82]()

---

## JavaScript Namespace Generation

The `HomeCtrl` provides a utility method for generating unique JavaScript namespaces based on the application's host:

### JS_Name_get() Method

```mermaid
flowchart LR
    Start["JS_Name_get()"]
    
    GetBaseURL["Utiles::getBaseUrl()"]
    
    ParseURL["parse_url()<br/>Extract host"]
    
    RemoveDots["str_replace('.', '', host)"]
    
    AddPrefix["Prefix with 'acpp_'"]
    
    Return["Return namespace"]
    
    Start --> GetBaseURL
    GetBaseURL --> ParseURL
    ParseURL --> RemoveDots
    RemoveDots --> AddPrefix
    AddPrefix --> Return
```

**Example:**
```
Host: example.com
Result: acpp_examplecom

Host: app.finance.local
Result: acpp_appfinancelocal
```

**Purpose:** Creates unique JavaScript namespace identifiers to avoid conflicts when the application is embedded or runs on different domains.

**Sources:** [src/ctrls/HomeCtrl.php:101-105]()

---

## Comparison: home.php vs index.php

Understanding the differences between the two entry points clarifies their distinct roles:

| Aspect | home.php | index.php |
|--------|----------|-----------|
| **Controller** | `HomeCtrl` | `IndexCtrl` |
| **Operations Class** | `OperacionesHomeCtrl` | `OperacionesCtrl` |
| **Primary Purpose** | Public pages, external auth | Authenticated application |
| **Session Init** | On-demand in render() | Typically earlier |
| **Template Base** | `src/tpls/home/` | `src/tpls/` |
| **Default Page** | Workspace home | Application dashboard |
| **External Auth** | Yes (via AJAX) | No |
| **API Access** | Home context REST | Main application REST |
| **Authentication Required** | No (public access) | Yes (authenticated users) |

### Request Flow Comparison

```mermaid
sequenceDiagram
    participant Client
    participant Entry as Entry Point
    participant Ctrl as Controller
    participant Ops as Operations
    
    rect 
        note right of Client: home.php Flow
        Client->>Entry: "Request home.php"
        Entry->>Ctrl: "new HomeCtrl()"
        Ctrl->>Ops: "Load OperacionesHomeCtrl"
        Ctrl->>Ctrl: "Handle REST/AJAX/Page"
        Ctrl->>Client: "Public response"
    end
    
    rect 
        note right of Client: index.php Flow
        Client->>Entry: "Request index.php"
        Entry->>Ctrl: "new IndexCtrl()"
        Ctrl->>Ops: "Load OperacionesCtrl"
        Ctrl->>Ctrl: "Check authentication"
        Ctrl->>Ctrl: "Handle REST/AJAX/Page"
        Ctrl->>Client: "Authenticated response"
    end
```

**Sources:** [home.php:1-19](), [src/ctrls/HomeCtrl.php:1-201]()

---

## Request Processing Summary

The `home.php` entry point processes requests through a priority-based system:

### Complete Request Flow

```mermaid
stateDiagram-v2
    [*] --> Bootstrap
    
    Bootstrap: Environment Setup
    Bootstrap: Load Dependencies
    Bootstrap: Load Models
    
    Bootstrap --> Constructor
    
    Constructor: HomeCtrl::__construct()
    
    state Constructor {
        [*] --> LoadOperations
        LoadOperations: Load OperacionesCtrl.php
        
        LoadOperations --> CheckRESTAPI
        CheckRESTAPI: PATH_INFO set?
        
        CheckRESTAPI --> RESTHandler: Yes
        RESTHandler: Rest::handler()
        RESTHandler --> [*]: die()
        
        CheckRESTAPI --> CheckAJAX: No
        CheckAJAX: AJAX auth request?
        
        CheckAJAX --> AJAXHandler: Yes
        AJAXHandler: LoginFromExterno()
        AJAXHandler --> [*]: die()
        
        CheckAJAX --> Continue: No
    }
    
    Constructor --> Render: No early termination
    
    Render: HomeCtrl::render()
    
    state Render {
        [*] --> InitSession
        InitSession: Start session if needed
        
        InitSession --> LoadHeader
        LoadHeader: Include Encabezadohome.phtml
        
        LoadHeader --> RouteRequest
        RouteRequest: Determine page from pageid
        
        RouteRequest --> LoadTemplate
        LoadTemplate: renderCtrl(template)
        
        LoadTemplate --> LoadFooter
        LoadFooter: Include PAGINA_PIE_HOME
        
        LoadFooter --> CloseHTML
        CloseHTML: Echo closing tags
    }
    
    Render --> [*]
```

**Sources:** [home.php:1-19](), [src/ctrls/HomeCtrl.php:58-200]()

---

## Security Considerations

### Protection Against Direct Model Access

The rendering logic explicitly blocks access to files in the `modelos/` directory:

```php
// Lines 172-175 from HomeCtrl.php
if( file_exists($url_base . "modelos/" . $urlp)){
    $this->setMensaje("P&aacute;gina no existente!");
    $this->renderCtrl( $url_home . Config::PAGINA_ERROR );
}
```

**Purpose:** Prevents users from directly accessing internal model templates via URL manipulation.

**Sources:** [src/ctrls/HomeCtrl.php:172-175]()

### AJAX Authentication Token

External authentication requires a pre-shared token:

```
Required Token: md5("Api/IntegraAutentica")
```

**Mechanism:**
- Calling system must know the secret string `"Api/IntegraAutentica"`
- Must compute the MD5 hash of this string
- Pass as `POST['ajax']` parameter

**Limitation:** MD5 hashing of a static string provides minimal security. This should be upgraded to time-based tokens or proper OAuth flows.

**Sources:** [src/ctrls/HomeCtrl.php:74]()

### Error Display Configuration

Error reporting is enabled in the bootstrap:

```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

**Security Risk:** This configuration is suitable for development but should be disabled in production to avoid information disclosure.

**Sources:** [home.php:3-4]()

---

## Usage Examples

### Example 1: Standard Page Access

**Request:**
```
GET https://example.com/home.php?pageid=about.phtml
```

**Processing:**
1. Bootstrap loads dependencies
2. `HomeCtrl` constructor loads operations, checks for REST/AJAX (neither present)
3. `render()` method executes
4. Session starts if needed
5. Header template loads
6. `pageid` parameter found: `about.phtml`
7. Checks `about.phtml` exists in `src/tpls/`
8. Calls `renderCtrl("src/tpls/about.phtml")`
9. Footer template loads
10. HTML closing tags output

**Sources:** [src/ctrls/HomeCtrl.php:166-193]()

### Example 2: REST API Call

**Request:**
```
POST https://example.com/home.php/api/users
Authorization: Bearer <token>
```

**Processing:**
1. Bootstrap loads dependencies
2. `HomeCtrl` constructor detects `$_SERVER['PATH_INFO']` = `/api/users`
3. Loads `Rest.php` via `renderCtrl()`
4. Calls `Rest::handler()`
5. REST handler processes the API request
6. Response sent
7. Execution terminates with `die("")`
8. `render()` method never executes

**Sources:** [src/ctrls/HomeCtrl.php:64-69]()

### Example 3: External Authentication

**Request:**
```
POST https://example.com/home.php
Content-Type: application/x-www-form-urlencoded

ajax=<md5_hash>&username=user@example.com&password=secret
```

**Processing:**
1. Bootstrap loads dependencies
2. `HomeCtrl` constructor checks `PATH_INFO` (not set)
3. Checks `$_POST['ajax']` == `md5("Api/IntegraAutentica")` (match)
4. Calls `OperacionesHomeCtrl::LoginFromExterno($_POST)`
5. Encodes result as JSON
6. Outputs JSON response
7. Execution terminates with `die("")`
8. `render()` method never executes

**Sources:** [src/ctrls/HomeCtrl.php:73-82]()

### Example 4: Default Landing Page

**Request:**
```
GET https://example.com/home.php
```

**Processing:**
1. Bootstrap loads dependencies
2. `HomeCtrl` constructor finds no REST/AJAX conditions
3. `render()` method executes
4. No `pageid` parameter found
5. Loads default workspace: `Config::PAGINA_WORKSPACE_HOME`
6. Renders complete page with header and footer

**Sources:** [src/ctrls/HomeCtrl.php:190-192]()

---

## File References

### Core Files

| File | Purpose |
|------|---------|
| `home.php` | Entry point bootstrap |
| `src/ctrls/HomeCtrl.php` | Home controller implementation |
| `src/ctrls/OperacionesCtrl.php` | Contains `OperacionesHomeCtrl` |
| `src/ctrls/Rest.php` | REST API handler |
| `src/tpls/home/Encabezadohome.phtml` | Home page header template |
| `src/tpls/home/` + `Config::PAGINA_ERROR` | Error page template |
| `src/tpls/home/` + `Config::PAGINA_WORKSPACE_HOME` | Default workspace template |
| `src/tpls/home/` + `Config::PAGINA_PIE_HOME` | Home page footer template |

**Sources:** [home.php:1-19](), [src/ctrls/HomeCtrl.php:1-201]()

---

## Related Documentation

- For the authenticated application entry point, see [Main Application Entry (index.php)](#2.1)
- For controller details, see [HomeCtrl - Public Home Controller](#3.2)
- For REST API implementation, see [Rest - REST API Handler](#3.3)
- For business logic operations, see [OperacionesHomeCtrl - Home Operations](#4.2)
- For configuration constants, see [System Configuration (Corporation.php)](#6.1)
- For authentication mechanisms, see [Authentication System](#10.1)

---

---

## 3. Controller Layer

## Purpose and Scope

The Controller Layer manages HTTP request routing, API endpoint dispatch, authentication, and serves as the interface between client requests and business logic operations. This layer consists of three primary controllers that handle different application contexts: authenticated operations, public-facing pages, and REST API requests.

For detailed implementation of individual controllers, see [IndexCtrl - Main Application Controller](#3.1), [HomeCtrl - Public Home Controller](#3.2), and [Rest - REST API Handler](#3.3). For business logic operations that controllers delegate to, see [Business Logic Layer](#4).

## Controller Architecture Overview

The system employs three specialized controllers, each with distinct responsibilities:

```mermaid
graph TB
    subgraph "Entry Points"
        INDEX["index.php"]
        HOME["home.php"]
    end
    
    subgraph "Controller Layer"
        INDEXCTRL["IndexCtrl<br/>src/ctrls/IndexCtrl.php"]
        HOMECTRL["HomeCtrl<br/>src/ctrls/HomeCtrl.php"]
        REST["Rest<br/>src/ctrls/Rest.php"]
    end
    
    subgraph "Business Logic"
        OPCTRL["OperacionesCtrl<br/>src/ctrls/OperacionesCtrl.php"]
        OPHOMECTRL["OperacionesHomeCtrl<br/>src/ctrls/OperacionesHomeCtrl.php"]
    end
    
    subgraph "Data Layer"
        SINGLETON["Singleton"]
        MODELS["Model Classes"]
    end
    
    INDEX --> INDEXCTRL
    HOME --> HOMECTRL
    
    INDEXCTRL -->|"PATH_INFO set"| REST
    HOMECTRL -->|"PATH_INFO set"| REST
    
    INDEXCTRL -->|"delegates to"| OPCTRL
    HOMECTRL -->|"delegates to"| OPHOMECTRL
    REST -->|"delegates to"| OPCTRL
    
    OPCTRL --> SINGLETON
    OPHOMECTRL --> SINGLETON
    
    SINGLETON --> MODELS
```

**Architecture Components:**

| Controller | File | Primary Role | Entry Point |
|------------|------|--------------|-------------|
| `IndexCtrl` | `src/ctrls/IndexCtrl.php` | Authenticated operations, 100+ AJAX endpoints | `index.php` |
| `HomeCtrl` | `src/ctrls/HomeCtrl.php` | Public-facing pages, external authentication | `home.php` |
| `Rest` | `src/ctrls/Rest.php` | REST API with Bearer token authentication | `PATH_INFO` routing |

**Sources:** [src/ctrls/IndexCtrl.php:1-2500](), [src/ctrls/HomeCtrl.php:1-201](), [src/ctrls/Rest.php:1-276]()

## Request Processing Flow

The controller layer handles three distinct request types, each following a different processing path:

```mermaid
sequenceDiagram
    participant Client
    participant EntryPoint as "Entry Point<br/>(index.php/home.php)"
    participant Controller as "Controller<br/>(IndexCtrl/HomeCtrl)"
    participant Rest as "Rest Handler"
    participant Operations as "Operations Layer"
    participant DB as "Database"
    
    alt REST API Request
        Client->>EntryPoint: "HTTP + PATH_INFO"
        EntryPoint->>Controller: "__construct()"
        Controller->>Controller: "Check PATH_INFO"
        Controller->>Rest: "Rest::handler()"
        Rest->>Rest: "Validate Bearer Token"
        Rest->>Operations: "Delegate to method"
        Operations->>DB: "Query/Update"
        DB-->>Operations: "Result"
        Operations-->>Rest: "JSON Response"
        Rest->>Rest: "die()"
    else AJAX Request
        Client->>EntryPoint: "POST with ajax param"
        EntryPoint->>Controller: "__construct()"
        Controller->>Controller: "Match md5(endpoint)"
        Controller->>Operations: "Call operation method"
        Operations->>DB: "Query/Update"
        DB-->>Operations: "Result"
        Operations-->>Controller: "JSON Response"
        Controller->>Controller: "die()"
    else Page Render
        Client->>EntryPoint: "GET Request"
        EntryPoint->>Controller: "__construct()"
        Controller->>Controller: "render()"
        Controller->>Operations: "Load page data"
        Operations->>DB: "Query"
        DB-->>Operations: "Result"
        Operations-->>Controller: "Data"
        Controller->>Controller: "Include template"
        Controller-->>Client: "HTML Response"
    end
```

**Request Type Detection:**

1. **REST API**: Detected by `$_SERVER['PATH_INFO']` presence at [src/ctrls/IndexCtrl.php:1323-1334]()
2. **AJAX**: Detected by `$_POST["ajax"]` parameter at [src/ctrls/IndexCtrl.php:1401-1406]()
3. **Page Render**: Default case when neither REST nor AJAX conditions match

**Sources:** [src/ctrls/IndexCtrl.php:1308-1400](), [src/ctrls/HomeCtrl.php:58-86]()

## API Endpoint Management

The system uses two distinct API patterns that coexist in the codebase:

### AJAX Endpoint Pattern

AJAX endpoints are defined as class constants with MD5-hashed identifiers:

```mermaid
graph LR
    subgraph "IndexCtrl Constants"
        CONST1["API_EmpleadosAdd<br/>'API_EmpleadosAdd'"]
        CONST2["API_UsuariosAdd<br/>'API_UsuariosAdd'"]
        CONST3["API_PlantillasAdd<br/>'API_plantillasAdd'"]
    end
    
    subgraph "Constructor Routing"
        HASH1["md5(API_EmpleadosAdd)"]
        HASH2["md5(API_UsuariosAdd)"]
        HASH3["md5(API_plantillasAdd)"]
    end
    
    subgraph "OperacionesCtrl Methods"
        OP1["Empleados_Agregar()"]
        OP2["usuarios_Agregar()"]
        OP3["editarPlantillas_Agregar()"]
    end
    
    CONST1 --> HASH1
    CONST2 --> HASH2
    CONST3 --> HASH3
    
    HASH1 --> OP1
    HASH2 --> OP2
    HASH3 --> OP3
```

**AJAX Endpoint Dispatch Example:**

```php
// Client sends: $_POST["ajax"] = md5("API_EmpleadosAdd")
if ($_POST["ajax"] == md5(self::API_EmpleadosAdd)) {
    $ok = OperacionesCtrl::Empleados_Agregar($_POST);
    echo json_encode($ok);
    die("");
}
```

Defined at [src/ctrls/IndexCtrl.php:1523-1532]() and similar patterns throughout the constructor.

### REST Endpoint Pattern

REST endpoints use Bearer token authentication and method-based routing:

```mermaid
graph TB
    subgraph "REST Handler Flow"
        REQUEST["HTTP Request<br/>PATH_INFO set"]
        TOKEN["getBearerToken()"]
        VALIDATE["CompararToken()"]
        
        subgraph "Method Dispatch"
            GET["GET: Method discovery"]
            POST["POST: Execute operation"]
            PUT["PUT: Update operation"]
            DELETE["DELETE: Remove operation"]
        end
        
        METHOD["Method Execution<br/>tkn_{methodName}"]
        RESPONSE["JSON Response"]
    end
    
    REQUEST --> TOKEN
    TOKEN --> VALIDATE
    VALIDATE -->|"valid"| GET
    VALIDATE -->|"valid"| POST
    VALIDATE -->|"valid"| PUT
    VALIDATE -->|"valid"| DELETE
    VALIDATE -->|"invalid"| RESPONSE
    
    POST --> METHOD
    METHOD --> RESPONSE
```

**Token Validation:** Performed at [src/ctrls/Rest.php:123-163]()  
**Method Dispatch:** Handled at [src/ctrls/Rest.php:202-274]()

**Sources:** [src/ctrls/IndexCtrl.php:314-1274](), [src/ctrls/Rest.php:114-275]()

## Controller Responsibilities Matrix

Each controller has specific functional domains:

| Functional Domain | IndexCtrl | HomeCtrl | Rest |
|-------------------|-----------|----------|------|
| **User Management** | ✓ CRUD operations | External auth only | ✓ Token-based access |
| **Employee Management** | ✓ Full CRUD | ✗ | ✓ Token-based access |
| **Document/Workflow** | ✓ Templates, flows, packages | ✗ | ✓ Token-based access |
| **Authentication** | ✓ Session-based | ✓ LDAP/external | ✓ Bearer tokens |
| **Page Rendering** | ✓ Authenticated pages | ✓ Public pages | ✗ |
| **File Downloads** | ✓ CSV, PDF | ✗ | ✗ |
| **Session Management** | ✓ Checks & validation | ✓ Initialization | ✗ |

**IndexCtrl Functional Groups:**

```mermaid
graph TB
    INDEXCTRL["IndexCtrl"]
    
    subgraph "User Management"
        USER_CRUD["API_UsuariosAdd<br/>API_UsuariosMod<br/>API_UsuariosRm"]
        USER_GET["API_UsuariosGet<br/>API_UsuariosGetAjax"]
        USER_HELPER["API_UsuariosHelperGet<br/>API_AdminHelperAdd"]
    end
    
    subgraph "Employee Management"
        EMP_CRUD["API_EmpleadosAdd<br/>API_EmpleadosMod<br/>API_EmpleadosRm"]
        EMP_GET["API_EmpleadosGet<br/>API_EmpleadosGetAjax"]
        EMP_ACTIVATE["API_EmpleadosActivar"]
    end
    
    subgraph "Document & Workflow"
        TEMPLATE["API_plantillasAdd<br/>API_plantillasDel"]
        FLOW["API_FlujosHelperAdd<br/>API_FlujosGetAjax"]
        PACKAGE["API_PaquetesGetAjax<br/>API_PaquetesHelperAdd"]
    end
    
    subgraph "System Operations"
        CONFIG["API_AgregarConfigCorp"]
        AUTH["API_LoginSystemAjax"]
        FIRMA["API_FirmasGet<br/>API_FirmasproHelperAdd"]
    end
    
    INDEXCTRL --> USER_CRUD
    INDEXCTRL --> USER_GET
    INDEXCTRL --> USER_HELPER
    INDEXCTRL --> EMP_CRUD
    INDEXCTRL --> EMP_GET
    INDEXCTRL --> EMP_ACTIVATE
    INDEXCTRL --> TEMPLATE
    INDEXCTRL --> FLOW
    INDEXCTRL --> PACKAGE
    INDEXCTRL --> CONFIG
    INDEXCTRL --> AUTH
    INDEXCTRL --> FIRMA
```

**Sources:** [src/ctrls/IndexCtrl.php:36-1274]()

## Authentication and Session Management

The controller layer implements multiple authentication mechanisms:

```mermaid
graph TB
    subgraph "Authentication Methods"
        SESSION["Session-Based<br/>$_SESSION['usu']"]
        BEARER["Bearer Token<br/>Authorization header"]
        BASIC["Basic Auth<br/>Username:Password"]
        EXTERNAL["External Auth<br/>LDAP/Social"]
    end
    
    subgraph "IndexCtrl Flow"
        IDX_START["__construct()"]
        IDX_SESSION["Check $_SESSION['usu']"]
        IDX_STATE["Check user state"]
        IDX_URL["Validate session URL"]
        IDX_PROCESS["Process request"]
    end
    
    subgraph "HomeCtrl Flow"
        HOME_START["__construct()"]
        HOME_AJAX["Check $_POST['ajax']"]
        HOME_AUTH["LoginFromExterno()"]
        HOME_RENDER["render()"]
    end
    
    subgraph "Rest Flow"
        REST_TOKEN["getBearerToken()"]
        REST_VALIDATE["CompararToken()"]
        REST_EXPIRE["Check expiration"]
        REST_DISPATCH["Dispatch method"]
    end
    
    SESSION --> IDX_START
    EXTERNAL --> HOME_START
    BEARER --> REST_TOKEN
    
    IDX_START --> IDX_SESSION
    IDX_SESSION --> IDX_STATE
    IDX_STATE --> IDX_URL
    IDX_URL --> IDX_PROCESS
    
    HOME_START --> HOME_AJAX
    HOME_AJAX --> HOME_AUTH
    HOME_AUTH --> HOME_RENDER
    
    REST_TOKEN --> REST_VALIDATE
    REST_VALIDATE --> REST_EXPIRE
    REST_EXPIRE --> REST_DISPATCH
```

**Session Validation in IndexCtrl:**

The constructor validates user session state at [src/ctrls/IndexCtrl.php:1312-1320]():

- Checks if user state is inactive/blocked/deleted (`getEstado_id() > 1`)
- Forces logout and redirects if invalid
- Validates session URL matches current base URL at [src/ctrls/IndexCtrl.php:1337-1348]()

**Token Authentication in Rest:**

Bearer token validation at [src/ctrls/Rest.php:123-163]():

- Extracts token from Authorization header
- Compares against stored tokens via `CompararToken()`
- Validates token expiration using configured timeout
- Returns 401 Unauthorized for invalid/expired/disabled tokens

**Sources:** [src/ctrls/IndexCtrl.php:1308-1350](), [src/ctrls/HomeCtrl.php:58-86](), [src/ctrls/Rest.php:114-163]()

## Integration with Business Logic Layer

Controllers act as thin dispatch layers that delegate to business logic classes:

```mermaid
graph TB
    subgraph "Controllers"
        INDEXCTRL["IndexCtrl"]
        HOMECTRL["HomeCtrl"]
        REST["Rest"]
    end
    
    subgraph "Business Logic Layer"
        OPCTRL["OperacionesCtrl"]
        OPHOMECTRL["OperacionesHomeCtrl"]
    end
    
    subgraph "Example Operations"
        OP1["Empleados_Agregar()"]
        OP2["usuarios_Modificar()"]
        OP3["firmaspro_Helper_FirmarDoc()"]
        OP4["LoginFromExterno()"]
        OP5["AutenticaUsuarioSisAjax()"]
    end
    
    INDEXCTRL -->|"User Management"| OP1
    INDEXCTRL -->|"User Management"| OP2
    INDEXCTRL -->|"Digital Signatures"| OP3
    
    HOMECTRL -->|"External Auth"| OP4
    
    REST -->|"Authentication"| OP5
    REST -->|"All Operations"| OPCTRL
    
    OP1 --> OPCTRL
    OP2 --> OPCTRL
    OP3 --> OPCTRL
    OP4 --> OPHOMECTRL
    OP5 --> OPCTRL
```

**Delegation Pattern:**

All controllers follow this pattern for business logic delegation:

```php
// 1. Receive request
if ($_POST["ajax"] == md5(self::API_EmpleadosAdd)) {
    try {
        // 2. Delegate to OperacionesCtrl
        $ok = OperacionesCtrl::Empleados_Agregar($_POST);
        // 3. Return JSON response
        echo json_encode($ok);
    } catch (Exception $ex) {
        // 4. Handle errors
        $er = array("err" => $ex->getMessage());
        echo json_encode($er);
    }
    die("");
}
```

**Controller Loading:**

Both `IndexCtrl` and `HomeCtrl` load `OperacionesCtrl` in their constructors:

- IndexCtrl at [src/ctrls/IndexCtrl.php:1326-1327]()
- HomeCtrl at [src/ctrls/HomeCtrl.php:60-61]()

This ensures business logic is available before any operations are processed.

**Sources:** [src/ctrls/IndexCtrl.php:1402-1532](), [src/ctrls/HomeCtrl.php:60-61](), [src/ctrls/Rest.php:15-68]()

## Error Handling and Response Patterns

Controllers implement consistent error handling across all endpoints:

```mermaid
graph LR
    subgraph "Try-Catch Pattern"
        TRY["try block<br/>Call operation"]
        SUCCESS["Success path<br/>echo json_encode(ok)"]
        CATCH["catch Exception<br/>Build error array"]
        ERROR["Error path<br/>echo json_encode(err)"]
        DIE["die() - Terminate"]
    end
    
    TRY --> SUCCESS
    TRY --> CATCH
    SUCCESS --> DIE
    CATCH --> ERROR
    ERROR --> DIE
```

**Standard Response Formats:**

| Response Type | Structure | Example |
|--------------|-----------|---------|
| Success | `{"result": data}` or `{"ok": data}` | Employee created |
| Error | `{"err": "message"}` | Validation failed |
| Session Invalid | `{"active": false}` | Token expired |

**Error Code Constants:**

IndexCtrl defines error codes for consistent error reporting at [src/ctrls/IndexCtrl.php:82-277]():

| Constant | Code | Usage |
|----------|------|-------|
| `ERR_COD_SIN_PRIVILEGIOS` | 520 | Insufficient permissions |
| `ERR_COD_USUARIO_NO_EXISTE_BY_ID` | 521 | User not found |
| `ERR_COD_ENVIO_MAIL_FALLIDO` | 522 | Email send failure |
| `ERR_COD_CAMPO_OBLIGATORIO` | 524 | Required field missing |
| `ERR_COD_SESION_INACTIVA` | 529 | Inactive session |
| `ERR_COD_USUARIO_O_CLAVE_INVALIDA` | 535 | Invalid credentials |

**Early Termination:**

All API responses terminate with `die("")` to prevent subsequent page rendering:

- AJAX endpoints terminate at each endpoint handler
- REST endpoints terminate at [src/ctrls/Rest.php:24](), [src/ctrls/Rest.php:48](), [src/ctrls/Rest.php:68]()
- File downloads terminate at [src/ctrls/IndexCtrl.php:1367](), [src/ctrls/IndexCtrl.php:1377]()

**Sources:** [src/ctrls/IndexCtrl.php:82-277](), [src/ctrls/IndexCtrl.php:1523-1532](), [src/ctrls/Rest.php:15-68]()

## Controller Lifecycle and Initialization

Each controller follows a specific initialization sequence:

### IndexCtrl Lifecycle

```mermaid
graph TD
    START["new IndexCtrl()"]
    SESSION["session_start() if needed"]
    CHECK_USER["Check $_SESSION['usu']"]
    CHECK_STATE["Validate user state"]
    LOGOUT["Seguridad::logout() if invalid"]
    
    CHECK_REST["Check PATH_INFO"]
    LOAD_OP["Load OperacionesCtrl"]
    LOAD_REST["Load Rest handler"]
    REST_HANDLER["Rest::handler() + die()"]
    
    CHECK_ACCESS["Check session URL"]
    LOGOUT_URL["Logout if URL mismatch"]
    
    CHECK_AJAXL["Check $_REQUEST['ajaxl']"]
    DOWNLOAD["Handle downloads"]
    SESSION_CHECK["Handle session checks"]
    
    CHECK_POST["Check $_POST"]
    LOAD_OP2["Load OperacionesCtrl"]
    AJAX_DISPATCH["Dispatch to 100+ endpoints"]
    
    RENDER["render() method"]
    
    START --> SESSION
    SESSION --> CHECK_USER
    CHECK_USER --> CHECK_STATE
    CHECK_STATE -->|"invalid"| LOGOUT
    
    CHECK_STATE -->|"valid"| CHECK_REST
    CHECK_REST -->|"PATH_INFO set"| LOAD_OP
    LOAD_OP --> LOAD_REST
    LOAD_REST --> REST_HANDLER
    
    CHECK_REST -->|"no PATH_INFO"| CHECK_ACCESS
    CHECK_ACCESS -->|"URL mismatch"| LOGOUT_URL
    CHECK_ACCESS -->|"URL match"| CHECK_AJAXL
    
    CHECK_AJAXL -->|"ajaxl set"| DOWNLOAD
    CHECK_AJAXL -->|"ajaxl set"| SESSION_CHECK
    
    CHECK_AJAXL -->|"no ajaxl"| CHECK_POST
    CHECK_POST -->|"POST data"| LOAD_OP2
    LOAD_OP2 --> AJAX_DISPATCH
    
    CHECK_POST -->|"no POST"| RENDER
```

**Source:** [src/ctrls/IndexCtrl.php:1308-2500]()

### HomeCtrl Lifecycle

```mermaid
graph TD
    START["new HomeCtrl()"]
    LOAD_OP["Load OperacionesCtrl"]
    
    CHECK_REST["Check PATH_INFO"]
    LOAD_REST["Load Rest handler"]
    REST_HANDLER["Rest::handler() + die()"]
    
    CHECK_AJAX["Check $_POST['ajax']"]
    EXTERNAL_AUTH["LoginFromExterno()"]
    RESPOND["JSON response + die()"]
    
    RENDER["render() method"]
    SESSION["session_start() if needed"]
    HEADERS["Include header template"]
    ROUTE["Route to requested page"]
    FOOTER["Include footer template"]
    
    START --> LOAD_OP
    LOAD_OP --> CHECK_REST
    
    CHECK_REST -->|"PATH_INFO set"| LOAD_REST
    LOAD_REST --> REST_HANDLER
    
    CHECK_REST -->|"no PATH_INFO"| CHECK_AJAX
    CHECK_AJAX -->|"external auth"| EXTERNAL_AUTH
    EXTERNAL_AUTH --> RESPOND
    
    CHECK_AJAX -->|"no AJAX"| RENDER
    RENDER --> SESSION
    SESSION --> HEADERS
    HEADERS --> ROUTE
    ROUTE --> FOOTER
```

**Source:** [src/ctrls/HomeCtrl.php:58-200]()

### Rest Handler Flow

```mermaid
graph TD
    START["Rest::handler()"]
    ENABLE_FOPEN["ini_set('allow_url_fopen', true)"]
    GET_METHOD["Get HTTP method"]
    
    CHECK_BEARER["getBearerToken()"]
    VALIDATE_TOKEN["CompararToken()"]
    CHECK_EXPIRE["Check expiration"]
    SET_AUTH["Set authenticated = true"]
    
    NO_TOKEN["No token - try Basic Auth"]
    GET_BASIC["getAuthBasic()"]
    
    PARSE_PATH["Parse PATH_INFO"]
    GET_INPUT["file_get_contents('php://input')"]
    DECODE_JSON["json_decode()"]
    
    SWITCH_METHOD["switch(method)"]
    HANDLE_GET["GET: Method discovery"]
    HANDLE_POST["POST: Execute operation"]
    
    START --> ENABLE_FOPEN
    ENABLE_FOPEN --> GET_METHOD
    GET_METHOD --> CHECK_BEARER
    
    CHECK_BEARER -->|"token found"| VALIDATE_TOKEN
    VALIDATE_TOKEN --> CHECK_EXPIRE
    CHECK_EXPIRE -->|"valid"| SET_AUTH
    CHECK_EXPIRE -->|"expired"| NO_TOKEN
    
    CHECK_BEARER -->|"no token"| NO_TOKEN
    NO_TOKEN --> GET_BASIC
    
    SET_AUTH --> PARSE_PATH
    GET_BASIC --> PARSE_PATH
    PARSE_PATH --> GET_INPUT
    GET_INPUT --> DECODE_JSON
    DECODE_JSON --> SWITCH_METHOD
    
    SWITCH_METHOD --> HANDLE_GET
    SWITCH_METHOD --> HANDLE_POST
```

**Source:** [src/ctrls/Rest.php:114-275]()

**Sources:** [src/ctrls/IndexCtrl.php:1308-1400](), [src/ctrls/HomeCtrl.php:58-200](), [src/ctrls/Rest.php:114-275]()

---

---

## 3.1 IndexCtrl - Main Application Controller

## Purpose and Scope

This document covers the `IndexCtrl` class, which serves as the main application controller and primary request router for the GESFINANCIERO system. `IndexCtrl` is responsible for receiving all authenticated application requests, validating sessions, and routing API calls to appropriate business logic handlers. 

For information about the public-facing controller, see [HomeCtrl - Public Home Controller](#3.2). For details on the REST API handler, see [Rest - REST API Handler](#3.3). For the business logic implementations that IndexCtrl delegates to, see [OperacionesCtrl - Core Operations](#4.1).

**Sources:** [src/ctrls/IndexCtrl.php:1-34]()

---

## Overview

`IndexCtrl` extends the `Pagina` base class and acts as the central request dispatcher for over 100 API endpoints in the authenticated application context. It instantiates in response to requests to `index.php` and processes three primary request types:

1. **REST API requests** - Identified by `PATH_INFO` server variable, delegated to `Rest::handler()`
2. **AJAX API requests** - POST requests with `ajax` parameter containing MD5-hashed endpoint identifiers
3. **File download requests** - GET requests with `ajaxl` parameter for CSV exports and PDF document access

The controller operates entirely within the constructor method `__construct()`, centralizing all request processing logic in a single execution path.

**Sources:** [src/ctrls/IndexCtrl.php:36-1308]()

---

## Architecture Pattern

```mermaid
graph TB
    subgraph "Request Entry"
        INDEXP["index.php"]
    end
    
    subgraph "IndexCtrl Constructor"
        SESSION["Session Validation<br/>Lines 1312-1320"]
        PATHINFO["PATH_INFO Check<br/>Lines 1323-1334"]
        ACCESSCTL["Access Control<br/>Lines 1337-1348"]
        AJAXL["Download Handler<br/>Lines 1350-1399"]
        AJAX["AJAX Router<br/>Lines 1401-2589"]
    end
    
    subgraph "Delegation Targets"
        REST["Rest::handler()"]
        OPCTRL["OperacionesCtrl"]
        DOWNLOAD["File Download"]
    end
    
    INDEXP --> SESSION
    SESSION --> PATHINFO
    PATHINFO -->|PATH_INFO exists| REST
    PATHINFO -->|No PATH_INFO| ACCESSCTL
    ACCESSCTL --> AJAXL
    AJAXL -->|ajaxl param| DOWNLOAD
    AJAXL -->|No ajaxl| AJAX
    AJAX --> OPCTRL
    
    REST -.->|die| EXIT["Request Termination"]
    DOWNLOAD -.->|die| EXIT
    OPCTRL -.->|die| EXIT
```

**Sources:** [src/ctrls/IndexCtrl.php:1308-2589]()

---

## Constants Organization

IndexCtrl defines over 150 constants organized into functional categories. These constants serve as configuration values, endpoint identifiers, and error codes throughout the application.

### Configuration Constants

| Constant | Value | Purpose |
|----------|-------|---------|
| `CHARS_TO` | `'utf-8'` | Target character encoding for conversions |
| `CHARS_FR` | `'utf-8'` | Source character encoding |
| `CONFIG_UPLOAD_DEF` | `10` | Default upload configuration |
| `TIEMPO_AJAX_LDN` | `"1000"` | AJAX loading notification delay (milliseconds) |

### Field Visibility States

| Constant | Value | Purpose |
|----------|-------|---------|
| `GENERAL_CAMPOS_VISIBLE` | `0` | Field is visible |
| `GENERAL_CAMPOS_OCULTO` | `1` | Field is hidden |
| `GENERAL_CAMPOS_INACTIVO` | `2` | Field is inactive |

### User Profile/Role Constants

| Constant | Value | Role Description |
|----------|-------|------------------|
| `PERFILES_SUPER_USUARIO` | `1` | Super User |
| `PERFILES_ADMINISTRADOR` | `2` | Administrator |
| `PERFILES_SUPERVISOR` | `3` | Supervisor |
| `PERFILES_CONTRATISTA` | `4` | Contractor |
| `PERFILES_ACUDIENTE` | `5` | Guardian |
| `PERFILES_FINANCIERO` | `6` | Financial |
| `PERFILES_SUPERVISORADMIN` | `7` | Supervisor Admin |
| `PERFILES_PROVEEDOR` | `8` | Provider |
| `PERFILES_API` | `9` | API User |
| `PERFILES_SOPORTE` | `"10"` | Support |

**Sources:** [src/ctrls/IndexCtrl.php:37-55]()

---

## Error Code System

IndexCtrl defines a comprehensive error code system ranging from 520-539. Each error code corresponds to a specific failure scenario and is used to set HTTP response codes.

### Error Code Reference

| Error Code | Constant | Message/Meaning |
|------------|----------|-----------------|
| `520` | `ERR_COD_SIN_PRIVILEGIOS` | User lacks sufficient privileges |
| `521` | `ERR_COD_USUARIO_NO_EXISTE_BY_ID` | User ID does not exist |
| `522` | `ERR_COD_ENVIO_MAIL_FALLIDO` | Email sending failed |
| `523` | `ERR_COD_CAMBIO_CLAVE_FALLIDO` | Password change failed |
| `524` | `ERR_COD_CAMPO_OBLIGATORIO` | Required field missing |
| `525` | `ERR_COD_COMUNICACIONES_SIN_DESTINATARIO` | Communication without recipient |
| `526` | `ERR_COD_COMUNICACIONES_AGREGANDO` | Failed adding communication recipients |
| `527` | `ERR_COD_COMUNICACIONES_OBTENER_LISTA_POR_ENVIAR` | Failed retrieving send list |
| `528` | `ERR_COD_AGENDA_AGREGAR` | Failed adding to agenda |
| `529` | `ERR_COD_SESION_INACTIVA` | Session inactive |
| `530` | `ERR_COD_MSJ_ERR_COMUN` | Common/general error |
| `531` | `ERR_COD_EST_CLAVE_NO_MODIFICADA` | Employee password not modified |
| `532` | `ERR_COD_CORREO_FAIL` | Email failure |
| `533` | `ERR_COD_USUARIO_EXISTE_PERO_SIN_DATOS` | User exists but without data |
| `534` | `ERR_COD_ACUDIENTE_HIJOS_ACTIVOS` | Guardian has no active children |
| `535` | `ERR_COD_USUARIO_O_CLAVE_INVALIDA` | Invalid username or password |
| `536` | `ERR_COD_PLANTILLA_NO_SALVADA` | Template not saved |
| `537` | `ERR_COD_REGISTRO_EXISTENTE` | Duplicate record exists |
| `538` | `ERR_COD_ACTUALIZACION_SQL`/`ERR_COD_ELIMINACION_SQL` | SQL update/delete failed |
| `539` | `ERR_COD_RESPUESTA_SQL_VACIA` | Empty SQL response |

**Sources:** [src/ctrls/IndexCtrl.php:76-277]()

---

## Request Processing Flow

### REST API Request Flow

```mermaid
sequenceDiagram
    participant Client
    participant IndexCtrl
    participant Rest
    participant OperacionesCtrl
    participant Singleton
    
    Client->>IndexCtrl: HTTP Request with PATH_INFO
    IndexCtrl->>IndexCtrl: Session start (line 1312)
    IndexCtrl->>IndexCtrl: Check user estado_id (line 1314)
    IndexCtrl->>IndexCtrl: Detect PATH_INFO (line 1323)
    IndexCtrl->>IndexCtrl: Load OperacionesCtrl.php (line 1326)
    IndexCtrl->>IndexCtrl: Load Rest.php (line 1329)
    IndexCtrl->>Rest: Rest::handler()
    Rest->>Rest: Validate Bearer Token
    Rest->>OperacionesCtrl: Dispatch to operation
    OperacionesCtrl->>Singleton: Database query
    Singleton-->>OperacionesCtrl: Results
    OperacionesCtrl-->>Rest: JSON response
    Rest->>Rest: die("") - Terminate
    Note over IndexCtrl: Execution stops here
```

**Sources:** [src/ctrls/IndexCtrl.php:1323-1334]()

---

### AJAX Request Flow

```mermaid
sequenceDiagram
    participant Client
    participant IndexCtrl
    participant OperacionesCtrl
    participant Singleton
    participant DB
    
    Client->>IndexCtrl: POST with ajax parameter
    IndexCtrl->>IndexCtrl: Check session URL (line 1337)
    IndexCtrl->>IndexCtrl: Load OperacionesCtrl.php (line 1402)
    IndexCtrl->>IndexCtrl: MD5 match ajax parameter (line 1411)
    
    alt API_LoginSystemAjax
        IndexCtrl->>OperacionesCtrl: AutenticaUsuarioSisAjaxB64()
    else API_EmpleadosAdd
        IndexCtrl->>OperacionesCtrl: Empleados_Agregar()
    else API_UsuariosGet
        IndexCtrl->>OperacionesCtrl: usuarios_Obtener()
    else Other endpoints
        IndexCtrl->>OperacionesCtrl: Specific method
    end
    
    OperacionesCtrl->>Singleton: Execute query
    Singleton->>DB: SQL execution
    DB-->>Singleton: Result set
    Singleton-->>OperacionesCtrl: Processed data
    OperacionesCtrl-->>IndexCtrl: Array result
    IndexCtrl->>IndexCtrl: json_encode(result)
    IndexCtrl->>IndexCtrl: die("") - Terminate
    IndexCtrl-->>Client: JSON response
```

**Sources:** [src/ctrls/IndexCtrl.php:1401-2589]()

---

## Endpoint Routing Mechanism

IndexCtrl uses MD5 hashing as a security-through-obscurity mechanism for endpoint identification. Each API endpoint is identified by a constant (e.g., `API_EmpleadosAdd`), and clients must send the MD5 hash of that constant name in the `ajax` parameter.

### MD5-Based Routing Pattern

```mermaid
graph LR
    CLIENT["Client Code"]
    CONSTANT["API_EmpleadosAdd"]
    MD5["MD5 Hash"]
    POST["POST Request"]
    INDEXCTRL["IndexCtrl"]
    MATCH["String Comparison"]
    HANDLER["OperacionesCtrl::Empleados_Agregar()"]
    
    CLIENT -->|References| CONSTANT
    CONSTANT -->|"md5()"| MD5
    MD5 -->|"ajax parameter"| POST
    POST --> INDEXCTRL
    INDEXCTRL -->|"Line 1523"| MATCH
    MATCH -->|"if match"| HANDLER
```

**Example routing check:**
```php
if ($_POST["ajax"] == md5(self::API_EmpleadosAdd)) {
    $ok = OperacionesCtrl::Empleados_Agregar($_POST);
    echo json_encode($ok);
    die("");
}
```

**Sources:** [src/ctrls/IndexCtrl.php:1523-1531]()

---

## API Endpoint Categories

IndexCtrl organizes over 100 API endpoints into functional categories. Each category handles a specific domain of the application.

### Authentication Endpoints

| Constant | OperacionesCtrl Method | Purpose |
|----------|------------------------|---------|
| `API_LoginSystemAjax` | `AutenticaUsuarioSisAjaxB64()` | System login with Base64 credentials |
| `API_IniciarLoginAsOtro` | Direct session manipulation | Impersonate another user |
| `API_RecuperarSisClave` | `sistema_recuperarClave_Get()` | Password recovery |

**Sources:** [src/ctrls/IndexCtrl.php:373, 1441-1450]()

---

### Employee Management Endpoints

| Constant | OperacionesCtrl Method | Purpose |
|----------|------------------------|---------|
| `API_EmpleadosAdd` | `Empleados_Agregar()` | Create new employee |
| `API_EmpleadosMod` | `Empleados_Helper_Modificar()` | Modify employee data |
| `API_EmpleadosRm` | `Empleados_Eliminar()` | Remove employee |
| `API_EmpleadosActivar` | `Empleados_Activar()` | Activate employee account |
| `API_EmpleadosGet` | `Empleados_Obtener()` | Retrieve employee list |
| `API_EmpleadosGetAjax` | `Empleados_ObtenerAjax()` | AJAX employee retrieval |
| `API_EmpleadosHelperGet` | `Empleados_Helper_Obtener()` | Get employee helper data |
| `API_EmpleadosGetAnexos` | `Empleados_ObtenerFilesAjax()` | Get employee attachments |
| `API_EmpleadosClaveAsignadaAdmin` | `Empleados_NuevaClaveAjax()` | Admin-assigned password |

**Sources:** [src/ctrls/IndexCtrl.php:445-554, 1523-1654]()

---

### User Management Endpoints

| Constant | OperacionesCtrl Method | Purpose |
|----------|------------------------|---------|
| `API_UsuariosAdd` | `usuarios_Agregar()` | Create new user |
| `API_UsuariosMod` | `usuarios_Modificar()` | Modify user data |
| `API_UsuariosRm` | `usuarios_Eliminar()` | Remove user |
| `API_UsuariosGet` | `usuarios_Obtener()` | Retrieve user list |
| `API_UsuariosGetAjax` | `usuarios_ObtenerAjax()` | AJAX user retrieval |
| `API_UsuariosHelperGet` | `usuarios_Helper_Obtener()` | Get user helper data |
| `API_AdminHelperAdd` | `mnguserAdd_Helper()` | Add admin helper |
| `API_UsuariosMiniAdd` | `usuarios_Helper_AgregarMini()` | Add mini user profile |

**Sources:** [src/ctrls/IndexCtrl.php:566-655, 1658-1767]()

---

### Document & Template Management Endpoints

| Constant | OperacionesCtrl Method | Purpose |
|----------|------------------------|---------|
| `API_plantillasAdd` | `editarPlantillas_Agregar()` | Add document template |
| `API_plantillasNew` | `editarPlantillas_Nuevo()` | Create new template |
| `API_plantillasDel` | `editarPlantillas_Eliminar()` | Delete template |
| `API_plantillasMixAdd` | `editarPlantillas_Mezclar_Agregar()` | Add template mix |
| `API_plantillasMixGet` | `editarPlantillas_Mezclar_Obtener()` | Get template mix |
| `API_plantillasMixSend` | `editarPlantillas_Mezclar_Enviar()` | Send template mix |

**Sources:** [src/ctrls/IndexCtrl.php:755-809, 1857-1926]()

---

### Digital Signature Endpoints

| Constant | OperacionesCtrl Method | Purpose |
|----------|------------------------|---------|
| `API_FirmasGet` | `firmaspro_Helper_Obtener()` | Get signatures |
| `API_FirmasPreviaGet` | `firmaspro_Preview_Obtener()` | Preview signature |
| `API_FirmasAgregarConfigCorp_Add` | `firmaspro_Config_Page_Agregar()` | Add signature config |
| `API_FirmasAgregarConfigCorp_Get` | `firmaspro_Config_Page_Obtener()` | Get signature config |
| `API_FirmasproHelperAdd` | `firmaspro_Helper_FirmarDoc()` | Sign document |
| `API_FirmasproAdminP12Add` | `firmaspro_Helper_Admin_MkCert_p12()` | Add P12 certificate |
| `API_FirmaslogHelperEvent` | `firmaspro_Helper_EventsObtener()` | Get signature log events |

**Sources:** [src/ctrls/IndexCtrl.php:821-883, 1931-2005]()

---

### Workflow Management Endpoints

| Constant | OperacionesCtrl Method | Purpose |
|----------|------------------------|---------|
| `API_FlujosHelperAdd` | `flujos_Helper_Agregar()` | Add workflow |
| `API_FlujosHelperEstadoMod` | `flujos_Estados_Helper_Modificar()` | Modify workflow state |
| `API_FlujosGetAjax` | `flujos_Obtener_Ajax()` | Get workflows via AJAX |
| `API_FlujositemsGet` | `flujositems_Obtener()` | Get workflow items |
| `API_FlujositemsHelperGet` | `flujositems_Helper_Obtener()` | Get workflow item helpers |
| `API_FlujositemsHelperDel` | `flujositems_Helper_Eliminar()` | Delete workflow item |
| `API_FlujositemsPrincipalHelperGet` | `flujositems_Pricipal_Helper_Obtener()` | Get principal workflow items |

**Sources:** [src/ctrls/IndexCtrl.php:957-1023, 2146-2228]()

---

### Package Management Endpoints

| Constant | OperacionesCtrl Method | Purpose |
|----------|------------------------|---------|
| `API_PaquetesGetAjax` | `paquetes_Obtener_Ajax()` | Get packages via AJAX |
| `API_PaquetesHelperGetAjax` | `paquetes_Helper_Obtener_Ajax()` | Get package helpers |
| `API_PaquetesHelperMoveReview` | `paquetes_Helper_MoverRevisar()` | Move package to review |
| `API_PaquetesHelperMoveAdmin` | `paquetes_Helper_MoverAdmin()` | Move package to admin |
| `API_PaquetesHomeHelperAdd` | `paquetes_Home_Helper_Agregar()` | Add package from home |
| `API_PaquetesrequHelperAdd` | `paquetesrequ_Helper_Agregar()` | Add package requirement |

**Sources:** [src/ctrls/IndexCtrl.php:1035-1074, 2232-2294]()

---

### Form Management Endpoints

| Constant | OperacionesCtrl Method | Purpose |
|----------|------------------------|---------|
| `API_FormulariosGetAjax` | `formularios_Obtener_Ajax()` | Get forms via AJAX |
| `API_FormulariosHelperAdd` | `formularios_Helper_Agregar()` | Add form helper |
| `API_FormulariosHelperDel` | `formularios_Helper_Eliminar()` | Delete form helper |
| `API_FormulariosGet` | `formularios_Obtener()` | Get forms |

**Sources:** [src/ctrls/IndexCtrl.php:1118-1145, 2411-2440]()

---

## Session Management

IndexCtrl implements comprehensive session validation at the beginning of each request in the constructor.

### Session Validation Flow

```mermaid
graph TD
    START["Request Start"]
    SESSCHECK{"SESSION exists?"}
    SESSSTART["session_start()"]
    USUCHECK{"_SESSION['usu'] exists?"}
    ESTADOCHECK{"estado_id > 1?"}
    LOGOUT["Seguridad::logout()"]
    ALERT["Alert: Usuario inactivo"]
    DIE["die('')"]
    CONTINUE["Continue Processing"]
    
    START --> SESSCHECK
    SESSCHECK -->|No| SESSSTART
    SESSCHECK -->|Yes| USUCHECK
    SESSSTART --> USUCHECK
    USUCHECK -->|Yes| ESTADOCHECK
    USUCHECK -->|No| CONTINUE
    ESTADOCHECK -->|Yes| LOGOUT
    ESTADOCHECK -->|No| CONTINUE
    LOGOUT --> ALERT
    ALERT --> DIE
```

**Implementation:**
```php
if(!isset($_SESSION)){ session_start(); }
if (isset($_SESSION["usu"])) {
    $_usu_tmp = $_SESSION["usu"];
    if($_usu_tmp->getEstado_id() > 1){
        Seguridad::logout();
        echo "<script>alert('Usuario inactivo...'); location.href='./index.php';</script>";
        die("");
    }
}
```

**Sources:** [src/ctrls/IndexCtrl.php:1312-1320]()

---

### URL-Based Session Security

For AJAX requests, IndexCtrl validates that the session URL matches the current base URL to prevent session hijacking:

```php
if(isset($_POST["ajax"])){
    if(!($_POST["ajax"] == md5(self::API_IniciarLoginAsOtro))){
        if(isset($_SESSION["url"])){
            if(trim(strtolower($_SESSION["url"])) != trim(strtolower(Utiles::getBaseUrl()))){
                Seguridad::logout();
                echo "<script>location.href='./index.php';</script>";
                die("");
            }
        }
    }
}
```

**Sources:** [src/ctrls/IndexCtrl.php:1337-1348]()

---

## File Download Handling

IndexCtrl provides three specialized download endpoints accessed via the `ajaxl` GET parameter:

### Download Endpoints

```mermaid
graph TD
    CLIENT["Client Request"]
    AJAXL{"ajaxl parameter?"}
    MD5CHECK["MD5 Hash Check"]
    
    subgraph "Download Types"
        CSV["API_LNK_DESCARGAR_ALUMNOS<br/>CSV Export<br/>Lines 1354-1367"]
        PDF["API_LNK_DESCARGAR_PDF<br/>PDF Download<br/>Lines 1370-1378"]
        PDFVIEW["API_LNK_VISTA_PDF_PROC<br/>PDF Viewer<br/>Lines 1379-1387"]
    end
    
    SESSION["API_SESSION_ACTIVA<br/>Session Check<br/>Lines 1389-1397"]
    
    CLIENT --> AJAXL
    AJAXL -->|Yes| MD5CHECK
    MD5CHECK --> CSV
    MD5CHECK --> PDF
    MD5CHECK --> PDFVIEW
    MD5CHECK --> SESSION
```

### CSV Employee Download

```php
if($_REQUEST["ajaxl"] == md5(self::API_LNK_DESCARGAR_ALUMNOS)){
    $ok = OperacionesCtrl::Empleados_Download_Obtener($_REQUEST);
    $flnm = date("YmdHis") . ".csv";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $flnm . '";');
    echo $ok;
    die("");
}
```

**Sources:** [src/ctrls/IndexCtrl.php:1354-1367]()

---

### PDF Document Download

Uses masked URLs to access protected documents:

```php
if($_REQUEST["ajaxl"] == md5(self::API_LNK_DESCARGAR_PDF)){
    $ok = OperacionesCtrl::crearUrlMask($_REQUEST, self::MASK_FLD_REPO_ANEXOS);
    die("");
}
```

**Mask Constants:**

| Constant | Value | Purpose |
|----------|-------|---------|
| `MASK_FLD_REPO_ANEXOS` | `'MASK_FLD_REPO_ANEXOS'` | Anexos repository mask |
| `MASK_FLD_REPO_PROCESOS` | `'MASK_FLD_REPO_PROCESOS'` | Process repository mask |

**Sources:** [src/ctrls/IndexCtrl.php:1273-1283, 1370-1387]()

---

## Delegation to OperacionesCtrl

IndexCtrl acts as a thin routing layer, delegating all business logic to `OperacionesCtrl`. The delegation pattern is consistent across all endpoints:

### Delegation Pattern

```mermaid
sequenceDiagram
    participant IndexCtrl
    participant OperacionesCtrl
    participant ExceptionHandler
    participant Response
    
    IndexCtrl->>IndexCtrl: Load OperacionesCtrl.php
    IndexCtrl->>IndexCtrl: Match MD5 hash
    
    alt Success Path
        IndexCtrl->>OperacionesCtrl: Call specific method($d)
        OperacionesCtrl-->>IndexCtrl: Return $ok array
        IndexCtrl->>Response: json_encode($ok)
        IndexCtrl->>Response: die("")
    else Exception Path
        IndexCtrl->>OperacionesCtrl: Call specific method($d)
        OperacionesCtrl-->>ExceptionHandler: throw Exception
        ExceptionHandler->>IndexCtrl: Catch Exception
        IndexCtrl->>Response: json_encode(["err" => message])
        IndexCtrl->>Response: die("")
    end
```

### Standard Delegation Code Block

```php
if($_POST["ajax"] == md5(self::API_EmpleadosAdd)){
    try {
        $ok = OperacionesCtrl::Empleados_Agregar($_POST);
        echo json_encode($ok);
    } catch (Exception $ex) {
        $er = array("err" => $ex->getMessage());
        echo json_encode($er);
    }
    die("");
}
```

**This pattern repeats for all 100+ endpoints with only the method name changing.**

**Sources:** [src/ctrls/IndexCtrl.php:1523-1531]()

---

## Special Case: Login as Another User

The `API_IniciarLoginAsOtro` endpoint is unique because it directly manipulates session data rather than delegating to OperacionesCtrl:

```php
if($_POST["ajax"] == md5(self::API_IniciarLoginAsOtro)){
    $usuarios = new Usuarios();
    $strf = "where id = " . $_POST["as"] . "";
    $objRes = $usuarios->readInfo("*", $strf);
    
    if(sizeof($objRes) > 0){
        unset($_SESSION["usu"]);
        unset($_SESSION["url"]);
        session_destroy();
        
        if(!$_SESSION){
            @session_start();
        }
        $_SESSION["usu"] = $objRes[0];
        $_SESSION["url"] = Utiles::getBaseUrl();
    }
    
    header('location: ./index.php');
}
```

**This endpoint destroys the current session, starts a new one with the target user's data, and redirects to index.php.**

**Sources:** [src/ctrls/IndexCtrl.php:1422-1440]()

---

## Error Handling Pattern

IndexCtrl implements a consistent error handling pattern across all endpoints:

1. **Try-Catch Wrapper:** All OperacionesCtrl calls are wrapped in try-catch blocks
2. **JSON Error Response:** Exceptions are converted to `{"err": "message"}` format
3. **HTTP Status Codes:** OperacionesCtrl may set `http_response_code()` before throwing
4. **Early Termination:** All responses end with `die("")` to prevent further processing

```mermaid
graph TD
    TRYCALL["try { OperacionesCtrl::method() }"]
    SUCCESS["Success: $ok returned"]
    ENCODE_OK["json_encode($ok)"]
    EXCEPTION["catch Exception"]
    ENCODE_ERR["json_encode(['err' => message])"]
    DIE["die('')"]
    
    TRYCALL -->|No exception| SUCCESS
    TRYCALL -->|Exception thrown| EXCEPTION
    SUCCESS --> ENCODE_OK
    EXCEPTION --> ENCODE_ERR
    ENCODE_OK --> DIE
    ENCODE_ERR --> DIE
```

**Sources:** [src/ctrls/IndexCtrl.php:1523-1531]()

---

## Integration Points

### Files Loaded by IndexCtrl

```mermaid
graph LR
    INDEXCTRL["IndexCtrl Constructor"]
    
    subgraph "Dynamically Loaded"
        OPCTRL["OperacionesCtrl.php<br/>Lines 1326, 1352, 1402"]
        REST["Rest.php<br/>Line 1329"]
    end
    
    subgraph "Statically Referenced"
        USUARIOS["Usuarios model"]
        SEGURIDAD["Seguridad class"]
        UTILES["Utiles class"]
    end
    
    INDEXCTRL -->|"REST requests"| REST
    INDEXCTRL -->|"All AJAX/downloads"| OPCTRL
    INDEXCTRL -->|"Session management"| SEGURIDAD
    INDEXCTRL -->|"Login as other"| USUARIOS
    INDEXCTRL -->|"URL validation"| UTILES
```

**Sources:** [src/ctrls/IndexCtrl.php:1326-1402, 1423-1424, 1340]()

---

## Complete Endpoint Catalog

IndexCtrl defines **94 API endpoint constants** organized into 21 functional categories:

### Category Summary

| Category | Endpoint Count | Example Constants |
|----------|----------------|-------------------|
| Authentication | 3 | `API_LoginSystemAjax`, `API_IniciarLoginAsOtro` |
| Lists | 2 | `API_ObtenerLugares`, `API_ObtenerTutores` |
| System | 2 | `API_TamanoUsoGet`, `API_RecuperarSisClave` |
| Institution | 2 | `API_InstitucionAdd`, `API_InstitucionLogo` |
| Employees | 13 | `API_EmpleadosAdd`, `API_EmpleadosMod`, `API_EmpleadosGet` |
| Users | 11 | `API_UsuariosAdd`, `API_UsuariosMod`, `API_UsuariosGet` |
| Activation Codes | 3 | `API_CodigoactivaGet`, `API_CodigoactivaAdd` |
| Passwords | 1 | `API_Contrasena` |
| Academic Year | 1 | `API_AnyolectivoAdd` |
| Profile Photos | 1 | `API_UpFotoPerfiles` |
| Templates | 6 | `API_plantillasAdd`, `API_plantillasDel` |
| Signatures | 7 | `API_FirmasGet`, `API_FirmasproHelperAdd` |
| Signature Comments | 3 | `API_FirmascomentariosHelperGet`, `API_FirmascomentariosHelperAdd` |
| ApiBox | 1 | `API_ApiboxGet` |
| Deductions | 5 | `API_DeduccionesHelperAdd`, `API_DeduccionesVirtualGet` |
| Requirements | 3 | `API_RequerimientostplsGetAjax`, `API_RequerimientosHelperAdd` |
| Workflows | 8 | `API_FlujosHelperAdd`, `API_FlujositemsGet` |
| Packages | 7 | `API_PaquetesGetAjax`, `API_PaquetesHelperMoveReview` |
| Comments | 4 | `API_PaquetesreqcomentariosHelperGet`, `API_ComentariosVirtual_Helper_Add` |
| Support | 3 | `API_ApoyosGet`, `API_ApooyosHelperAdd` |
| Forms | 4 | `API_FormulariosGetAjax`, `API_FormulariosHelperAdd` |
| Employee Details | 2 | `API_empleadosdetallescontrato_Get`, `API_empleadosdetallescontrato_Helper_Add` |
| Home Operations | 8 | `API_Home_Login`, `API_Home_RecuperaUsuario` |
| Data Loading | 2 | `API_Cargadatos_Upload`, `API_Bogdata_Consultar` |
| Downloads | 4 | `API_LNK_DESCARGAR_ALUMNOS`, `API_LNK_DESCARGAR_PDF` |

**Total: 94 unique API endpoints**

**Sources:** [src/ctrls/IndexCtrl.php:314-1262]()

---

## Routing Table Structure

The routing implementation in the constructor follows this organizational pattern:

```
1. Session Management (lines 1312-1320)
2. REST API Detection (lines 1323-1334)
3. URL-Based Security (lines 1337-1348)
4. Download Handlers (lines 1350-1399)
5. AJAX Endpoint Routing:
   ├─ Config Operations (lines 1411-1420)
   ├─ Login Operations (lines 1422-1450)
   ├─ List Operations (lines 1453-1472)
   ├─ System Operations (lines 1476-1496)
   ├─ Institution Operations (lines 1500-1519)
   ├─ Employee Operations (lines 1523-1654)
   ├─ User Operations (lines 1658-1767)
   ├─ Activation Code Operations (lines 1785-1814)
   ├─ Password Operations (lines 1818-1827)
   ├─ Academic Year Operations (lines 1831-1840)
   ├─ Profile Photo Operations (lines 1844-1853)
   ├─ Template Operations (lines 1857-1926)
   ├─ Signature Operations (lines 1931-2040)
   ├─ ApiBox Operations (lines 2043-2052)
   ├─ Deduction Operations (lines 2056-2110)
   ├─ Requirement Operations (lines 2113-2142)
   ├─ Workflow Operations (lines 2146-2228)
   ├─ Package Operations (lines 2232-2294)
   ├─ Comment Operations (lines 2304-2346)
   ├─ Support Operations (lines 2354-2383)
   ├─ Form Operations (lines 2411-2440)
   ├─ Employee Contract Operations (lines 2453-2510)
   └─ Home Operations (lines 2517-2596)
```

**Sources:** [src/ctrls/IndexCtrl.php:1308-2596]()

---

## Key Architectural Characteristics

### Strengths

1. **Centralized Routing:** Single point of entry for all authenticated API requests
2. **Consistent Pattern:** Every endpoint follows the same try-catch-json-die pattern
3. **Security Through Obscurity:** MD5 hashing provides basic endpoint obfuscation
4. **Session Validation:** Comprehensive checks prevent unauthorized access
5. **Clean Delegation:** Controller remains thin by delegating to OperacionesCtrl

### Technical Debt Indicators

1. **Monolithic Constructor:** All routing logic in single 1300+ line method
2. **MD5 Not Secure:** MD5 hashing is cryptographically broken and bypassable
3. **String Comparison:** No route parameter parsing; relies on exact hash matches
4. **Duplicate Logic:** Similar try-catch blocks repeated 90+ times
5. **Hard to Test:** Constructor-based routing makes unit testing difficult
6. **No Route Documentation:** Endpoint mappings only visible in source code

**Sources:** [src/ctrls/IndexCtrl.php:1308-2596]()

---

## Relationship with Rest Handler

When `PATH_INFO` is detected, IndexCtrl immediately delegates to the REST handler:

```php
if(isset($_SERVER['PATH_INFO'])){
    $url_baseCtrls = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "ctrls" . DIRECTORY_SEPARATOR;
    $this->renderCtrl($url_baseCtrls . "OperacionesCtrl.php");
    
    $url_baseCtrls = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "ctrls" . DIRECTORY_SEPARATOR;
    $this->renderCtrl($url_baseCtrls . "Rest.php");
    
    Rest::handler();
    die("");
}
```

**The Rest handler provides:**
- Bearer token authentication
- RESTful path-based routing
- Alternative to MD5-hashed AJAX endpoints
- More standard API interface for external integrations

For complete REST API documentation, see [Rest - REST API Handler](#3.3).

**Sources:** [src/ctrls/IndexCtrl.php:1323-1334]()

---

## Summary

`IndexCtrl` serves as the main entry controller for authenticated application requests, providing:

- **Session Management:** Validates user sessions and prevents hijacking
- **Request Routing:** Directs 94 API endpoints to appropriate business logic handlers
- **REST API Gateway:** Detects and delegates REST requests to `Rest::handler()`
- **File Downloads:** Handles CSV exports and masked PDF downloads
- **Error Handling:** Consistent JSON error responses across all endpoints
- **Business Logic Delegation:** Routes all operations to `OperacionesCtrl` methods

The controller implements a centralized routing pattern where all logic resides in the constructor, processing requests through MD5-hashed endpoint identification and delegating execution to the business logic layer.

**Sources:** [src/ctrls/IndexCtrl.php:1-2596]()

---

---

## 3.2 HomeCtrl - Public Home Controller

## Purpose and Scope

`HomeCtrl` serves as the controller for the public-facing home application entry point. It handles unauthenticated and public access scenarios, including external authentication (social logins), page routing based on URL parameters, and REST API requests for public endpoints. This controller is instantiated by `home.php` (see [Home Application Entry](#2.2)) and delegates business logic to `OperacionesHomeCtrl`.

For authenticated internal application operations, see [IndexCtrl - Main Application Controller](#3.1). For the business logic that HomeCtrl delegates to, see [OperacionesHomeCtrl - Home Operations](#4.2).

---

## Overview

The `HomeCtrl` class extends `Pagina` and provides the following core functionality:

- **REST API Handling**: Processes REST API requests identified by `PATH_INFO` server variable
- **External Authentication**: Handles AJAX-based authentication from third-party providers (Google, Facebook, Microsoft)
- **Dynamic Page Routing**: Routes requests to different templates based on the `pageid` URL parameter
- **Template Rendering**: Manages inclusion of header, footer, and page-specific templates
- **JavaScript Namespace Generation**: Creates unique JavaScript namespaces based on the application's host URL

The controller acts as a thin routing layer that delegates most business logic to `OperacionesHomeCtrl`.

Sources: [src/ctrls/HomeCtrl.php:1-35]()

---

## Class Structure and Constants

### Class Definition

```php
class HomeCtrl extends Pagina
```

`HomeCtrl` extends the `Pagina` base class, inheriting common page functionality such as message handling and basic rendering capabilities.

### Constants

| Constant | Value | Purpose |
|----------|-------|---------|
| `REPO_ARCHIVOS` | `"repo"` | Repository directory path |
| `API_RegEventos` | `'Api/RegEventos'` | Event registration API endpoint identifier |
| `API_LoginAjaxUsr` | `'Api/LoginAjaxUsr'` | AJAX user login API endpoint identifier |

Sources: [src/ctrls/HomeCtrl.php:36-40]()

---

## Request Processing Flow

### Constructor Execution

The `__construct()` method centralizes all request processing and performs three primary operations:

```mermaid
graph TD
    START["HomeCtrl::__construct()"]
    LOAD["Load OperacionesCtrl.php"]
    CHECK_REST{"PATH_INFO<br/>isset?"}
    REST_HANDLER["Load Rest.php<br/>Rest::handler()<br/>die()"]
    CHECK_POST{"POST data<br/>isset?"}
    CHECK_AJAX{"POST['ajax'] ==<br/>md5('Api/IntegraAutentica')?"}
    EXT_AUTH["OperacionesHomeCtrl::LoginFromExterno()<br/>echo json_encode()<br/>die()"]
    CONTINUE["Continue to render()"]
    
    START --> LOAD
    LOAD --> CHECK_REST
    CHECK_REST -->|Yes| REST_HANDLER
    CHECK_REST -->|No| CHECK_POST
    CHECK_POST -->|Yes| CHECK_AJAX
    CHECK_POST -->|No| CONTINUE
    CHECK_AJAX -->|Yes| EXT_AUTH
    CHECK_AJAX -->|No| CONTINUE
```

**Diagram: HomeCtrl Constructor Request Processing Flow**

Sources: [src/ctrls/HomeCtrl.php:58-87]()

### Processing Steps

#### 1. Load Operations Controller

```php
$url_baseCtrls = dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . "ctrls" . DIRECTORY_SEPARATOR;
$this->renderCtrl($url_baseCtrls . "OperacionesCtrl.php");
```

Loads `OperacionesCtrl.php` to make `OperacionesHomeCtrl` methods available.

Sources: [src/ctrls/HomeCtrl.php:60-61]()

#### 2. REST API Request Handling

If `$_SERVER['PATH_INFO']` is set, the request is treated as a REST API call:

```php
if ( isset( $_SERVER['PATH_INFO'] ) ){
    $this->renderCtrl($url_baseCtrls . "Rest.php");
    Rest::handler();            
    die("");
}
```

The `Rest::handler()` method processes the request and terminates execution with `die()`, preventing further page rendering. For details on REST API processing, see [Rest - REST API Handler](#3.3).

Sources: [src/ctrls/HomeCtrl.php:64-69]()

#### 3. External Authentication AJAX

If `$_POST["ajax"]` equals `md5("Api/IntegraAutentica")`, the request is an external authentication attempt:

```php
if( $_POST["ajax"] == md5( "Api/IntegraAutentica" ) ){
    try{
        $ok = OperacionesHomeCtrl::LoginFromExterno( $_POST );
        echo json_encode($ok);
    }catch (Exception $ex){
        $er = array("err" => $ex->getMessage());
        echo json_encode($er);
    }
    die("");
}
```

This mechanism supports authentication from third-party providers (Google OAuth, Facebook Login, Microsoft Account, etc.).

Sources: [src/ctrls/HomeCtrl.php:73-84]()

---

## Page Routing System

### The render() Method

The `render()` method handles page routing based on the `pageid` URL parameter:

```mermaid
graph TB
    START["HomeCtrl::render()"]
    SESSION{"Session<br/>started?"}
    START_SESSION["session_start()"]
    HEADER["Include Encabezadohome.phtml"]
    CHECK_PAGEID{"$_REQUEST['pageid']<br/>isset?"}
    CHECK_WORKSPACE{"pageid ==<br/>PAGINA_WORKSPACE_HOME?"}
    CHECK_MODEL{"File exists in<br/>modelos/?"}
    CHECK_FILE{"File exists<br/>in tpls/?"}
    RENDER_PAGE["renderCtrl(pageid)"]
    RENDER_ERROR["setMensaje('Página no existente')<br/>renderCtrl(PAGINA_ERROR)"]
    RENDER_WORKSPACE["renderCtrl(PAGINA_WORKSPACE_HOME)"]
    FOOTER["renderCtrl(PAGINA_PIE_HOME)"]
    CLOSE_HTML["Close HTML tags"]
    
    START --> SESSION
    SESSION -->|No| START_SESSION
    SESSION -->|Yes| HEADER
    START_SESSION --> HEADER
    HEADER --> CHECK_PAGEID
    CHECK_PAGEID -->|No| RENDER_WORKSPACE
    CHECK_PAGEID -->|Yes| CHECK_WORKSPACE
    CHECK_WORKSPACE -->|Yes| RENDER_WORKSPACE
    CHECK_WORKSPACE -->|No| CHECK_MODEL
    CHECK_MODEL -->|Yes| RENDER_ERROR
    CHECK_MODEL -->|No| CHECK_FILE
    CHECK_FILE -->|Yes| RENDER_PAGE
    CHECK_FILE -->|No| RENDER_ERROR
    RENDER_PAGE --> FOOTER
    RENDER_ERROR --> FOOTER
    RENDER_WORKSPACE --> FOOTER
    FOOTER --> CLOSE_HTML
```

**Diagram: Page Routing Decision Tree**

Sources: [src/ctrls/HomeCtrl.php:157-200]()

### Routing Logic Details

#### Session Initialization

```php
if(!isset($_SESSION)){
    session_start();
}
```

Ensures a session is active before rendering content.

Sources: [src/ctrls/HomeCtrl.php:158-160]()

#### Template Path Construction

```php
$url_base = dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . "tpls" . DIRECTORY_SEPARATOR ;
$url_home = $url_base . "home" . DIRECTORY_SEPARATOR;
```

Base template paths are constructed relative to the controller directory.

Sources: [src/ctrls/HomeCtrl.php:162-163]()

#### Header Inclusion

```php
include_once $url_home . "Encabezadohome.phtml" ;
```

The home header template is always included first, providing consistent navigation and styling.

Sources: [src/ctrls/HomeCtrl.php:164]()

#### Page ID Processing

| Scenario | Condition | Action |
|----------|-----------|--------|
| No `pageid` parameter | `!isset($_REQUEST["pageid"])` | Render default workspace home page |
| `pageid` is workspace home | `$_REQUEST["pageid"] == Config::PAGINA_WORKSPACE_HOME` | Render workspace home page |
| File exists in `modelos/` | `file_exists($url_base . "modelos/" . $urlp)` | Show error (model files should not be directly accessible) |
| Valid template file | `file_exists($rutaVista)` | Render the requested page |
| Invalid/missing file | File not found | Show error page |

Sources: [src/ctrls/HomeCtrl.php:166-193]()

#### Footer and HTML Closure

```php
$this->renderCtrl( $url_home . Config::PAGINA_PIE_HOME );
echo "	\n";
echo "	</body>\n";
echo "</html>";
```

After rendering the main content, the footer template is included and HTML tags are closed.

Sources: [src/ctrls/HomeCtrl.php:195-199]()

---

## Template Rendering System

### The renderCtrl() Method

The `renderCtrl()` method implements a controller-first rendering pattern:

```mermaid
graph TB
    START["renderCtrl(rutaVista)"]
    EXTRACT["Extract filename from path"]
    BUILD_PATH["Build controller path:<br/>filename + 'Ctrl.php'"]
    CHECK_EXISTS{"Controller file<br/>exists?"}
    LOAD_CTRL["include_once controller"]
    INSTANTIATE["Instantiate controller class:<br/>filename + 'Ctrl'"]
    CALL_RENDER["Call controller->render()"]
    INCLUDE_VIEW["include_once rutaVista"]
    
    START --> EXTRACT
    EXTRACT --> BUILD_PATH
    BUILD_PATH --> CHECK_EXISTS
    CHECK_EXISTS -->|Yes| LOAD_CTRL
    CHECK_EXISTS -->|No| INCLUDE_VIEW
    LOAD_CTRL --> INSTANTIATE
    INSTANTIATE --> CALL_RENDER
```

**Diagram: Template/Controller Resolution Logic**

Sources: [src/ctrls/HomeCtrl.php:125-137]()

### Implementation Details

```php
private function renderCtrl( $rutaVista ){
    $vista = pathinfo( $rutaVista );
    $url_baseCtrls = dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . "ctrls" . DIRECTORY_SEPARATOR;
    $rutaCtrl = $url_baseCtrls . $vista[ 'filename' ] . "Ctrl.php";
    
    if( file_exists( $rutaCtrl ) ){
        include_once $rutaCtrl;
        $tmpNombreClase = $vista[ 'filename' ] . "Ctrl";
        $rutaCtrl = new $tmpNombreClase();
        $rutaCtrl->render();
    }else{
        include_once $rutaVista;
    }
}
```

**Behavior**:
1. Extracts the filename from the view path
2. Constructs a controller path by appending `"Ctrl.php"` to the filename
3. If the controller exists, instantiates it and calls its `render()` method
4. If no controller exists, includes the view file directly

This pattern allows views to have optional dedicated controllers for complex logic while supporting simple template inclusion for static content.

Sources: [src/ctrls/HomeCtrl.php:125-137]()

---

## JavaScript Namespace Generation

### JS_Name_get() Method

```php
public static function JS_Name_get(){
    $array=parse_url( Utiles::getBaseUrl() );
    $n = 'acpp_' . str_replace( ".", "", $array['host'] ) ;
    return $n;
}
```

Generates a unique JavaScript namespace identifier based on the application's host URL.

**Process**:
1. Obtains the base URL using `Utiles::getBaseUrl()`
2. Parses the URL to extract the host component
3. Removes dots from the hostname
4. Prefixes with `"acpp_"`

**Example**: If the host is `"example.com"`, the method returns `"acpp_examplecom"`.

This namespace is used to avoid JavaScript variable collisions when the application is embedded or integrated with other systems.

Sources: [src/ctrls/HomeCtrl.php:101-105]()

---

## Authentication Mechanisms

### External Authentication Integration

HomeCtrl provides a specialized endpoint for external authentication providers:

```mermaid
sequenceDiagram
    participant Client as Client Browser
    participant HC as HomeCtrl
    participant OHC as OperacionesHomeCtrl
    participant DB as Database
    
    Client->>HC: POST with ajax=md5("Api/IntegraAutentica")
    HC->>HC: Verify ajax hash
    HC->>OHC: LoginFromExterno(POST data)
    OHC->>OHC: Validate user email
    OHC->>DB: Update userselecto.clave<br/>with timestamp
    DB-->>OHC: Update result
    OHC-->>HC: Return success/error
    HC->>Client: JSON response
    HC->>HC: die() - Terminate
```

**Diagram: External Authentication Flow**

Sources: [src/ctrls/HomeCtrl.php:73-84]()

### Authentication Endpoint Details

| Aspect | Details |
|--------|---------|
| **Endpoint Identifier** | `md5("Api/IntegraAutentica")` |
| **HTTP Method** | POST |
| **Request Parameter** | `$_POST["ajax"]` must equal the MD5 hash |
| **Handler** | `OperacionesHomeCtrl::LoginFromExterno()` |
| **Response Format** | JSON with `{"ok": true}` or `{"err": "message"}` |
| **Termination** | Execution stops with `die("")` after response |

Sources: [src/ctrls/HomeCtrl.php:74-82]()

### Supported Authentication Methods

The `OperacionesHomeCtrl` class (delegated from HomeCtrl) provides multiple authentication methods:

| Method | Purpose | Key Parameters |
|--------|---------|----------------|
| `LoginUsur()` | Email-based login with activation code | `u` (email), `c` (code), `pase` (optional timestamp) |
| `LoginUsurCod()` | Send activation code via email | `u` (email) |
| `LoginAsUsur()` | Direct user lookup by email | `u` (email) |
| `LoginLdapUsur()` | LDAP/Active Directory authentication | `u` (username), `c` (password) |
| `LoginFromExterno()` | Third-party OAuth provider login | `us` (email) |

Sources: [src/ctrls/OperacionesHomeCtrl.php:217-416]()

---

## Business Logic Delegation

### Integration with OperacionesHomeCtrl

`HomeCtrl` delegates all business logic operations to `OperacionesHomeCtrl`, which provides the following services:

```mermaid
graph LR
    HC["HomeCtrl"]
    OHC["OperacionesHomeCtrl"]
    
    subgraph "Authentication Services"
        AUTH_LOGIN["LoginUsur()"]
        AUTH_CODE["LoginUsurCod()"]
        AUTH_LDAP["LoginLdapUsur()"]
        AUTH_EXT["LoginFromExterno()"]
        AUTH_ACTIVATE["activarCuenta()"]
    end
    
    subgraph "Email Services"
        EMAIL_ACTIVATE["actviarSendMail()"]
        EMAIL_CUSTOM["enviarCustomEmail()"]
        EMAIL_TAGS["ObtenerEtiquetasEmail()"]
    end
    
    subgraph "Document Services"
        DOC_LIST["ListarPdfUrs()"]
    end
    
    subgraph "Configuration Services"
        CFG_CORP["LeerConfigCorp()"]
    end
    
    subgraph "Usability Services"
        USABILITY["Usabilidad_AgregarHome()"]
        BADGES["ListarMisInsignias()"]
    end
    
    HC --> OHC
    OHC --> AUTH_LOGIN
    OHC --> AUTH_CODE
    OHC --> AUTH_LDAP
    OHC --> AUTH_EXT
    OHC --> AUTH_ACTIVATE
    OHC --> EMAIL_ACTIVATE
    OHC --> EMAIL_CUSTOM
    OHC --> EMAIL_TAGS
    OHC --> DOC_LIST
    OHC --> CFG_CORP
    OHC --> USABILITY
    OHC --> BADGES
```

**Diagram: HomeCtrl Business Logic Delegation**

Sources: [src/ctrls/OperacionesHomeCtrl.php:1-604]()

### Key Operations

#### Account Activation

```php
activarCuenta( $d )
```

Validates an activation code and checks expiration (1 year from generation).

- **Parameters**: `c` (activation code), `u` (user key)
- **Returns**: `true` if valid
- **Throws**: Exception if code is invalid, expired, or missing

Sources: [src/ctrls/OperacionesHomeCtrl.php:37-68]()

#### Activation Email

```php
actviarSendMail( $d )
```

Generates a unique activation code and emails it to the user.

- **Parameters**: `emailactivar` (destination email), `d` (user data array with `id`)
- **Returns**: MD5 hash of user ID on success
- **Process**:
  1. Validates email format
  2. Generates unique code using `Utiles::nuevoCl()`
  3. Stores code in `codigoactiva` table
  4. Loads email template from `src/sistema/email/nuevaclavehome.phtml`
  5. Replaces template variables
  6. Sends email via `enviarCustomEmail()`

Sources: [src/ctrls/OperacionesHomeCtrl.php:111-185]()

#### User Login with Code

```php
LoginUsur( $d )
```

Authenticates user by email and activation code, with optional timestamp validation.

- **Parameters**: `u` (email), `c` (code), `pase` (optional timestamp for third-party auth)
- **Returns**: `{"ok": {"estado": bool, "datos": array}}`
- **Process**:
  1. Resolves primary email (handles aliases via `ObtenerCorreoPrincipal()`)
  2. Queries `userselecto` with joins to `estadoselecto` and `perfilselecto`
  3. Fallback to `extusers` table if not found
  4. Validates activation code via `activarCuenta()`
  5. Optional timestamp validation for external auth (1-minute window)
  6. Removes password from response data

Sources: [src/ctrls/OperacionesHomeCtrl.php:254-322]()

#### LDAP Authentication

```php
LoginLdapUsur( $d )
```

Authenticates against corporate LDAP/Active Directory.

- **Parameters**: `u` (username), `c` (password)
- **Process**:
  1. Reads LDAP configuration from corporate config
  2. Connects to LDAP server
  3. Binds with credentials: `username@ldapdomain`
  4. Searches for user by `sAMAccountName`
  5. Throws exception if credentials invalid or user not in Evolusign

Sources: [src/ctrls/OperacionesHomeCtrl.php:335-384]()

#### Document Listing

```php
ListarPdfUrs( $d )
```

Retrieves accepted PDF documents for a user, including documents associated with alternate email addresses.

- **Parameters**: `dm` (primary email), `id` (user ID for alternate emails)
- **Returns**: `{"ok": array, "u_u": array}`
- **Process**:
  1. Collects all user emails (primary + alternates from `extusers`)
  2. Queries `docsestados` table for accepted documents
  3. Extracts version, user, and document from path structure
  4. Joins with `adjuntosflujos` for metadata
  5. Calls `OperacionesCtrl::ListarPdfGenerados()` for each document
  6. Logs usability event

Sources: [src/ctrls/OperacionesHomeCtrl.php:499-582]()

---

## Configuration and Constants

### Configuration Integration

`HomeCtrl` relies on constants defined in the `Config` class:

| Config Constant | Purpose |
|----------------|---------|
| `Config::PAGINA_WORKSPACE_HOME` | Default home workspace page template |
| `Config::PAGINA_ERROR` | Error page template path |
| `Config::PAGINA_PIE_HOME` | Home footer template path |

These constants are referenced throughout the routing and rendering logic to determine which templates to load.

Sources: [src/ctrls/HomeCtrl.php:170-196]()

### Corporate Configuration

The `LeerConfigCorp()` method in `OperacionesHomeCtrl` reads corporate configuration including:

- LDAP URL and domain settings (`ldapurl`, `ldapdmn`, `ldap_bse`)
- Login button styling
- OAuth provider settings (Office 365, Google, Facebook)

This configuration is loaded from `OperacionesCtrl::LeerConfigCorp()` and used for LDAP authentication.

Sources: [src/ctrls/OperacionesHomeCtrl.php:592-602]()

---

## Error Handling and Validation

### Error Display

When a page is not found or invalid, HomeCtrl displays an error:

```php
$this->setMensaje("P&aacute;gina no existente!");
$this->renderCtrl( $url_home . Config::PAGINA_ERROR );
```

The `setMensaje()` method (inherited from `Pagina`) stores the error message, which the error template can retrieve and display.

Sources: [src/ctrls/HomeCtrl.php:173-174](), [src/ctrls/HomeCtrl.php:180-181]()

### Security Validations

#### Model File Protection

```php
if( file_exists($url_base . "modelos/" . $urlp)){
    $this->setMensaje("P&aacute;gina no existente!");
    $this->renderCtrl( $url_home . Config::PAGINA_ERROR );
}
```

Prevents direct access to files in the `modelos/` directory, which should only be included by controllers, not accessed directly by users.

Sources: [src/ctrls/HomeCtrl.php:172-175]()

#### Email Validation

```php
if (!filter_var($ea, FILTER_VALIDATE_EMAIL)) {
    throw new Exception("Correo inv&aacute;lido.");
}
```

Validates email format before sending activation codes.

Sources: [src/ctrls/OperacionesHomeCtrl.php:116-118]()

#### Activation Code Expiration

```php
$horaAct = date("Y-m-d H:i:s");
$horaReg = strtotime('+1 year', strtotime( $aExist["fecha"] ));

if( $horaAct > date("Y-m-d H:i:s", $horaReg) ){
    throw new Exception("C&oacute;digo inactivo por no usar en los &uacute;ltimos 10 minutos.");
}
```

Note: Despite the error message mentioning "10 minutes," the code checks for 1 year expiration.

Sources: [src/ctrls/OperacionesHomeCtrl.php:49-54]()

#### External Auth Timestamp Validation

```php
$endTime = strtotime("+1 minute", strtotime( $_u["clave"] ));
if( strtotime($d["pase"]) <= $endTime ){
    // Valid
}else{
    throw new Exception( "LoginUsur: Suspected impersonation ip: " . Utiles::get_user_ip_address() );
}
```

When using the `pase` parameter (for third-party authentication), the timestamp must be within 1 minute of the stored timestamp to prevent replay attacks.

Sources: [src/ctrls/OperacionesHomeCtrl.php:297-308]()

---

## Integration Points

### REST API Integration

HomeCtrl provides a seamless transition to the REST API layer:

```mermaid
graph LR
    REQUEST["HTTP Request"]
    HOMEPHP["home.php"]
    HC["HomeCtrl::__construct()"]
    CHECK{"PATH_INFO<br/>isset?"}
    REST["Rest::handler()"]
    OC["OperacionesCtrl"]
    RENDER["HomeCtrl::render()"]
    
    REQUEST --> HOMEPHP
    HOMEPHP --> HC
    HC --> CHECK
    CHECK -->|Yes| REST
    CHECK -->|No| RENDER
    REST --> OC
```

**Diagram: REST API Integration Point**

When `PATH_INFO` is present, HomeCtrl immediately delegates to the REST handler, which processes the API request using Bearer token authentication. See [Rest - REST API Handler](#3.3) for details.

Sources: [src/ctrls/HomeCtrl.php:64-69]()

### Session Management Integration

HomeCtrl initializes sessions for tracking user state:

```php
if(!isset($_SESSION)){
    session_start();
}
```

This ensures session data is available for authentication, user preferences, and CSRF protection throughout the home application.

Sources: [src/ctrls/HomeCtrl.php:158-160]()

### Template System Integration

The rendering system integrates with the template hierarchy:

```
src/tpls/
├── home/
│   ├── Encabezadohome.phtml      (Header)
│   ├── Workspace.phtml             (Default home page)
│   ├── [ErrorPage].phtml           (Error display)
│   └── [PiePage].phtml             (Footer)
└── [other templates]/
```

Templates can reference JavaScript namespaces via `HomeCtrl::JS_Name_get()` for client-side operations.

Sources: [src/ctrls/HomeCtrl.php:162-196]()

### Database Integration

HomeCtrl indirectly integrates with the database through `OperacionesHomeCtrl`, which uses `Singleton` for queries:

```mermaid
graph TB
    HC["HomeCtrl"]
    OHC["OperacionesHomeCtrl"]
    SING["Singleton"]
    DB[("MySQL Database<br/>nuevapp_apps")]
    
    subgraph "Tables Accessed"
        T1["userselecto"]
        T2["codigoactiva"]
        T3["extusers"]
        T4["docsestados"]
        T5["adjuntosflujos"]
        T6["estadoselecto"]
        T7["perfilselecto"]
    end
    
    HC --> OHC
    OHC --> SING
    SING --> DB
    DB --> T1
    DB --> T2
    DB --> T3
    DB --> T4
    DB --> T5
    DB --> T6
    DB --> T7
```

**Diagram: Database Access Pattern**

For database connection management details, see [Singleton - Database Connection Manager](#5.1).

Sources: [src/ctrls/OperacionesHomeCtrl.php:45](), [src/ctrls/OperacionesHomeCtrl.php:124](), [src/ctrls/OperacionesHomeCtrl.php:205](), [src/ctrls/OperacionesHomeCtrl.php:282](), [src/ctrls/OperacionesHomeCtrl.php:537]()

---

## Email Template System

### Template Structure

Email templates use placeholder syntax `{$variable}` for dynamic content:

```php
$replacement_array = self::ObtenerEtiquetasEmail($_aed);
$mensaje = preg_replace_callback(
    '~\{\$(.*?)\}~si',
    function($match) use ($replacement_array) {
        return str_replace($match[0], 
            isset($replacement_array[$match[1]]) ? 
                $replacement_array[$match[1]] : $match[0], 
            $match[0]);
    },
    $tplCode);
```

### Default Template Variables

| Variable | Value | Description |
|----------|-------|-------------|
| `{$b}` | Base URL | Application base URL from `Utiles::getBaseUrl()` |
| `{$u}` | Home URL | `base_url/home.php` |
| `{$i}` | Index URL | `base_url/index.php` |
| `{$f}` | Timestamp | Current timestamp in `YmdHis` format |
| `{$CLAVE_TMP}` | Activation code | Temporary activation code (when sending activation email) |

Additional variables can be passed via the `$d` parameter to `ObtenerEtiquetasEmail()`.

Sources: [src/ctrls/OperacionesHomeCtrl.php:13-25](), [src/ctrls/OperacionesHomeCtrl.php:156-165]()

### Activation Email Template

The activation email template is loaded from:
```
src/sistema/email/nuevaclavehome.phtml
```

This template receives the `{$CLAVE_TMP}` variable containing the unique activation code.

Sources: [src/ctrls/OperacionesHomeCtrl.php:156]()

---

## Usability Tracking

### Event Logging

The home application logs usability events for analytics:

```php
$_olg = array(
    "refid" => "WEB_USR_LGN_OK",
    "vl"=> "Ingreso exitoso front usuario",
    "usr" => $v['nombres'] . ' ' . $v['apellidos']
);
OperacionesCtrl::Usabilidad_agregar( $_olg );
```

### Tracked Events

| Event ID | Description | Trigger |
|----------|-------------|---------|
| `WEB_USR_LGN_OK` | Successful user login | When `ListarPdfUrs()` is called (implies successful authentication) |

The `Usabilidad_AgregarHome()` method provides a wrapper for delegating to `OperacionesCtrl::Usabilidad_agregar()`.

Sources: [src/ctrls/OperacionesHomeCtrl.php:568-577](), [src/ctrls/OperacionesHomeCtrl.php:451-460]()

---

## Security Considerations

### SQL Injection Risks

Several methods use string concatenation for SQL queries, which presents SQL injection vulnerabilities:

```php
$extra .= "where mail like '" . trim($dtllave) . "' ";
```

**Recommendation**: These should be migrated to use `Singleton::_safeSelect()` with prepared statements. See [Singleton - Database Connection Manager](#5.1) for secure query methods.

Sources: [src/ctrls/OperacionesHomeCtrl.php:280](), [src/ctrls/OperacionesHomeCtrl.php:203](), [src/ctrls/OperacionesHomeCtrl.php:432]()

### Authentication Token Hashing

The external authentication endpoint uses MD5 hashing for identification:

```php
if( $_POST["ajax"] == md5( "Api/IntegraAutentica" ) )
```

While MD5 is cryptographically weak, it's used here only for endpoint identification, not for security validation. The actual authentication logic in `LoginFromExterno()` should implement proper validation.

Sources: [src/ctrls/HomeCtrl.php:74]()

### Password Field Removal

User data returned from authentication methods explicitly removes the password field:

```php
if( isset( $_u["clave"] ) ) unset( $_u["clave"] );
```

This prevents accidental password leakage in JSON responses or logs.

Sources: [src/ctrls/OperacionesHomeCtrl.php:300](), [src/ctrls/OperacionesHomeCtrl.php:317]()

### LDAP Credential Exposure

LDAP bind attempts suppress errors with `@`:

```php
$bind = @ldap_bind($ldap, $ldaprdn, $password);
```

This prevents credential exposure in error messages but may complicate debugging. Consider using structured error logging instead.

Sources: [src/ctrls/OperacionesHomeCtrl.php:351]()

---

## Summary

`HomeCtrl` serves as the entry point controller for the public-facing home application. It provides:

1. **Request Routing**: Differentiates between REST API, AJAX authentication, and page rendering requests
2. **Template Management**: Dynamic page loading with optional controller logic
3. **Authentication Gateway**: Multiple authentication methods including email, LDAP, and third-party OAuth
4. **Business Logic Delegation**: Thin controller that delegates to `OperacionesHomeCtrl` for operations
5. **Session Management**: Initializes and maintains user sessions
6. **JavaScript Namespace**: Provides collision-free client-side namespacing

The controller follows a clear separation of concerns, handling routing and presentation while delegating business logic and data access to specialized classes. Integration with the REST API layer is seamless through the constructor's early detection of `PATH_INFO`, allowing a single entry point to serve both traditional page requests and API calls.

Sources: [src/ctrls/HomeCtrl.php:1-201](), [src/ctrls/OperacionesHomeCtrl.php:1-604]()

---

---

## 3.3 Rest - REST API Handler

## Purpose and Scope

The `Rest` class provides a RESTful API gateway for GESFINANCIERO, handling external API requests with Bearer token authentication and routing them to the business logic layer. This handler operates independently from the traditional AJAX endpoints defined in `IndexCtrl`, offering a standardized REST interface for authenticated API clients.

For information about the traditional AJAX API endpoints, see [AJAX API Endpoints](#9.2). For details on token generation and management, see [Token Management](#10.2). For the business logic that Rest delegates to, see [OperacionesCtrl - Core Operations](#4.1).

**Key Responsibilities:**
- Bearer token and Basic authentication validation
- MD5-based endpoint routing
- HTTP request method handling (GET, POST, PUT, DELETE)
- JSON request/response processing
- Token expiration enforcement
- Delegation to `OperacionesCtrl` for business operations

Sources: [src/ctrls/Rest.php:1-277]()

---

## Architecture Overview

**Diagram: REST Handler Integration in System Architecture**

```mermaid
graph TB
    subgraph "Entry Point"
        INDEX["index.php"]
    end
    
    subgraph "Routing Layer"
        INDEXCTRL["IndexCtrl::render()"]
    end
    
    subgraph "REST Handler Layer"
        REST["Rest::handler()"]
        BEARER["getBearerToken()"]
        BASIC["getAuthBasic()"]
    end
    
    subgraph "Authentication Layer"
        COMPARETOKEN["OperacionesCtrl::CompararToken()"]
        APIBOX["ApiboxLib::Comparar()"]
        DB_APIBOX[("apibox table")]
    end
    
    subgraph "Business Logic Layer"
        OPCTRL["OperacionesCtrl"]
        
        AUTH_OP["AutenticaUsuarioSisAjax()"]
        RECOV_OP["RecuperarByEmailAjax()"]
        CLAVE_OP["RecuAsignarClaveAjax()"]
        COMM_OP["comunicaciones_CheckForSend()"]
        FIRM_OP["firmaspro_Revisar()"]
        GEST_OP["gestordocumentalHelper()"]
    end
    
    subgraph "Method Dispatchers"
        TKN_PREFIX["tkn_ prefix methods<br/>Require token auth"]
        NOTKN_PREFIX["notkn_ prefix methods<br/>Public access"]
        MD5_MATCH["MD5 hash matching<br/>Legacy endpoints"]
    end
    
    INDEX --> INDEXCTRL
    INDEXCTRL -->|"PATH_INFO set"| REST
    
    REST --> BEARER
    REST --> BASIC
    
    BEARER --> COMPARETOKEN
    COMPARETOKEN --> APIBOX
    APIBOX --> DB_APIBOX
    
    REST --> TKN_PREFIX
    REST --> NOTKN_PREFIX
    REST --> MD5_MATCH
    
    TKN_PREFIX --> OPCTRL
    NOTKN_PREFIX --> OPCTRL
    MD5_MATCH --> OPCTRL
    
    OPCTRL --> AUTH_OP
    OPCTRL --> RECOV_OP
    OPCTRL --> CLAVE_OP
    OPCTRL --> COMM_OP
    OPCTRL --> FIRM_OP
    OPCTRL --> GEST_OP
```

The REST handler sits between `IndexCtrl` and `OperacionesCtrl`, serving as an authentication gateway and routing mechanism for API requests. Unlike AJAX endpoints which use session-based authentication, REST endpoints use Bearer tokens validated against the `apibox` database table.

Sources: [src/ctrls/Rest.php:114-275](), [src/ctrls/OperacionesCtrl.php:674-862]()

---

## Authentication System

### Bearer Token Authentication

The primary authentication mechanism for REST API requests uses Bearer tokens in the `Authorization` header.

**Diagram: Token Authentication Flow**

```mermaid
sequenceDiagram
    participant Client
    participant Rest as "Rest::handler()"
    participant Bearer as "getBearerToken()"
    participant OpCtrl as "OperacionesCtrl"
    participant ApiboxLib
    participant DB as "apibox table"
    
    Client->>Rest: "POST /api/endpoint<br/>Authorization: Bearer {token}"
    Rest->>Bearer: "Extract token from header"
    Bearer-->>Rest: "token string"
    
    alt Token exists
        Rest->>OpCtrl: "CompararToken({pkey: token})"
        OpCtrl->>ApiboxLib: "Comparar({pkey: token})"
        ApiboxLib->>DB: "SELECT * WHERE publica = ?"
        DB-->>ApiboxLib: "token record"
        ApiboxLib-->>OpCtrl: "token data array"
        OpCtrl-->>Rest: "token validation result"
        
        alt Token active and valid
            Rest->>Rest: "Check token expiration<br/>(fecha + CFG_LGIN_APT minutes)"
            
            alt Not expired
                Rest->>Rest: "Set auten = true"
                Rest->>Rest: "Route to endpoint"
            else Expired
                Rest-->>Client: "401 Unauthorized<br/>{err: 'Expired token'}"
            end
        else Token disabled
            Rest-->>Client: "401 Unauthorized<br/>{err: 'Disabled token'}"
        end
    else Invalid token
        Rest-->>Client: "401 Unauthorized<br/>{err: 'Invalid token'}"
    end
```

**Token Validation Logic:**

| Check | Location | Purpose |
|-------|----------|---------|
| Token existence | [src/ctrls/Rest.php:123-124]() | Extracts Bearer token from Authorization header |
| Token comparison | [src/ctrls/Rest.php:126]() | Validates token against database via `CompararToken()` |
| Token active status | [src/ctrls/Rest.php:133]() | Ensures `activo == 1` in apibox table |
| Token expiration | [src/ctrls/Rest.php:134-142]() | Validates timestamp against `CFG_LGIN_APT` config (default 60 minutes) |

Sources: [src/ctrls/Rest.php:123-163](), [src/ctrls/OperacionesCtrl.php:804-818]()

### Basic Authentication

Basic authentication is used exclusively for token generation endpoints, allowing clients to obtain Bearer tokens using username/password credentials.

**Basic Auth Workflow:**

```mermaid
graph LR
    CLIENT["API Client"]
    REST["Rest::handler()"]
    GETAUTH["getAuthBasic()"]
    GENTKN["tkn_GenerarToken()"]
    OPCTRL["OperacionesCtrl::GenerarToken()"]
    
    CLIENT -->|"Authorization: Basic base64(u:c)"| REST
    REST --> GETAUTH
    GETAUTH -->|"{u: username, c: password}"| REST
    REST -->|"ajax == 'GenerarToken'"| GENTKN
    GENTKN --> OPCTRL
    OPCTRL -->|"Bearer token"| CLIENT
```

The Basic authentication flow extracts credentials from the `Authorization` header and uses them to generate a new Bearer token. This token can then be used for subsequent authenticated requests.

Sources: [src/ctrls/Rest.php:165-166](), [src/ctrls/Rest.php:240-244](), [src/ctrls/OperacionesCtrl.php:674-787]()

### Token Configuration

Token behavior is controlled by system configuration stored in the `adminconfig` table:

| Configuration Key | Constant | Purpose | Default |
|-------------------|----------|---------|---------|
| `cfglginapt` | `CFG_LGIN_APT` | Token lifetime in minutes | 60 |

The token expiration check reads this configuration value and compares the current time against the token's `fecha` field plus the configured lifetime.

Sources: [src/ctrls/Rest.php:130-131](), [src/ctrls/OperacionesCtrl.php:1312-1324]()

---

## Request Processing Pipeline

The `Rest::handler()` method implements a comprehensive request processing pipeline that handles authentication, routing, and response generation.

**Diagram: Complete Request Processing Flow**

```mermaid
graph TB
    START["Request arrives<br/>PATH_INFO set"]
    
    HANDLER["Rest::handler()"]
    EXTRACT["Extract PATH_INFO<br/>and HTTP method"]
    
    subgraph "Authentication Phase"
        GET_BEARER["getBearerToken()"]
        CHECK_BEARER{"Bearer token<br/>exists?"}
        VALIDATE_TOKEN["Validate token via<br/>CompararToken()"]
        TOKEN_VALID{"Token valid<br/>and active?"}
        CHECK_BASIC["getAuthBasic()"]
    end
    
    subgraph "Routing Phase"
        GET_INPUT["Parse JSON body<br/>file_get_contents('php://input')"]
        UTF8_FIX{"JSON error 5?<br/>(UTF-8 issue)"}
        EXTRACT_AJAX["Extract ajax param<br/>from PATH_INFO"]
        CHECK_METHOD{"HTTP Method?"}
    end
    
    subgraph "Dispatch Phase - POST"
        CHECK_WSDL{"ajax == md5('wsdl')?"}
        LIST_METHODS["List all endpoints<br/>with MD5 hashes"]
        CHECK_GENTKN{"ajax == 'GenerarToken'<br/>& Basic auth?"}
        GEN_TOKEN["tkn_GenerarToken()"]
        CHECK_AUTEN{"auten == true?"}
        DISPATCH_TKN["Dispatch to tkn_ method"]
        DISPATCH_MD5["Dispatch via MD5 match"]
        ERROR_404["Return 400<br/>'Endpoint no existe'"]
    end
    
    subgraph "Dispatch Phase - GET"
        DISPATCH_GET_MD5["Match MD5 hash"]
        DISPATCH_NOTKN["Dispatch notkn_ method"]
    end
    
    RESPONSE["Execute endpoint method"]
    JSON_OUT["Output JSON"]
    DIE["die()"]
    
    START --> HANDLER
    HANDLER --> EXTRACT
    EXTRACT --> GET_BEARER
    
    GET_BEARER --> CHECK_BEARER
    CHECK_BEARER -->|"Yes"| VALIDATE_TOKEN
    CHECK_BEARER -->|"No"| CHECK_BASIC
    
    VALIDATE_TOKEN --> TOKEN_VALID
    TOKEN_VALID -->|"Yes"| GET_INPUT
    TOKEN_VALID -->|"No"| DIE
    
    CHECK_BASIC --> GET_INPUT
    
    GET_INPUT --> UTF8_FIX
    UTF8_FIX -->|"Yes, fix"| EXTRACT_AJAX
    UTF8_FIX -->|"No"| EXTRACT_AJAX
    
    EXTRACT_AJAX --> CHECK_METHOD
    
    CHECK_METHOD -->|"POST"| CHECK_WSDL
    CHECK_METHOD -->|"GET"| DISPATCH_GET_MD5
    
    CHECK_WSDL -->|"Yes"| LIST_METHODS
    CHECK_WSDL -->|"No"| CHECK_GENTKN
    
    CHECK_GENTKN -->|"Yes"| GEN_TOKEN
    CHECK_GENTKN -->|"No"| CHECK_AUTEN
    
    CHECK_AUTEN -->|"Yes"| DISPATCH_TKN
    CHECK_AUTEN -->|"No"| DISPATCH_MD5
    
    DISPATCH_TKN --> RESPONSE
    DISPATCH_MD5 --> RESPONSE
    DISPATCH_GET_MD5 --> RESPONSE
    DISPATCH_NOTKN --> RESPONSE
    
    ERROR_404 --> DIE
    LIST_METHODS --> DIE
    GEN_TOKEN --> JSON_OUT
    
    RESPONSE --> JSON_OUT
    JSON_OUT --> DIE
```

**Key Processing Steps:**

1. **Initialization** ([src/ctrls/Rest.php:116]()): Enables `allow_url_fopen` for API calls
2. **Authentication extraction** ([src/ctrls/Rest.php:123-166]()): Attempts Bearer token, falls back to Basic auth
3. **Request parsing** ([src/ctrls/Rest.php:168-189]()): Extracts PATH_INFO, parses JSON body with UTF-8 handling
4. **Method routing** ([src/ctrls/Rest.php:202-274]()): Dispatches based on HTTP method and authentication status
5. **Response termination** (throughout): All endpoint methods call `die()` to prevent further execution

Sources: [src/ctrls/Rest.php:114-275]()

---

## Endpoint Routing Mechanism

The REST handler uses a sophisticated routing system that combines MD5 hashing, method name prefixes, and reflection to map URLs to handler methods.

### MD5-Based Routing

Legacy endpoints use MD5 hashes of method names to obfuscate API endpoints:

```mermaid
graph LR
    subgraph "Client Request"
        URL["POST /a30004055c915a3c7bc971256074374e"]
    end
    
    subgraph "Rest Handler"
        HASH["ajax = 'a30004055c915a3c7bc971256074374e'"]
        METHODS["get_class_methods('Rest')"]
        ITERATE["Loop through methods"]
        COMPARE["md5('Api/Servidor/' + method_name)"]
        MATCH{"Hash matches?"}
    end
    
    subgraph "Discovered Method"
        EXEC["RecuAsignarClave()"]
    end
    
    URL --> HASH
    HASH --> METHODS
    METHODS --> ITERATE
    ITERATE --> COMPARE
    COMPARE --> MATCH
    MATCH -->|"Yes"| EXEC
```

**MD5 Hash Examples from Code:**

| Hash | Method Name | Purpose |
|------|-------------|---------|
| `a30004055c915a3c7bc971256074374e` | `RecuAsignarClave` | Password reset assignment |
| `7cdf28cdb306941ec39675734b000b60` | `RecuperarByEmail` | Password recovery via email |
| `88400f0088a755f38f2d3a8d6f3a39fd` | `AutenticaUsuarioSis` | User authentication |
| `dd3bda2f13f14aef6cc0ede06064e75d` | `wsdl` | List all available endpoints |

Sources: [src/ctrls/Rest.php:4](), [src/ctrls/Rest.php:27](), [src/ctrls/Rest.php:51](), [src/ctrls/Rest.php:229-237](), [src/ctrls/Rest.php:261-267]()

### Method Prefix Routing

Modern endpoints use method name prefixes to determine authentication requirements:

**Method Prefix System:**

```mermaid
graph TB
    REQUEST["Incoming Request"]
    
    subgraph "Prefix Detection"
        AJAX["ajax parameter<br/>from PATH_INFO"]
        TKN_CHECK{"Prefix: 'tkn_'?"}
        NOTKN_CHECK{"Prefix: 'notkn_'?"}
    end
    
    subgraph "Token-Required Endpoints"
        TKN_METHOD["method_exists('Rest', 'tkn_' + ajax)"]
        TKN_EXEC["Execute tkn_{ajax}()"]
    end
    
    subgraph "Public Endpoints"
        NOTKN_METHOD["method_exists('Rest', 'notkn_' + ajax)"]
        NOTKN_EXEC["Execute notkn_{ajax}()"]
    end
    
    AUTH_CHECK["Authentication<br/>validated?"]
    
    REQUEST --> AJAX
    AJAX --> TKN_CHECK
    AJAX --> NOTKN_CHECK
    
    TKN_CHECK -->|"Yes"| AUTH_CHECK
    AUTH_CHECK -->|"Yes"| TKN_METHOD
    AUTH_CHECK -->|"No"| ERROR["401 Unauthorized"]
    
    TKN_METHOD --> TKN_EXEC
    
    NOTKN_CHECK -->|"Yes"| NOTKN_METHOD
    NOTKN_METHOD --> NOTKN_EXEC
```

**Available Prefix Methods:**

| Prefix | Authentication Required | Example Methods |
|--------|------------------------|-----------------|
| `tkn_` | Yes (Bearer token) | `tkn_GenerarToken`, `tkn_*` (dynamic) |
| `notkn_` | No (public access) | `notkn_CheckComm`, `notkn_Revisar`, `notkn_GestorDocumental` |
| (none) | Varies by endpoint | `RecuAsignarClave`, `RecuperarByEmail`, `AutenticaUsuarioSis` |

Sources: [src/ctrls/Rest.php:247-250](), [src/ctrls/Rest.php:207-216](), [src/ctrls/Rest.php:73-102]()

### WSDL Discovery Endpoint

The system includes a self-documenting endpoint that lists all available methods and their MD5 hashes:

**Request:**
```
POST /dd3bda2f13f14aef6cc0ede06064e75d
```

**Response Format:**
```
RecuAsignarClave = a30004055c915a3c7bc971256074374e
RecuperarByEmail = 7cdf28cdb306941ec39675734b000b60
AutenticaUsuarioSis = 88400f0088a755f38f2d3a8d6f3a39fd
...
```

This endpoint iterates through all methods in the `Rest` class using reflection and generates MD5 hashes for each, providing a runtime-generated API documentation.

Sources: [src/ctrls/Rest.php:230-237]()

---

## HTTP Method Support

### POST Method Handling

POST is the primary method for REST API interactions, supporting:

**POST Request Processing:**

```mermaid
graph TB
    POST_START["POST request received"]
    
    HEADERS["Set CORS headers<br/>Access-Control-Allow-*"]
    CONTENT["Set Content-Type:<br/>application/json"]
    
    subgraph "Request Parsing"
        READ_BODY["file_get_contents('php://input')"]
        DECODE["json_decode(body, true)"]
        UTF8_CHECK{"JSON error 5?"}
        UTF8_FIX["json_decode(utf8_encode(body))"]
        ERROR_CHECK{"Other JSON errors?"}
    end
    
    subgraph "Special Endpoints"
        WSDL_CHECK{"ajax == md5('wsdl')?"}
        WSDL_OUTPUT["Output method list"]
    end
    
    subgraph "Authentication Routing"
        BASIC_CHECK{"Basic auth present?"}
        GENTOKEN_CHECK{"ajax == 'GenerarToken'?"}
        GENTOKEN_CALL["tkn_GenerarToken()"]
    end
    
    subgraph "Token Routing"
        TOKEN_AUTH{"Token authenticated?"}
        TKN_METHOD{"method_exists(tkn_)?"}
        TKN_DISPATCH["Call tkn_{ajax}()"]
    end
    
    subgraph "MD5 Routing"
        MD5_ITERATE["Iterate class methods"]
        MD5_MATCH{"MD5 matches?"}
        MD5_DISPATCH["Call matched method"]
    end
    
    NOT_FOUND["400 Bad Request<br/>'Endpoint no existe'"]
    
    POST_START --> HEADERS
    HEADERS --> CONTENT
    CONTENT --> READ_BODY
    READ_BODY --> DECODE
    DECODE --> UTF8_CHECK
    UTF8_CHECK -->|"Yes"| UTF8_FIX
    UTF8_CHECK -->|"No"| ERROR_CHECK
    UTF8_FIX --> ERROR_CHECK
    ERROR_CHECK -->|"Error 4 or none"| WSDL_CHECK
    ERROR_CHECK -->|"Other error"| NOT_FOUND
    
    WSDL_CHECK -->|"Yes"| WSDL_OUTPUT
    WSDL_CHECK -->|"No"| BASIC_CHECK
    
    BASIC_CHECK -->|"Yes"| GENTOKEN_CHECK
    GENTOKEN_CHECK -->|"Yes"| GENTOKEN_CALL
    GENTOKEN_CHECK -->|"No"| TOKEN_AUTH
    BASIC_CHECK -->|"No"| TOKEN_AUTH
    
    TOKEN_AUTH -->|"Yes"| TKN_METHOD
    TKN_METHOD -->|"Yes"| TKN_DISPATCH
    TKN_METHOD -->|"No"| NOT_FOUND
    
    TOKEN_AUTH -->|"No"| MD5_ITERATE
    MD5_ITERATE --> MD5_MATCH
    MD5_MATCH -->|"Yes"| MD5_DISPATCH
    MD5_MATCH -->|"No"| NOT_FOUND
```

**CORS Configuration:**

The REST handler sets permissive CORS headers for all POST requests:

| Header | Value | Purpose |
|--------|-------|---------|
| `Access-Control-Allow-Origin` | `*` | Allow requests from any origin |
| `Access-Control-Allow-Headers` | `access` | Allow access header |
| `Access-Control-Allow-Methods` | `GET, PUT, POST, DELETE` | Supported HTTP methods |
| `Access-Control-Allow-Credentials` | `true` | Allow credentials in requests |

Sources: [src/ctrls/Rest.php:222-227](), [src/ctrls/Rest.php:170-189](), [src/ctrls/Rest.php:240-268]()

### GET Method Handling

GET requests are used for read-only operations and support both MD5-based and prefix-based routing:

**GET Processing Logic:**

```mermaid
graph LR
    GET_REQ["GET request"]
    
    SET_HEADER["Content-Type:<br/>text/html; charset=utf-8"]
    GET_METHODS["get_class_methods('Rest')"]
    
    subgraph "Routing Options"
        MD5_LOOP["Loop through methods"]
        MD5_COMPARE{"MD5 match?"}
        
        NOTKN_CHECK["Check notkn_{ajax}<br/>method exists"]
        NOTKN_EXEC["Execute notkn_{ajax}"]
    end
    
    EXECUTE["Execute matched method"]
    
    GET_REQ --> SET_HEADER
    SET_HEADER --> GET_METHODS
    GET_METHODS --> MD5_LOOP
    MD5_LOOP --> MD5_COMPARE
    MD5_COMPARE -->|"Yes"| EXECUTE
    MD5_COMPARE -->|"No"| NOTKN_CHECK
    NOTKN_CHECK -->|"Exists"| NOTKN_EXEC
    NOTKN_EXEC --> EXECUTE
```

Unlike POST requests, GET requests set `Content-Type: text/html` instead of `application/json`, though the response format is typically still JSON.

Sources: [src/ctrls/Rest.php:203-218]()

### PUT and DELETE Methods

PUT and DELETE method handlers are currently empty placeholders in the codebase:

```
case 'PUT':
    // - 
    break;
case 'DELETE':
    
    break;
```

These methods are defined but not implemented, suggesting future expansion plans for the API.

Sources: [src/ctrls/Rest.php:219-221](), [src/ctrls/Rest.php:271-273]()

---

## Integration with Business Logic Layer

The `Rest` class acts as a thin wrapper around `OperacionesCtrl`, delegating all business logic to the operations layer.

### Delegation Pattern

**Diagram: Rest-to-OperacionesCtrl Delegation**

```mermaid
graph TB
    subgraph "Rest Class Methods"
        REST_RECU["RecuAsignarClave(data)"]
        REST_RECOV["RecuperarByEmail(data)"]
        REST_AUTH["AutenticaUsuarioSis(data)"]
        REST_COMM["notkn_CheckComm(data)"]
        REST_REVIS["notkn_Revisar(data)"]
        REST_GEST["notkn_GestorDocumental(data)"]
    end
    
    subgraph "OperacionesCtrl Methods"
        OP_RECU["RecuAsignarClaveAjax(data)"]
        OP_RECOV["RecuperarByEmailAjax(data)"]
        OP_AUTH["AutenticaUsuarioSisAjax(data)"]
        OP_COMM["comunicaciones_CheckForSend(data)"]
        OP_REVIS["firmaspro_Revisar(data)"]
        OP_GEST["gestordocumentalHelper(data)"]
    end
    
    subgraph "Response Pattern"
        TRY["try { ... }"]
        CATCH["catch (Exception ex)"]
        JSON_OK["echo json_encode(ok)"]
        JSON_ERR["echo json_encode({err: msg})"]
        DIE["die()"]
    end
    
    REST_RECU --> OP_RECU
    REST_RECOV --> OP_RECOV
    REST_AUTH --> OP_AUTH
    REST_COMM --> OP_COMM
    REST_REVIS --> OP_REVIS
    REST_GEST --> OP_GEST
    
    OP_RECU --> TRY
    TRY --> JSON_OK
    TRY --> CATCH
    CATCH --> JSON_ERR
    JSON_OK --> DIE
    JSON_ERR --> DIE
```

**Common Delegation Pattern:**

All REST endpoint methods follow the same structure:

1. Call corresponding `OperacionesCtrl` method with input data
2. Wrap call in try-catch block
3. Encode result as JSON
4. Terminate with `die()`

Sources: [src/ctrls/Rest.php:15-102]()

### Available REST Endpoints

**Table: REST Endpoints and Their Business Logic Handlers**

| REST Method | MD5 Hash | OperacionesCtrl Method | Purpose |
|-------------|----------|------------------------|---------|
| `RecuAsignarClave` | `a30004055...` | `RecuAsignarClaveAjax` | Assign new password using activation code |
| `RecuperarByEmail` | `7cdf28cd...` | `RecuperarByEmailAjax` | Send password recovery email |
| `AutenticaUsuarioSis` | `88400f00...` | `AutenticaUsuarioSisAjax` | Authenticate user credentials |
| `notkn_CheckComm` | (no hash) | `comunicaciones_CheckForSend` | Check communications for sending |
| `notkn_Revisar` | (no hash) | `firmaspro_Revisar` | Review signature processes |
| `notkn_GestorDocumental` | (no hash) | `gestordocumentalHelper` | Document management helper |

The `notkn_` prefixed methods explicitly call `OperacionesCtrl::authRequOff()` to disable authentication requirements before delegating to business logic.

Sources: [src/ctrls/Rest.php:15-25](), [src/ctrls/Rest.php:39-49](), [src/ctrls/Rest.php:59-69](), [src/ctrls/Rest.php:73-102]()

### Token Generation Endpoint

The token generation endpoint is unique in that it's directly handled by Rest rather than delegating immediately:

**Token Generation Flow:**

```mermaid
sequenceDiagram
    participant Client
    participant Rest
    participant OpCtrl as "OperacionesCtrl"
    participant ApiboxLib
    participant DB as "apibox table"
    
    Client->>Rest: "POST /GenerarToken<br/>Basic Auth: user:pass"
    Rest->>Rest: "getAuthBasic()<br/>extract {u, c}"
    Rest->>OpCtrl: "GenerarToken({u, c})"
    OpCtrl->>OpCtrl: "AutenticaUsuarioSisAjax({u, c})"
    OpCtrl->>OpCtrl: "Validate credentials<br/>and profile (1,2,7)"
    OpCtrl->>OpCtrl: "GenerarLlavePublica({mail})"
    OpCtrl->>OpCtrl: "Create RSA key pair"
    OpCtrl->>ApiboxLib: "Crear({id, key})"
    ApiboxLib->>DB: "INSERT INTO apibox"
    DB-->>ApiboxLib: "new token ID"
    ApiboxLib-->>OpCtrl: "token data"
    OpCtrl-->>Rest: "Public key"
    Rest-->>Client: "200 OK<br/>{public_key}"
```

This endpoint requires Basic authentication and generates a new RSA key pair stored in the `apibox` table, returning the public key as the Bearer token.

Sources: [src/ctrls/Rest.php:240-244](), [src/ctrls/OperacionesCtrl.php:674-787]()

---

## Error Handling

The REST handler implements consistent error handling patterns throughout the request lifecycle.

### Authentication Errors

**Authentication Error Responses:**

| Condition | HTTP Status | Response Body | Location |
|-----------|-------------|---------------|----------|
| Invalid token | 401 | `{"err":"Invalid token"}` | [src/ctrls/Rest.php:157-162]() |
| Disabled token | 401 | `{"err":"Disabled token"}` | [src/ctrls/Rest.php:148-153]() |
| Expired token | 401 | `{"err":"Expired token"}` | [src/ctrls/Rest.php:137-142]() |

All authentication errors set appropriate WWW-Authenticate headers and terminate immediately with `exit`.

Sources: [src/ctrls/Rest.php:137-162]()

### JSON Parsing Errors

The handler includes special logic for handling JSON parsing issues:

**JSON Error Handling:**

```mermaid
graph TB
    DECODE["json_decode(input)"]
    CHECK_ERROR["json_last_error()"]
    
    ERROR_5{"Error code 5?<br/>(UTF-8 issue)"}
    UTF8_RETRY["json_decode(<br/>utf8_encode(input))"]
    LOG["error_log(error details)"]
    
    ERROR_4{"Error code 4?<br/>(Syntax error)"}
    IGNORE["Continue<br/>(ignore error)"]
    
    OTHER_ERROR["Return error JSON<br/>and die()"]
    
    DECODE --> CHECK_ERROR
    CHECK_ERROR --> ERROR_5
    ERROR_5 -->|"Yes"| UTF8_RETRY
    UTF8_RETRY --> LOG
    LOG --> CONTINUE["Continue processing"]
    
    ERROR_5 -->|"No"| ERROR_4
    ERROR_4 -->|"Yes"| IGNORE
    ERROR_4 -->|"No"| OTHER_ERROR
    
    IGNORE --> CONTINUE
```

**JSON Error Codes:**

| Code | Constant | Handler Behavior | Reason |
|------|----------|------------------|--------|
| 5 | `JSON_ERROR_UTF8` | Retry with UTF-8 encoding, log error | Non-UTF-8 characters |
| 4 | `JSON_ERROR_SYNTAX` | Ignore, continue | Syntax errors (handled differently) |
| Other | Various | Return error and die | All other JSON errors |

Sources: [src/ctrls/Rest.php:173-189]()

### Endpoint Not Found Errors

When no matching endpoint is found, the handler returns a 400 status:

```json
{
  "err": "Endpoint no existe"
}
```

This occurs when:
- No method matches the MD5 hash
- No `tkn_` prefixed method exists for the requested endpoint
- No `notkn_` prefixed method exists for GET requests

Sources: [src/ctrls/Rest.php:255-259]()

### Business Logic Errors

All business logic errors from `OperacionesCtrl` are caught and returned as JSON:

**Error Response Pattern:**

```php
try {
    $ok = OperacionesCtrl::SomeMethod($data);
    echo json_encode($ok);
} catch (Exception $ex) {
    $er = array("err" => $ex->getMessage());
    echo json_encode($er);
}
die("");
```

This pattern is used consistently across all endpoint methods, ensuring that exceptions from the business logic layer are properly serialized and returned to the client.

Sources: [src/ctrls/Rest.php:17-24](), [src/ctrls/Rest.php:41-48](), [src/ctrls/Rest.php:61-68]()

---

## Request/Response Lifecycle

**Diagram: Complete Request/Response Lifecycle**

```mermaid
sequenceDiagram
    participant Client
    participant IndexPHP as "index.php"
    participant IndexCtrl
    participant Rest
    participant OpCtrl as "OperacionesCtrl"
    participant ApiboxLib
    participant Singleton
    participant DB
    
    Client->>IndexPHP: "Request with PATH_INFO"
    IndexPHP->>IndexCtrl: "new IndexCtrl()<br/>->render()"
    IndexCtrl->>IndexCtrl: "Check PATH_INFO"
    
    alt PATH_INFO is set
        IndexCtrl->>Rest: "Rest::handler()"
        
        Rest->>Rest: "Extract Bearer token"
        Rest->>OpCtrl: "CompararToken({pkey})"
        OpCtrl->>ApiboxLib: "Comparar({pkey})"
        ApiboxLib->>Singleton: "_readInfo('apibox')"
        Singleton->>DB: "SELECT query"
        DB-->>Singleton: "token record"
        Singleton-->>ApiboxLib: "result array"
        ApiboxLib-->>OpCtrl: "token data"
        OpCtrl-->>Rest: "validation result"
        
        Rest->>Rest: "Validate expiration"
        Rest->>Rest: "Parse request body"
        Rest->>Rest: "Route to endpoint"
        
        Rest->>OpCtrl: "Business logic method(data)"
        OpCtrl->>Singleton: "Database operations"
        Singleton->>DB: "CRUD queries"
        DB-->>Singleton: "results"
        Singleton-->>OpCtrl: "processed data"
        OpCtrl-->>Rest: "operation result"
        
        Rest->>Rest: "json_encode(result)"
        Rest->>Client: "JSON response"
        Rest->>Rest: "die()"
    end
    
    Note over Rest,Client: Request terminates here<br/>No further processing
```

The REST handler ensures that once a REST API request is processed, execution terminates immediately with `die()`, preventing any HTML rendering or additional processing by `IndexCtrl`.

Sources: [src/ctrls/Rest.php:114-275](), [index.php]() (referenced)

---

## Configuration Dependencies

The REST handler relies on several system configurations:

**Configuration Table:**

| Configuration | Constant | Used For | Default | Location |
|--------------|----------|----------|---------|----------|
| Token lifetime | `CFG_LGIN_APT` | Token expiration validation | 60 minutes | [src/ctrls/Rest.php:130]() |

The token lifetime is read from the `adminconfig` table and determines how long Bearer tokens remain valid after their creation timestamp.

**Token Expiration Calculation:**

```
current_time > token.fecha + CFG_LGIN_APT minutes
```

If this condition is true, the token is considered expired and authentication fails with a 401 error.

Sources: [src/ctrls/Rest.php:129-142](), [src/ctrls/OperacionesCtrl.php:1312-1324]()

---

## Security Considerations

### Token Management

1. **Token Storage**: Bearer tokens (public keys) are stored in the `apibox` table and compared against incoming requests
2. **Token Expiration**: Time-based expiration prevents indefinite token validity
3. **Token Status**: The `activo` field allows administrative disabling of tokens without deletion
4. **Profile Restrictions**: Only users with `perfil_id` 1, 2, or 7 can generate tokens

Sources: [src/ctrls/Rest.php:123-163](), [src/ctrls/OperacionesCtrl.php:697-698]()

### MD5 Obfuscation

The MD5-based endpoint routing provides minimal security through obscurity:

- Endpoint URLs are hashed, making API discovery more difficult
- However, MD5 is not cryptographically secure and can be brute-forced
- The WSDL endpoint (`md5('wsdl')`) exposes all endpoint hashes anyway
- This pattern is likely legacy code; modern endpoints use plain names with `tkn_` prefix

Sources: [src/ctrls/Rest.php:230-237](), [src/ctrls/Rest.php:261-267]()

### Public Endpoints

Methods prefixed with `notkn_` bypass authentication entirely:

- `notkn_CheckComm` - Communication checking
- `notkn_Revisar` - Signature review
- `notkn_GestorDocumental` - Document management

These endpoints explicitly call `OperacionesCtrl::authRequOff()` to disable authentication checks, making them publicly accessible. This design should be carefully reviewed to ensure no sensitive operations are exposed.

Sources: [src/ctrls/Rest.php:73-102]()

### CORS Configuration

The permissive CORS policy (`Access-Control-Allow-Origin: *`) allows requests from any origin. While convenient for API clients, this should be restricted in production environments to known domains.

Sources: [src/ctrls/Rest.php:223-226]()

---

## Usage Examples

### Generating a Bearer Token

**Request:**
```http
POST /index.php/GenerarToken HTTP/1.1
Authorization: Basic base64(username:password)
Content-Type: application/json
```

**Response:**
```json
{
  "publica": "-----BEGIN PUBLIC KEY-----\n...\n-----END PUBLIC KEY-----"
}
```

Sources: [src/ctrls/Rest.php:240-244](), [src/ctrls/OperacionesCtrl.php:674-787]()

### Using Bearer Token Authentication

**Request:**
```http
POST /index.php/tkn_SomeEndpoint HTTP/1.1
Authorization: Bearer -----BEGIN PUBLIC KEY-----...-----END PUBLIC KEY-----
Content-Type: application/json

{
  "param1": "value1",
  "param2": "value2"
}
```

**Success Response:**
```json
{
  "ok": "result data"
}
```

**Error Response:**
```json
{
  "err": "error message"
}
```

Sources: [src/ctrls/Rest.php:123-163](), [src/ctrls/Rest.php:247-250]()

### Password Recovery

**Request:**
```http
POST /index.php/7cdf28cdb306941ec39675734b000b60 HTTP/1.1
Content-Type: application/json

{
  "emailactivar": "user@example.com"
}
```

**Response:**
```json
{
  "ok": "md5_hash_of_user_id"
}
```

Sources: [src/ctrls/Rest.php:39-49](), [src/ctrls/OperacionesCtrl.php:952-1035]()

### Listing Available Endpoints

**Request:**
```http
POST /index.php/dd3bda2f13f14aef6cc0ede06064e75d HTTP/1.1
```

**Response:**
```
RecuAsignarClave = a30004055c915a3c7bc971256074374e
RecuperarByEmail = 7cdf28cdb306941ec39675734b000b60
AutenticaUsuarioSis = 88400f0088a755f38f2d3a8d6f3a39fd
handler = [excluded]
```

Sources: [src/ctrls/Rest.php:230-237]()

---

---

## 4. Business Logic Layer

## Purpose and Scope

The Business Logic Layer serves as the centralized service tier in GESFINANCIERO, encapsulating all core business operations and isolating them from the presentation layer. This layer is implemented through two primary controller classes: `OperacionesCtrl` for authenticated application operations and `OperacionesHomeCtrl` for public-facing operations.

This document covers the business logic implementation, service methods, and operational patterns. For information about how controllers route requests to this layer, see [Controller Layer](#3). For database interaction patterns, see [Data Layer](#5).

**Sources:** High-level architecture diagrams, [src/ctrls/OperacionesCtrl.php:1-2203](), [src/ctrls/OperacionesHomeCtrl.php:1-606]()

---

## Business Logic Architecture

The business logic layer implements a service-oriented architecture where operations are grouped into two main classes based on authentication context.

```mermaid
graph TB
    subgraph "Business Logic Layer"
        OPCTRL["OperacionesCtrl<br/>Core Business Logic"]
        OPHOMECTRL["OperacionesHomeCtrl<br/>Public Operations"]
    end
    
    subgraph "Controller Layer"
        INDEXCTRL["IndexCtrl"]
        HOMECTRL["HomeCtrl"]
        REST["Rest"]
    end
    
    subgraph "Data Layer"
        SINGLETON["Singleton"]
        CLSDATOS["Clsdatos"]
        MODELS["Model Classes"]
    end
    
    subgraph "External Libraries"
        APIBOXLIB["ApiboxLib"]
        MAGICPAGESLIB["MagicPagesLib"]
        PHPMAILER["PHPMailer"]
    end
    
    INDEXCTRL -->|"delegates operations"| OPCTRL
    REST -->|"delegates operations"| OPCTRL
    HOMECTRL -->|"delegates operations"| OPHOMECTRL
    
    OPCTRL --> SINGLETON
    OPCTRL --> MODELS
    OPHOMECTRL --> SINGLETON
    OPHOMECTRL --> MODELS
    OPHOMECTRL -->|"reuses services"| OPCTRL
    
    OPCTRL --> APIBOXLIB
    OPCTRL --> MAGICPAGESLIB
    OPCTRL --> PHPMAILER
```

**Diagram: Business Logic Layer Position in System Architecture**

**Sources:** [src/ctrls/OperacionesCtrl.php:1-10](), [src/ctrls/OperacionesHomeCtrl.php:1-10]()

---

## OperacionesCtrl - Core Business Operations

The `OperacionesCtrl` class [src/ctrls/OperacionesCtrl.php:5]() contains the primary business logic for authenticated operations. This class provides static methods that implement service operations across multiple functional domains.

### Class Constants and Configuration

The class defines several categories of constants used throughout the application:

| Constant Category | Purpose | Examples |
|------------------|---------|----------|
| SQL Configuration | Database execution settings | `SQL_BIG_SELECTS` |
| Localization Data | Spanish translations | `$GBL_DIAS`, `$GBL_MESES` |
| Healthcare Lists | Colombian EPS/ARL providers | `$GBL_EPS_LIST`, `$GBL_ARL_LIST` |
| Email Labels | Template variable descriptors | `LABELS_EMAIL_DESCR` |
| PDF Configuration | Document generation settings | `CFG_PDF_PAGECONFIG` |
| SMTP Configuration | Email service settings | `CFG_SMTP_*` constants |
| Storage Configuration | File storage limits | `CFG_ALMACENAMIENTO_TAMANO` |

**Sources:** [src/ctrls/OperacionesCtrl.php:13-1262]()

---

### Authentication Services

The authentication subsystem provides multiple authentication methods and token management capabilities.

```mermaid
graph LR
    subgraph "Authentication Methods"
        AUTH_B64["AutenticaUsuarioSisAjaxB64"]
        AUTH_AJAX["AutenticaUsuarioSisAjax"]
    end
    
    subgraph "Token Management"
        GEN_KEY["GenerarLlavePublica"]
        GEN_TOKEN["GenerarToken"]
        OBT_TOKEN["ObtenerToken"]
        CMP_TOKEN["CompararToken"]
    end
    
    subgraph "Data Storage"
        APIBOX["ApiboxLib"]
        DB_USERS["usuarios table"]
    end
    
    AUTH_B64 --> AUTH_AJAX
    AUTH_AJAX --> DB_USERS
    
    GEN_TOKEN --> GEN_KEY
    GEN_TOKEN --> AUTH_AJAX
    GEN_TOKEN --> APIBOX
    OBT_TOKEN --> APIBOX
    CMP_TOKEN --> APIBOX
```

**Diagram: Authentication Service Flow**

#### User Authentication

**`AutenticaUsuarioSisAjax($d, $md5Met = false)`** [src/ctrls/OperacionesCtrl.php:560-595]()

Authenticates users against the `usuarios` table using either:
- **Direct authentication**: Username/email + password
- **MD5 hash authentication**: Pre-hashed credentials

Parameters:
- `$d['u']`: Username or email (or MD5 hash)
- `$d['c']`: Password (not required if using MD5 method)
- `$md5Met`: Boolean flag for MD5 authentication mode

Returns user data excluding the password field. Throws exceptions with HTTP error codes:
- `ERR_COD_MSJ_ERR_COMUN` (duplicate users)
- `ERR_COD_USUARIO_O_CLAVE_INVALIDA` (invalid credentials)

**`AutenticaUsuarioSisAjaxB64($d)`** [src/ctrls/OperacionesCtrl.php:505-534]()

Wrapper method that decodes Base64-encoded JSON credentials and routes to either session-based or direct authentication.

**Sources:** [src/ctrls/OperacionesCtrl.php:505-595]()

#### RSA Token Management

The system implements RSA key pair-based authentication tokens for API access.

**`GenerarLlavePublica($d)`** [src/ctrls/OperacionesCtrl.php:621-643]()

Generates RSA-2048 key pairs with SHA-512 digest algorithm. Private keys are protected with a passphrase derived from user email and timestamp.

Configuration:
```php
"digest_alg" => "sha512"
"private_key_bits" => 2048
"private_key_type" => OPENSSL_KEYTYPE_RSA
```

**`GenerarToken($d)`** [src/ctrls/OperacionesCtrl.php:674-787]()

Creates or retrieves API tokens for authorized users (profiles 1, 2, or 7). Workflow:
1. Authenticates user credentials
2. Checks user state (must be active, `estado_id == 1`)
3. Verifies authorized profile
4. Retrieves existing token or generates new RSA key pair
5. Stores token via `ApiboxLib`

Parameters:
- `$d['u']`, `$d['c']`: User credentials
- `$d['md5']`: Optional MD5 authentication flag
- `$d['forcenew']`: Force generation of new token

**`CompararToken($d)`** [src/ctrls/OperacionesCtrl.php:804-818]()

Validates a provided public key against stored tokens via `ApiboxLib::Comparar()`.

**`ObtenerToken($d)`** [src/ctrls/OperacionesCtrl.php:839-862]()

Private method to retrieve token data for a user ID, with optional private key inclusion.

**Sources:** [src/ctrls/OperacionesCtrl.php:621-862]()

---

### Email Services

The email subsystem provides template-based email notifications with variable substitution and dual delivery methods (local SMTP or external service).

```mermaid
graph TB
    subgraph "Email Operations"
        OBT_ETIQ["ObtenerEtiquetasEmail"]
        ENV_NOTIF["enviar_Notificacion"]
        ENV_CUSTOM["enviarCustomEmail"]
        EST_TPL["EstablecerPlantillasEmail"]
    end
    
    subgraph "Email Templates"
        TPL_BASE["GET_BASE_MAIL"]
        TPL_FILES["nuevaclave.html<br/>codigocheck.html<br/>nuevaclavehome.phtml"]
    end
    
    subgraph "Delivery Methods"
        CORREO["Correo class<br/>Local SMTP"]
        EXT_API["External API<br/>TFServices"]
    end
    
    OBT_ETIQ -->|"provides variables"| ENV_NOTIF
    ENV_NOTIF --> TPL_FILES
    ENV_NOTIF --> ENV_CUSTOM
    ENV_CUSTOM -->|"CFG_SMTP_TFSERVICE=false"| CORREO
    ENV_CUSTOM -->|"CFG_SMTP_TFSERVICE=true"| EXT_API
    EST_TPL --> TPL_FILES
    TPL_BASE --> TPL_FILES
```

**Diagram: Email Service Architecture**

#### Template Variable System

**`ObtenerEtiquetasEmail($d = array())`** [src/ctrls/OperacionesCtrl.php:251-289]()

Generates template variables for email personalization:

| Variable | Description | Example |
|----------|-------------|---------|
| `corto` | URL base configuration | Config::URLBASE |
| `b` | Full base URL | `https://example.com/` |
| `u` | Home page URL | `https://example.com/home.php` |
| `i` | Index page URL | `https://example.com/index.php` |
| `f` | Unique timestamp | `20240115143022` |
| `logo64` | Corporate logo base64 | Base64-encoded image |
| `now_*` | Current date/time components | `now_date`, `now_time`, etc. |

Custom variables can be added via the `$d` parameter array.

**Label descriptors** are defined in `LABELS_EMAIL_DESCR` [src/ctrls/OperacionesCtrl.php:216-231]() for UI display.

**`GET_BASE_MAIL()`** [src/ctrls/OperacionesCtrl.php:298-300]()

Returns the absolute path to the email templates directory: `src/sistema/email/`.

**Sources:** [src/ctrls/OperacionesCtrl.php:216-300]()

#### Email Sending Operations

**`enviarCustomEmail($d)`** [src/ctrls/OperacionesCtrl.php:324-412]()

Sends custom emails using either local SMTP or external API service based on configuration.

Required parameters in `$d`:
- `para`: Recipient email address
- `titulo`: Email subject
- `mensaje`: HTML message content
- `desde`: Sender email address
- `rotulo`: Sender display name

Optional parameters:
- `adjunto`: File attachment path (local SMTP only)
- `adjuntofull`: Full path attachment (external service)

Configuration flags:
- `CFG_SMTP_TFSERVICE`: Enable/disable external service
- `CFG_SMTP_TFSERVICEURL`: External API URL
- `CFG_SMTP_TFSAPITOKEN`: API authentication token (base64-encoded)
- `CFG_SMTP_TFSCLIID`: Client ID for external service

**Local SMTP Configuration:**
Uses the `Correo` class with settings from `Corporation.php`. Supports attachments directly.

**External Service Integration:**
Makes POST request to external API with JSON payload:
```php
{
  "destino": "recipient@example.com",
  "titulo64": "base64_encoded_subject",
  "mensaje": "base64_encoded_html_message",
  "adjuntofull": "attachment_path",
  "idserver": "subdomain",
  "cliente": "client_id"
}
```

**`enviar_Notificacion($d)`** [src/ctrls/OperacionesCtrl.php:433-480]()

Private method that combines template processing with email sending:
1. Loads HTML template from `src/sistema/email/{$d['tpl']}`
2. Applies variable substitution using regex pattern `{\$(.*?)}`
3. Calls `enviarCustomEmail()` with processed content

Parameters:
- `tpl`: Template filename (e.g., "bienvenida.html")
- `campos`: Variables for template substitution
- `para`: Recipient email
- `titulo`: Optional custom subject
- `desde`: Optional custom sender
- `rotulo`: Optional sender label

**`EstablecerPlantillasEmail($d)`** [src/ctrls/OperacionesCtrl.php:1954-1972]()

Updates email template content:
- `tplid`: Template identifier (filename without extension)
- `tplv`: New HTML content

Writes directly to `src/sistema/email/{$tplid}.html`. Throws `ERR_COD_PLANTILLA_NO_SALVADA` if template file doesn't exist.

**Sources:** [src/ctrls/OperacionesCtrl.php:324-480](), [src/ctrls/OperacionesCtrl.php:1954-1972]()

---

### Account Recovery System

Account recovery implements a time-limited temporary code mechanism for password reset.

```mermaid
graph TD
    REC_EMAIL["RecuperarByEmailAjax"]
    REC_ASIGNAR["RecuAsignarClaveAjax"]
    
    subgraph "Code Generation"
        GEN_CODE["Generate 6-digit code"]
        SAVE_CODE["Save to codigoactiva table"]
        SEND_MAIL["Send email with code"]
    end
    
    subgraph "Code Validation"
        CHECK_CODE["Verify code exists"]
        CHECK_TIME["Validate 10-minute window"]
        CHECK_USED["Verify not already used"]
        UPDATE_PWD["Update password"]
        MARK_USED["Mark code as used"]
    end
    
    REC_EMAIL --> GEN_CODE
    GEN_CODE --> SAVE_CODE
    SAVE_CODE --> SEND_MAIL
    
    REC_ASIGNAR --> CHECK_CODE
    CHECK_CODE --> CHECK_TIME
    CHECK_TIME --> CHECK_USED
    CHECK_USED --> UPDATE_PWD
    UPDATE_PWD --> MARK_USED
```

**Diagram: Account Recovery Flow**

**`RecuperarByEmailAjax($d)`** [src/ctrls/OperacionesCtrl.php:952-1035]()

Initiates password recovery by generating and emailing a temporary 6-digit code.

Process:
1. Validates email format
2. Searches `usuarios` or `userselecto` table (based on `gnrtk` parameter)
3. Deletes any existing codes for the user
4. Generates unique 6-digit code via `Utiles::nuevoCl(6)`
5. Stores code in `codigoactiva` table with `activo=0`
6. Sends email using "nuevaclave.html" template
7. Returns `md5($user_id)` as key for next step

Retry mechanism: Attempts up to 20 times if code collision occurs.

**`RecuAsignarClaveAjax($d)`** [src/ctrls/OperacionesCtrl.php:1062-1126]()

Completes password reset using the temporary code.

Parameters:
- `codActiva`: The 6-digit code from email
- `key`: MD5 hash of user ID from previous step
- `c`: New password to set

Validation checks:
1. Code exists and matches user key
2. Code hasn't been used (`activo == 0`)
3. Code was created within last 10 minutes
4. Updates code to `activo=1` after successful use

Password update: Stores as MD5 hash in `usuarios.clave` field.

**Sources:** [src/ctrls/OperacionesCtrl.php:952-1126]()

---

### Activation Code Management

The activation code system provides temporary verification codes for various authentication flows.

**`codigoactiva_Add($d)`** [src/ctrls/OperacionesCtrl.php:1452-1520]()

Generates and emails a 6-digit activation code to users.

Parameters:
- `id`: User ID (required)
- `email`: Recipient email address (required)
- `cdm`: Optional manual code override

Features:
- Automatic collision detection with up to 20 retry attempts
- Uses "codigocheck.html" email template
- Codes stored in `codigoactiva` table with timestamp
- Email subject: "Nuevapp - Codigo de activacion #YmdHis"

**`codigoactivaHelper_Add($d)`** [src/ctrls/OperacionesCtrl.php:1607-1643]()

Low-level helper that manages code persistence:
1. Deletes existing codes for user ID
2. Deletes any existing instances of the code
3. Inserts new code record with `activo=0`

Table structure: `(id, nombre, fecha, activo, userselecto_id)`

**`codigoactivaHelperJson64_Add($d)`** [src/ctrls/OperacionesCtrl.php:1545-1587]()

Specialized helper for employee-acudiente (guardian) code generation. Decodes Base64 JSON data to match employees with guardians and generates activation codes with associated document signatures.

**`codigoactiva_Get($d)`** [src/ctrls/OperacionesCtrl.php:1666-1710]()

Validates activation codes without marking them as used.

Parameters:
- `codActiva`: 6-digit code to validate
- `key`: MD5 hash of user ID

Validation:
- Code must exist and match user key
- Code must not be used (`activo == 0`)
- Code must be within 10-minute validity window

Returns `{"ok": true}` if valid.

**`codigoactiva_Eliminar($d)`** [src/ctrls/OperacionesCtrl.php:1751-1778]()

Administrative method to delete activation codes. Requires active session authentication.

Parameters:
- `id`: Specific code ID to delete
- `clean`: If true, deletes all codes

**`codigoactiva_Eliminar_limpiar()`** [src/ctrls/OperacionesCtrl.php:1726-1733]()

Convenience wrapper that deletes all activation codes.

**Sources:** [src/ctrls/OperacionesCtrl.php:1452-1778]()

---

### File Operations

The file operation subsystem handles uploads, image processing, and base64 image extraction.

**`SubirArchivo($nm, $pth, $nombrecampo = 'file')`** [src/ctrls/OperacionesCtrl.php:1800-1845]()

Private method for secure file uploads with validation.

Supported formats:
- Images: `png`, `jpg`, `jpeg`
- Documents: `pdf`, `doc`, `docx`, `txt`
- Spreadsheets: `xls`, `xlsx`, `csv`
- Fonts: `ttf`

Process:
1. Validates `$_FILES` array contains expected field
2. Checks for upload errors (file size, etc.)
3. Validates file extension against allowlist
4. Creates destination directory if needed
5. Moves uploaded file to `$pth/$nm.extension`

Returns final filename with extension.

**`redimensionImg2($filePath, $newWidth, $newHeight)`** [src/ctrls/OperacionesCtrl.php:2072-2134]()

Resizes images while maintaining aspect ratio.

Features:
- Automatic ratio calculation if only one dimension provided
- Supports JPEG, PNG (with alpha transparency), GIF
- Overwrites original file with resized version
- Uses `imagecopyresampled()` for quality preservation

**`processBase64Images($html, $outputDir, $maxwidth = 800, $newWidth = null, $newHeight = null)`** [src/ctrls/OperacionesCtrl.php:2168-2202]()

Extracts and converts base64-encoded images from HTML content.

Process:
1. Scans HTML for `<img>` tags with `data:image/format;base64,data` src
2. Decodes base64 data and saves as physical files
3. Generates unique filenames: `img_{uniqid}.{extension}`
4. Automatically resizes if width exceeds `$maxwidth`
5. Returns array of processed images with original tags and new paths

Supported formats: JPEG, PNG, GIF, WEBP, BMP

Returns structure:
```php
[
  ['original' => '<img src="data:...">', 'new_path' => '/path/to/img_abc123.jpg'],
  // ...
]
```

**Sources:** [src/ctrls/OperacionesCtrl.php:1800-2202]()

---

### Configuration Management

System configuration is stored in the `adminconfig` table and accessed through standardized methods.

```mermaid
graph LR
    subgraph "Configuration API"
        READ["LeerConfigCorp"]
        WRITE["EscribirConfig"]
        MODIFY["ModificaConfigCorp"]
    end
    
    subgraph "Database"
        ADMINCONFIG["adminconfig table<br/>nombre, val, usuario_full, fecha"]
    end
    
    READ --> ADMINCONFIG
    WRITE --> MODIFY
    MODIFY --> ADMINCONFIG
```

**Diagram: Configuration Management Flow**

**`LeerConfigCorp()`** [src/ctrls/OperacionesCtrl.php:1312-1324]()

Retrieves all configuration entries from `adminconfig` table and returns them as an associative array indexed by configuration name.

Return structure:
```php
[
  'cfgsmtphost' => [
    'id' => 1,
    'nombre' => 'cfgsmtphost',
    'val' => 'smtp.example.com',
    'usuario_full' => 'Admin User',
    'fecha' => '2024-01-15 14:30:00'
  ],
  // ...
]
```

**`EscribirConfig($d)`** [src/ctrls/OperacionesCtrl.php:1283-1295]()

Public method to create or update a configuration value.

Parameters:
- `id`: Configuration name identifier
- `vl`: New value to store
- `ufull`: Full name of user making the change

Delegates to `ModificaConfigCorp()` and returns operation result.

**`ModificaConfigCorp($llave, $valor, $ufull)`** [src/ctrls/OperacionesCtrl.php:1346-1382]()

Private method that implements the actual configuration persistence logic:

**Update path** (configuration exists):
- Uses prepared statement via `Singleton::_safeUpdate()`
- Updates `val`, `usuario_full`, and `fecha` fields
- Where clause: `id = ?`

**Insert path** (new configuration):
- Uses classic insert via `Singleton::_classicInsertUniqQuery()`
- Inserts: `(null, nombre, val, usuario_full, fecha)`

Returns: `{"ok": boolean, "cfg": configuration_name}`

**Sources:** [src/ctrls/OperacionesCtrl.php:1283-1382]()

#### Configuration Constants

The class defines numerous configuration constant identifiers:

**SMTP Configuration** [src/ctrls/OperacionesCtrl.php:1149-1235]():
- `CFG_SMTP_AUTHSMTP`: SMTP authentication required (boolean string)
- `CFG_SMTP_PORT`: Port number (25, 587, 465, 2525)
- `CFG_SMTP_HOST`: Server hostname
- `CFG_SMTP_USER`: Authentication username
- `CFG_SMTP_PASS`: Authentication password
- `CFG_SMTP_SECURE`: Security protocol (ssl/tls/none)
- `CFG_SMTP_TFSERVICE`: Enable external email service
- `CFG_SMTP_TFSERVICEURL`: External service API URL
- `CFG_SMTP_TFSAPITOKEN`: External service token (base64)
- `CFG_SMTP_TFSCLIID`: Client ID for external service

**Other Configuration** [src/ctrls/OperacionesCtrl.php:1138-1262]():
- `CFG_PDF_PAGECONFIG`: PDF generation settings
- `CFG_ALMACENAMIENTO_TAMANO`: Storage size limits
- `CFG_DEDUCCIONES_DATA`: Preloaded deductions data
- `CFG_REQUERIMIENTOS_MEZCLA`: Document template mixing rules (JSON)

**Sources:** [src/ctrls/OperacionesCtrl.php:1138-1262]()

---

### URL Masking and File Access

**`crearUrlMask($d, $msk)`** [src/ctrls/OperacionesCtrl.php:889-928]()

Serves files from protected directories using MD5-obfuscated paths.

Mask types defined in `IndexCtrl`:
- `MASK_FLD_REPO_ANEXOS`: Files in `repo/anexos/`
- `MASK_FLD_REPO_PROCESOS`: Files in `repo/proc/{year}/`

Parameters:
- `id`: MD5 hash of directory name
- `doc`: Filename to serve
- `anyo`: Year (required for PROCESOS mask)

Process:
1. Maps mask type to base directory
2. Scans directory for folder matching MD5 hash
3. Resolves actual directory name
4. Serves file with PDF headers

Response headers:
```
Content-Type: application/pdf
Content-Disposition: inline; filename="..."
Content-Transfer-Encoding: binary
Accept-Ranges: bytes
```

**Sources:** [src/ctrls/OperacionesCtrl.php:889-928]()

---

### Utility Operations

**`CallAPI($method, $url, $data = false, $opt = array())`** [src/ctrls/OperacionesCtrl.php:2003-2048]()

Generic HTTP client for external API communication using cURL.

Supported methods:
- **POST**: Sends JSON-encoded data or raw string
- **PUT**: Configures PUT request
- **GET** (default): Appends data as query string

Custom options via `$opt` parameter (CURLOPT_* constants).

Default settings:
```php
CURLOPT_FAILONERROR => true
CURLOPT_RETURNTRANSFER => true
```

Returns response body as string. Throws exception on cURL errors.

**`fuentes_Obtener($d)`** [src/ctrls/OperacionesCtrl.php:1399-1428]()

Recursively scans directories for TrueType font files (.ttf).

Parameters:
- `ruta`: Base directory path

Returns nested array structure:
```php
[
  'FontFamily' => [
    'Bold' => 'fonts/FontFamily/FontFamily-Bold.ttf',
    'Italic' => 'fonts/FontFamily/FontFamily-Italic.ttf',
    'VariableFont_wght' => 'fonts/FontFamily/FontFamily.ttf'
  ]
]
```

Organizes fonts by type suffix (Bold, Italic, etc.) extracted from filename pattern.

**`componenteHTML($d)`** [src/ctrls/OperacionesCtrl.php:154-207]()

Parses custom HTML component tags in format `[type attribute=value]` and converts them to component structures or extracts attributes.

Parameters:
- `html`: Content with component tags
- `solohtml`: If true, only extracts attributes without component creation

Attribute parsing:
- Automatically converts numeric strings to int/float
- Converts "true"/"false" to boolean
- Returns typed attribute array

**`LogNotify_Add($d)`** [src/ctrls/OperacionesCtrl.php:1865-1895]()

Records notification events to `lognotify` table. Currently disabled (code commented out) but maintains structure for:
- Destination tracking
- Estado/status logging
- User association
- Flujo (workflow) linking

**`LogNotify_Get($d)`** [src/ctrls/OperacionesCtrl.php:1915-1936]()

Retrieves notification logs for a workflow with optional grouping by destination to count delivery attempts.

Parameters:
- `flujos_id`: Workflow ID to filter
- `grupo`: If present, groups by destination and adds `intentos` count

**Sources:** [src/ctrls/OperacionesCtrl.php:154-207](), [src/ctrls/OperacionesCtrl.php:1399-1428](), [src/ctrls/OperacionesCtrl.php:1865-1936](), [src/ctrls/OperacionesCtrl.php:2003-2048]()

---

## OperacionesHomeCtrl - Home-Specific Operations

The `OperacionesHomeCtrl` class [src/ctrls/OperacionesHomeCtrl.php:2]() provides business logic for public-facing operations accessible without full system authentication. This class frequently delegates to `OperacionesCtrl` for shared services.

### Architecture Pattern

```mermaid
graph TB
    HOMECTRL["HomeCtrl<br/>Public Controller"]
    OPHOMECTRL["OperacionesHomeCtrl<br/>Home Operations"]
    OPCTRL["OperacionesCtrl<br/>Core Operations"]
    
    HOMECTRL -->|"calls"| OPHOMECTRL
    OPHOMECTRL -->|"delegates common services"| OPCTRL
    OPHOMECTRL -->|"direct DB access"| SINGLETON["Singleton"]
    
    subgraph "Home-Specific Methods"
        ACTIVAR["activarCuenta"]
        LOGIN["LoginUsur"]
        LDAP["LoginLdapUsur"]
        LISTPDF["ListarPdfUrs"]
    end
    
    OPHOMECTRL --> ACTIVAR
    OPHOMECTRL --> LOGIN
    OPHOMECTRL --> LDAP
    OPHOMECTRL --> LISTPDF
```

**Diagram: OperacionesHomeCtrl Architecture**

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:1-10](), [src/ctrls/OperacionesHomeCtrl.php:255](), [src/ctrls/OperacionesHomeCtrl.php:453]()

---

### Account Activation System

The home activation system uses long-lived activation codes (1-year validity) for email verification.

**`activarCuenta($d)`** [src/ctrls/OperacionesHomeCtrl.php:37-68]()

Validates activation codes for account activation.

Parameters:
- `c`: Activation code
- `u`: User key (user ID)

Validation:
- Code must exist in `codigoactiva` table matching user ID
- Code must be created within last **1 year** (different from password recovery 10-minute window)
- Query: `WHERE nombre = '{code}' AND userselecto_id = '{user}'`

Returns `true` if valid. Note: Does not mark code as used, allowing reactivation.

**`actviarSendMail($d)`** [src/ctrls/OperacionesHomeCtrl.php:111-185]()

Generates and emails activation code to users.

Parameters:
- `emailactivar`: Recipient email address
- `d`: User data array with `id` field

Process:
1. Validates email format with `filter_var(FILTER_VALIDATE_EMAIL)`
2. Checks for existing codes (but doesn't prevent reuse)
3. Generates code via `Utiles::nuevoCl()` (different from 6-digit codes)
4. Stores in `codigoactiva` with `activo=0`
5. Sends email using "nuevaclavehome.phtml" template
6. Returns `md5($user_id)`

Retry mechanism: Up to 20 attempts for unique code generation.

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:37-185]()

---

### Authentication Methods

OperacionesHomeCtrl implements multiple authentication strategies for public access.

#### Email-Based Authentication

**`LoginUsurCod($d)`** [src/ctrls/OperacionesHomeCtrl.php:217-239]()

Sends activation code for email-based login.

Parameters:
- `u`: User email address

Process:
1. Searches `userselecto` table by email
2. If user found, calls `actviarSendMail()` to send code
3. Returns `{"ok": {"estado": boolean, "datos": array}}`

**`LoginUsur($d)`** [src/ctrls/OperacionesHomeCtrl.php:254-322]()

Main authentication method that verifies activation codes and returns user data.

Parameters:
- `u`: Email or identifier
- `c`: Code parameter (passed to `activarCuenta`)
- `pase`: Optional temporary timestamp token for additional validation

Flow:
1. **Email resolution**: Calls `OperacionesCtrl::ObtenerCorreoPrincipal()` to get primary email if alias provided
2. **User lookup**: Queries `userselecto` with joins to `estadoselecto` and `perfilselecto`
3. **Fallback**: If not found, tries `LoginUsrsExtra()` to check `extusers` table
4. **Pase validation** (if provided):
   - Validates timestamp is within 1 minute of user's `clave` field
   - Logs IP on suspected impersonation
5. **Activation**: Calls `activarCuenta()` to verify code
6. Removes `clave` field from response for security

Returns: `{"ok": {"estado": boolean, "datos": user_object}}`

**`LoginUsrsExtra($d)`** [src/ctrls/OperacionesHomeCtrl.php:197-208]()

Searches for users through the `extusers` linkage table.

Query structure:
```sql
SELECT usel.id, usel.identificacion, usel.nombres, usel.clave, usel.apellidos, 
       usel.mail, usel.tel, usel.creado, usel.estadoselecto_id, esel.nombre as estadoselecto,
       usel.perfilselecto_id, peel.nombre as perfilselecto
FROM userselecto as usel
LEFT JOIN extusers as eu ON eu.userselecto_id = usel.id
LEFT JOIN estadoselecto as esel ON esel.id = usel.estadoselecto_id
LEFT JOIN perfilselecto as peel ON peel.id = usel.perfilselecto_id
WHERE eu.mail LIKE '{email}'
```

**`LoginAsUsur($d)`** [src/ctrls/OperacionesHomeCtrl.php:427-442]()

Simplified user lookup without activation code validation. Used for checking account existence.

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:197-442]()

#### LDAP Authentication

**`LoginLdapUsur($d)`** [src/ctrls/OperacionesHomeCtrl.php:335-384]()

Authenticates users against corporate LDAP/Active Directory.

Parameters:
- `u`: Username (sAMAccountName)
- `c`: Password

Configuration (from `LeerConfigCorp()`):
- `ldapurl`: LDAP server URL
- `ldapdmn`: Domain name
- `ldap_bse`: Base DN for searches

Process:
1. Constructs bind DN: `{username}@{domain}`
2. Sets LDAP options:
   - Protocol version 3
   - Disable referrals
3. Attempts bind with credentials
4. Searches for user: `(sAMAccountName={username})`
5. Currently throws exception if user exists in LDAP but not in local system

Return behavior: Validates credentials via LDAP bind. Exception thrown indicates valid LDAP credentials but missing local account.

**`LoginFromExterno($d)`** [src/ctrls/OperacionesHomeCtrl.php:394-416]()

Placeholder for OAuth/external authentication (Google, Facebook, Microsoft). Currently disabled (commented code).

Intended functionality:
- Updates `userselecto.clave` with current timestamp as temporary token
- Returns affected row count
- Token validated via `LoginUsur()` with `pase` parameter

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:335-416]()

---

### Document Management

**`ListarPdfUrs($d)`** [src/ctrls/OperacionesHomeCtrl.php:499-582]()

Retrieves signed/accepted PDF documents for a user.

Parameters:
- `dm`: User email address
- `id`: User ID for obtaining linked emails

Process:
1. **Email aggregation**: Collects user's primary email plus aliases from `ExtUsers_Obtener()`
2. **Document query**: Complex query parsing `docsestados.nombre` field for embedded paths:
   ```sql
   SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(nombre,'/',-3),'/',1) as adjuntosflujos_id,
          SUBSTRING_INDEX(SUBSTRING_INDEX(nombre,'/',-2),'/',1) as usuario,
          SUBSTRING_INDEX(SUBSTRING_INDEX(nombre,'/',-1),'/',1) as documento
   FROM docsestados
   ```
3. **Filtering**: Only accepted documents (`aceptado = 1`) with active workflow states
4. **PDF generation**: Calls `OperacionesCtrl::ListarPdfGenerados()` for each document
5. **Usability logging**: Records login event to usability table

Return structure:
```php
{
  "ok": [
    {
      "fl": [pdf_files],
      "vcry": "md5_hash",
      "v": "adjuntosflujos_id",
      "fancy": "document_nicename",
      "u": "user_email"
    }
  ],
  "u_u": [user_data]
}
```

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:499-582]()

---

### Delegation Methods

Several methods act as thin wrappers delegating to `OperacionesCtrl`:

**`enviarCustomEmail($dest1, $titulo, $mensaje, $adjuntar = '')`** [src/ctrls/OperacionesHomeCtrl.php:79-99]()

Delegates directly to `OperacionesCtrl::enviarCustomEmail()`. Private method used internally.

**`Usabilidad_AgregarHome($d)`** [src/ctrls/OperacionesHomeCtrl.php:451-460]()

Records usability/analytics events for home page actions. Delegates to `OperacionesCtrl::Usabilidad_agregar()`.

**`ListarMisInsignias($d)`** [src/ctrls/OperacionesHomeCtrl.php:469-478]()

Retrieves user badges/achievements. Delegates to `OperacionesCtrl::ObtenerMisInsignias()`.

**`LeerConfigCorp()`** [src/ctrls/OperacionesHomeCtrl.php:592-602]()

Reads corporate configuration. Delegates to `OperacionesCtrl::LeerConfigCorp()` but currently returns empty array (commented logic suggests this may filter config for public use).

**`ObtenerEtiquetasEmail($d = array())`** [src/ctrls/OperacionesHomeCtrl.php:13-25]()

Simplified version of email template variables without logo and extended datetime fields. Provides only:
- `b`: Base URL
- `u`: Home URL
- `i`: Index URL
- `f`: Timestamp

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:13-25](), [src/ctrls/OperacionesHomeCtrl.php:79-99](), [src/ctrls/OperacionesHomeCtrl.php:451-478](), [src/ctrls/OperacionesHomeCtrl.php:592-602]()

---

## Error Handling Patterns

Both business logic classes implement consistent error handling patterns.

### Exception-Based Error Reporting

Methods throw exceptions for error conditions with:
- Descriptive messages (often with HTML entities for Spanish characters)
- HTTP status code setting via `http_response_code()`
- Error code constants from `IndexCtrl` class

Common error codes:
- `ERR_COD_USUARIO_O_CLAVE_INVALIDA`: Invalid credentials
- `ERR_COD_MSJ_ERR_COMUN`: General errors
- `ERR_COD_ENVIO_MAIL_FALLIDO`: Email sending failures
- `ERR_COD_CORREO_FAIL`: Email system errors
- `ERR_COD_RESPUESTA_SQL_VACIA`: Empty SQL results
- `ERR_COD_ELIMINACION_SQL`: SQL deletion errors
- `ERR_COD_SESION_INACTIVA`: Inactive session
- `ERR_COD_PLANTILLA_NO_SALVADA`: Template save failures

### Exception Message Format

```php
throw new Exception('[{error_code}]{method_name}: {description}');
```

Example: `[500]codigoactiva_Add - Error enviando correo: Connection timeout`

**Sources:** [src/ctrls/OperacionesCtrl.php:360](), [src/ctrls/OperacionesCtrl.php:476](), [src/ctrls/OperacionesCtrl.php:592-594]()

### Try-Catch Delegation Pattern

Methods frequently wrap delegated calls in try-catch blocks to add context:

```php
try {
    $result = OtherClass::method($params);
} catch (Exception $e) {
    throw new Exception('CurrentMethod - OtherClass::method: ' . $e->getMessage());
}
```

This pattern maintains error stack traces while adding calling context.

**Sources:** [src/ctrls/OperacionesCtrl.php:472-477](), [src/ctrls/OperacionesHomeCtrl.php:455-459]()

---

## Method Signature Patterns

### Static Method Architecture

All methods in both classes are static, implementing a stateless service layer. No instance state is maintained between method calls.

```php
public static function MethodName($d) {
    // Implementation
}
```

### Parameter Array Pattern

Most methods accept a single associative array parameter `$d` containing all required and optional parameters:

```php
public static function enviarCustomEmail($d) {
    $dest1 = $d['para'];
    $titulo = $d['titulo'];
    $mensaje = $d['mensaje'];
    $emailDesde = $d['desde'];
    $emailRotulo = $d['rotulo'];
    // ...
}
```

This pattern provides:
- Named parameter simulation
- Optional parameter support via `isset()` checks
- Flexible parameter addition without breaking signatures

### Return Value Patterns

**Success responses:**
```php
return ['ok' => $data];
return ['ok' => true];
return ['ok' => ['estado' => true, 'datos' => $result]];
```

**Direct data returns:**
```php
return $result_array;
return $scalar_value;
```

**Error responses** are always thrown as exceptions, never returned.

**Sources:** [src/ctrls/OperacionesCtrl.php:251](), [src/ctrls/OperacionesCtrl.php:324](), [src/ctrls/OperacionesHomeCtrl.php:254]()

---

## Session and Authentication Requirements

### Authentication Check Methods

Some methods include authentication verification, though implementation details are not visible in the provided code:

**`authRequ()`** - Referenced in [src/ctrls/OperacionesCtrl.php:1753]()
- Validates active user session
- Throws exception with `ERR_COD_SESION_INACTIVA` if not authenticated

**`authRequOff()`** - Referenced in [src/ctrls/OperacionesCtrl.php:1546]()
- Disables authentication requirement for specific operations
- Used in public-facing methods

### Session Access Pattern

Methods accessing session data check for initialization:

```php
if (!isset($_SESSION["usu"])) session_start();
$usuario = (isset($_SESSION["usu"])) 
    ? ($_SESSION["usu"]->getNombres() . " " . $_SESSION["usu"]->getApellidos()) 
    : "-";
```

**Sources:** [src/ctrls/OperacionesCtrl.php:1867](), [src/ctrls/OperacionesCtrl.php:1753]()

---

## Data Layer Integration

The business logic layer interacts with the data layer through two primary mechanisms:

### Direct Singleton Usage

Most methods use `Singleton` class static methods for database operations:

```php
$result = Singleton::_readInfo($table, $columns, $where_clause);
$id = Singleton::_classicInsertUniqQuery($table, $values);
$affected = Singleton::_safeUpdate($table, $set_array, $where, $params);
$deleted = Singleton::_classicDelete($table, $where_clause);
```

### Model Class Usage

Some methods instantiate model classes for CRUD operations:

```php
$ca = new Codigoactiva();
$ca->setNombre($code);
$ca->setActivo(0);
$ca->setUserselecto_id($user_id);
$ca->setFecha(date("Y-m-d H:i:s"));
$result = $ca->saveData();
```

Model error checking:
```php
if (strlen($model->obtenerError()) > 0) {
    throw new Exception($model->obtenerError());
}
```

**Sources:** [src/ctrls/OperacionesCtrl.php:570](), [src/ctrls/OperacionesCtrl.php:979](), [src/ctrls/OperacionesCtrl.php:1359]()

---

## Library Integration

The business logic layer integrates with specialized library components:

### ApiboxLib Integration

Used for RSA token management [src/ctrls/OperacionesCtrl.php:676]():

```php
include_once dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 
    "src" . DIRECTORY_SEPARATOR . "libs" . DIRECTORY_SEPARATOR . 
    "Apibox" . DIRECTORY_SEPARATOR . "ApiboxLib.php";

$tokens = ApiboxLib::Obtener(['id' => $user_id]);
$created = ApiboxLib::Crear(['id' => $user_id, 'key' => $key_pair]);
$updated = ApiboxLib::Actualizar(['id' => $user_id, 'key' => $key_pair]);
$valid = ApiboxLib::Comparar(['pkey' => $public_key]);
```

### PHPMailer Usage

Referenced for local SMTP email delivery [src/ctrls/OperacionesCtrl.php:341-363]():

```php
$correo = new Correo();
$correo->setEsHTML(true);
$correo->setPara($recipient);
$correo->setTitulo($subject);
$correo->setMensaje($html_content);
$correo->setAdjunto($attachment_path);
$result = $correo->enviar();
```

### Utility Class Dependencies

Both classes depend on:
- `Utiles::getBaseUrl()` - URL construction
- `Utiles::nuevoCl($length)` - Random code generation
- `Utiles::get_user_ip_address()` - IP logging

**Sources:** [src/ctrls/OperacionesCtrl.php:253](), [src/ctrls/OperacionesCtrl.php:341](), [src/ctrls/OperacionesCtrl.php:676](), [src/ctrls/OperacionesCtrl.php:980]()

---

## Key Operational Tables

The business logic layer interacts with these primary database tables:

| Table Name | Purpose | Key Operations |
|------------|---------|----------------|
| `usuarios` | User accounts (authenticated) | Authentication, password updates |
| `userselecto` | User accounts (public) | Home authentication, activation |
| `extusers` | Linked email aliases | Email resolution for users |
| `codigoactiva` | Temporary codes | Account activation, password recovery |
| `adminconfig` | System configuration | Read/write config values |
| `docsestados` | Document states | Document listing, status tracking |
| `adjuntosflujos` | Workflow attachments | Document metadata |
| `lognotify` | Notification log | Event tracking (disabled) |

**Sources:** [src/ctrls/OperacionesCtrl.php:570](), [src/ctrls/OperacionesCtrl.php:1072](), [src/ctrls/OperacionesCtrl.php:1316](), [src/ctrls/OperacionesHomeCtrl.php:45](), [src/ctrls/OperacionesHomeCtrl.php:529]()

---

---

## 4.1 OperacionesCtrl - Core Operations

## Purpose and Scope

`OperacionesCtrl` is the central business logic controller in GESFINANCIERO, serving as the primary service layer between the presentation controllers (`IndexCtrl` and `HomeCtrl`) and the data access layer (`Singleton` and `Clsdatos`). This page documents the core operations, functional areas, authentication mechanisms, and service integrations provided by this controller.

For information about how this controller is invoked and the API routing mechanism, see [IndexCtrl - Main Application Controller](#3.1). For home-specific operations, see [OperacionesHomeCtrl - Home Operations](#4.2). For data access patterns, see [Singleton - Database Connection Manager](#5.1).

**Sources:** [src/ctrls/OperacionesCtrl.php:1-2700]()

## Architectural Position

```mermaid
graph TB
    subgraph "Entry Points"
        INDEX["index.php"]
        HOME["home.php"]
    end
    
    subgraph "Controllers"
        INDEXCTRL["IndexCtrl"]
        HOMECTRL["HomeCtrl"]
        REST["Rest"]
    end
    
    subgraph "Business Logic Layer"
        OPCTRL["OperacionesCtrl<br/>Core Service Layer"]
        OPHOMECTRL["OperacionesHomeCtrl<br/>Home Services"]
    end
    
    subgraph "Data Layer"
        SINGLETON["Singleton"]
        CLSDATOS["Clsdatos"]
    end
    
    subgraph "External Libraries"
        APIBOX["ApiboxLib"]
        MAGIC["MagicPagesLib"]
        MAILER["PHPMailer"]
    end
    
    subgraph "External Services"
        DB[("MySQL Database")]
        SMTP["SMTP Server"]
        TFSERVICE["External Email API"]
    end
    
    INDEX --> INDEXCTRL
    HOME --> HOMECTRL
    INDEXCTRL --> REST
    
    INDEXCTRL --> OPCTRL
    HOMECTRL --> OPHOMECTRL
    REST --> OPCTRL
    
    OPCTRL --> SINGLETON
    OPCTRL --> CLSDATOS
    OPCTRL --> APIBOX
    OPCTRL --> MAGIC
    OPCTRL --> MAILER
    
    SINGLETON --> DB
    MAILER --> SMTP
    OPCTRL --> TFSERVICE
```

**OperacionesCtrl Request Flow Diagram**

This diagram illustrates how `OperacionesCtrl` acts as the central business logic hub. Controllers do not directly access the database; instead, they delegate to `OperacionesCtrl` methods which handle validation, business rules, and orchestrate calls to the data layer and external services.

**Sources:** [src/ctrls/OperacionesCtrl.php:1-50](), [src/ctrls/IndexCtrl.php:1308-1420]()

## Core Functional Areas

```mermaid
graph LR
    OPCTRL["OperacionesCtrl"]
    
    subgraph "Authentication & Security"
        AUTH["AutenticaUsuarioSisAjax<br/>AutenticaUsuarioSisAjaxB64"]
        TOKEN["GenerarToken<br/>CompararToken<br/>ObtenerToken"]
        KEYS["GenerarLlavePublica"]
    end
    
    subgraph "Email Services"
        SEND["enviarCustomEmail"]
        NOTIFY["enviar_Notificacion"]
        TPL["ObtenerEtiquetasEmail<br/>EstablecerPlantillasEmail"]
    end
    
    subgraph "Configuration"
        CFG_READ["LeerConfigCorp"]
        CFG_WRITE["ModificaConfigCorp<br/>EscribirConfig"]
        CFG_CONST["CFG_SMTP_*<br/>CFG_PDF_*"]
    end
    
    subgraph "Code Activation"
        CODE_ADD["codigoactiva_Add<br/>codigoactivaHelper_Add"]
        CODE_GET["codigoactiva_Get"]
        CODE_HELPER["codigoactivaHelperJson64_Add"]
    end
    
    subgraph "File Operations"
        UPLOAD["SubirArchivo"]
        IMG["processBase64Images<br/>redimensionImg2<br/>replaceBase64ImagesInHtml"]
        MASK["crearUrlMask"]
    end
    
    subgraph "User Management"
        EMP["empleados_Agregar<br/>Empleados_Helper_Modificar<br/>Empleados_Eliminar"]
        USR["usuarios_Agregar<br/>usuarios_Modificar<br/>usuarios_Eliminar"]
    end
    
    OPCTRL --> AUTH
    OPCTRL --> TOKEN
    OPCTRL --> KEYS
    OPCTRL --> SEND
    OPCTRL --> NOTIFY
    OPCTRL --> TPL
    OPCTRL --> CFG_READ
    OPCTRL --> CFG_WRITE
    OPCTRL --> CFG_CONST
    OPCTRL --> CODE_ADD
    OPCTRL --> CODE_GET
    OPCTRL --> CODE_HELPER
    OPCTRL --> UPLOAD
    OPCTRL --> IMG
    OPCTRL --> MASK
    OPCTRL --> EMP
    OPCTRL --> USR
```

**OperacionesCtrl Functional Area Map**

This diagram maps the major functional areas to their corresponding method names in the codebase. Each area contains multiple related methods that work together to provide complete functionality.

**Sources:** [src/ctrls/OperacionesCtrl.php:505-2700]()

## Authentication and Token Management

### User Authentication

The authentication system provides multiple methods for validating user credentials and generating secure tokens for API access.

**Key Methods:**

| Method | Purpose | Input Parameters | Returns |
|--------|---------|------------------|---------|
| `AutenticaUsuarioSisAjax` | Authenticates user via username/email and password | `u` (username/email), `c` (password) | User data array (excluding password) |
| `AutenticaUsuarioSisAjaxB64` | Authenticates using base64-encoded JSON credentials | `params` (base64 encoded JSON) | User data or boolean |
| `GenerarToken` | Creates RSA key pair for API authentication | `u`, `c`, `md5`, `forcenew` | Public key string or token data |
| `CompararToken` | Validates an API token against stored keys | `pkey` (public key) | Validation result |
| `ObtenerToken` | Retrieves stored API token for user | `id`, `privada` (optional) | Token data array |

```mermaid
sequenceDiagram
    participant Client
    participant IndexCtrl
    participant OperacionesCtrl
    participant ApiboxLib
    participant Singleton
    participant DB
    
    Client->>IndexCtrl: POST with credentials
    IndexCtrl->>OperacionesCtrl: AutenticaUsuarioSisAjax(u, c)
    OperacionesCtrl->>Singleton: _readInfoChar("usuarios", ...)
    Singleton->>DB: SELECT with WHERE clause
    DB-->>Singleton: User record
    Singleton-->>OperacionesCtrl: User data
    
    alt User found
        OperacionesCtrl-->>IndexCtrl: User data (no password)
        IndexCtrl-->>Client: 200 OK with user info
    else User not found
        OperacionesCtrl-->>IndexCtrl: Exception ERR_COD_USUARIO_O_CLAVE_INVALIDA
        IndexCtrl-->>Client: 401 Unauthorized
    end
    
    Client->>IndexCtrl: Request API token
    IndexCtrl->>OperacionesCtrl: GenerarToken(u, c)
    OperacionesCtrl->>OperacionesCtrl: AutenticaUsuarioSisAjax(u, c)
    OperacionesCtrl->>ApiboxLib: Obtener(id)
    ApiboxLib-->>OperacionesCtrl: Existing tokens
    
    alt Token exists
        OperacionesCtrl-->>IndexCtrl: Return existing public key
    else No token
        OperacionesCtrl->>OperacionesCtrl: GenerarLlavePublica()
        OperacionesCtrl->>ApiboxLib: Crear(id, key)
        ApiboxLib->>Singleton: Insert into apibox table
        Singleton->>DB: INSERT query
        DB-->>Singleton: New ID
        ApiboxLib-->>OperacionesCtrl: Token data
        OperacionesCtrl-->>IndexCtrl: New public key
    end
```

**Authentication Flow Diagram**

This sequence shows the complete authentication process including user validation and API token generation. The system uses RSA key pairs for secure API access.

**Sources:** [src/ctrls/OperacionesCtrl.php:505-595](), [src/ctrls/OperacionesCtrl.php:674-787](), [src/ctrls/OperacionesCtrl.php:621-643]()

### RSA Key Generation

The `GenerarLlavePublica` method creates RSA key pairs for API authentication:

- **Algorithm:** SHA-512 digest with 2048-bit RSA keys
- **Private Key Protection:** Encrypted with passphrase combining user email and timestamp
- **Key Format:** PEM format for both public and private keys

```php
// Key generation configuration
$config = array(
    "digest_alg" => "sha512",
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA
);
```

**Sources:** [src/ctrls/OperacionesCtrl.php:621-643]()

### Token Storage and Retrieval

API tokens are managed through the `ApiboxLib` library and stored in the `apibox` database table. The system supports:

- **Token Creation:** New RSA key pairs generated on demand
- **Token Retrieval:** Fetch existing tokens by user ID
- **Token Comparison:** Validate bearer tokens against stored public keys
- **Force Renewal:** Option to generate new tokens even if one exists

**Sources:** [src/ctrls/OperacionesCtrl.php:674-787](), [src/ctrls/OperacionesCtrl.php:804-818](), [src/ctrls/OperacionesCtrl.php:839-862]()

## Email System

### Email Configuration

The email system supports two modes of operation controlled by configuration constants:

| Configuration Constant | Purpose | Default |
|------------------------|---------|---------|
| `CFG_SMTP_AUTHSMTP` | Enable SMTP authentication | true |
| `CFG_SMTP_PORT` | SMTP server port | 25/587/465 |
| `CFG_SMTP_HOST` | SMTP server address | - |
| `CFG_SMTP_USER` | SMTP username | - |
| `CFG_SMTP_PASS` | SMTP password | - |
| `CFG_SMTP_SECURE` | Security protocol (tls/ssl) | - |
| `CFG_SMTP_TFSERVICE` | Enable external email service | false |
| `CFG_SMTP_TFSERVICEURL` | External service URL | - |
| `CFG_SMTP_TFSAPITOKEN` | External service API token (base64) | - |
| `CFG_SMTP_TFSCLIID` | Client ID for external service | - |

```mermaid
graph TD
    START["enviarCustomEmail()"]
    CONFIG["LeerConfigCorp()"]
    CHECK{"CFG_SMTP_TFSERVICE<br/>enabled?"}
    
    LOCALSMTP["Use Local SMTP<br/>Correo class"]
    EXTAPI["Use External API<br/>TFServices"]
    
    LOCAL_BUILD["Build Email<br/>- setPara()<br/>- setTitulo()<br/>- setMensaje()"]
    LOCAL_SEND["correo.enviar()"]
    LOCAL_RESULT["Return result"]
    
    EXT_BUILD["Build JSON payload<br/>- destino<br/>- titulo64<br/>- mensaje (base64)<br/>- adjuntofull"]
    EXT_CALL["CallAPI(POST, url, data)"]
    EXT_RESULT["Parse JSON response"]
    
    START --> CONFIG
    CONFIG --> CHECK
    
    CHECK -->|false| LOCALSMTP
    CHECK -->|true| EXTAPI
    
    LOCALSMTP --> LOCAL_BUILD
    LOCAL_BUILD --> LOCAL_SEND
    LOCAL_SEND --> LOCAL_RESULT
    
    EXTAPI --> EXT_BUILD
    EXT_BUILD --> EXT_CALL
    EXT_CALL --> EXT_RESULT
```

**Email Sending Decision Flow**

The system automatically routes emails through local SMTP or an external API based on configuration. External services receive base64-encoded content for special character handling.

**Sources:** [src/ctrls/OperacionesCtrl.php:324-412](), [src/ctrls/OperacionesCtrl.php:1149-1236]()

### Email Template System

Email templates use a variable substitution system with predefined labels:

**Template Variables:**

```php
const LABELS_EMAIL_DESCR = [
    'corto' => 'URL Config',
    'b' => 'URL Base',
    'u' => 'URL Empleado',
    'i' => 'URL Admin',
    'f' => 'Id única',
    'now_day' => 'Día actual',
    'now_month' => 'Mes actual',
    'now_year' => 'Año actual',
    'now_hour' => 'Horas actual',
    'now_mins' => 'Minuto actual',
    'now_secs' => 'Segudo actual',
    'now_date' => 'Fecha actual',
    'now_time' => 'La hora actual',
    'now_datetime' => 'Fecha y hora actual'
];
```

**Template Usage Pattern:**

1. Load HTML template from `src/sistema/email/` directory
2. Call `ObtenerEtiquetasEmail()` to get replacement array
3. Use regex callback to replace `{$variable}` patterns
4. Send processed HTML via `enviarCustomEmail()`

**Sources:** [src/ctrls/OperacionesCtrl.php:216-231](), [src/ctrls/OperacionesCtrl.php:251-289](), [src/ctrls/OperacionesCtrl.php:433-480](), [src/ctrls/OperacionesCtrl.php:298-300]()

### Notification System

The `enviar_Notificacion` method provides template-based email notifications:

**Parameters:**

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `tpl` | string | Yes | Template filename (without .html) |
| `campos` | array | Yes | Variables for substitution |
| `para` | string | Yes | Recipient email address |
| `titulo` | string | No | Email subject (default: auto-generated) |
| `desde` | string | No | Sender email (default: notificador@nuevapp.com) |
| `rotulo` | string | No | Sender label (default: "Notification") |

**Sources:** [src/ctrls/OperacionesCtrl.php:433-480]()

## Configuration Management

### Configuration Storage

System configuration is stored in the `adminconfig` database table with the following structure:

| Field | Type | Purpose |
|-------|------|---------|
| `id` | int | Primary key |
| `nombre` | string | Configuration constant name |
| `val` | string | Configuration value |
| `usuario_full` | string | User who last modified |
| `fecha` | datetime | Last modification timestamp |

### Configuration Operations

```mermaid
graph LR
    READ["LeerConfigCorp()"]
    WRITE["ModificaConfigCorp()"]
    HELPER["EscribirConfig()"]
    
    READ -->|Returns| ARRAY["Associative array<br/>indexed by 'nombre'"]
    
    HELPER -->|Calls| WRITE
    
    WRITE -->|Check exists| EXISTS{"Config<br/>exists?"}
    EXISTS -->|Yes| UPDATE["Singleton::_safeUpdate()"]
    EXISTS -->|No| INSERT["Singleton::_classicInsertUniqQuery()"]
    
    UPDATE --> RESULT["Return ok: true, cfg: key"]
    INSERT --> RESULT
```

**Configuration Read/Write Flow**

Configuration reads return the complete config as an indexed array. Writes automatically determine whether to update existing or insert new records.

**Sources:** [src/ctrls/OperacionesCtrl.php:1312-1324](), [src/ctrls/OperacionesCtrl.php:1346-1382](), [src/ctrls/OperacionesCtrl.php:1283-1295]()

### Key Configuration Areas

**PDF Configuration:**
- `CFG_PDF_PAGECONFIG`: Page format settings for PDF generation

**SMTP Configuration:**
- `CFG_SMTP_AUTHSMTP`: Authentication requirement
- `CFG_SMTP_PORT`, `CFG_SMTP_HOST`: Server connection
- `CFG_SMTP_USER`, `CFG_SMTP_PASS`: Credentials
- `CFG_SMTP_SECURE`: Security protocol (ssl/tls)
- `CFG_SMTP_TFSERVICE`: External service toggle
- `CFG_SMTP_TFSERVICEURL`, `CFG_SMTP_TFSAPITOKEN`, `CFG_SMTP_TFSCLIID`: External service config

**Storage Configuration:**
- `CFG_ALMACENAMIENTO_TAMANO`: Storage size limits

**Business Logic Configuration:**
- `CFG_DEDUCCIONES_DATA`: Preloaded deductions data
- `CFG_REQUERIMIENTOS_MEZCLA`: Template mixing configuration for workflows

**Sources:** [src/ctrls/OperacionesCtrl.php:1138-1262]()

## Code Activation System

The code activation system provides temporary verification codes for email-based account activation and password recovery.

### Code Generation and Validation

```mermaid
sequenceDiagram
    participant User
    participant System
    participant OperacionesCtrl
    participant Singleton
    participant DB
    participant EmailService
    
    User->>System: Request password recovery
    System->>OperacionesCtrl: codigoactiva_Add(id, email)
    
    loop Retry up to 20 times
        OperacionesCtrl->>OperacionesCtrl: Generate 6-digit code
        OperacionesCtrl->>OperacionesCtrl: codigoactivaHelper_Add(id, code)
        OperacionesCtrl->>Singleton: Delete old codes for user
        Singleton->>DB: DELETE WHERE userselecto_id
        OperacionesCtrl->>Singleton: Insert new code
        Singleton->>DB: INSERT INTO codigoactiva
        
        alt Code unique
            OperacionesCtrl->>EmailService: Send code email
            EmailService-->>User: Email with 6-digit code
        else Code collision
            OperacionesCtrl->>OperacionesCtrl: Generate new code
        end
    end
    
    User->>System: Enter code
    System->>OperacionesCtrl: codigoactiva_Get(codActiva, key)
    OperacionesCtrl->>Singleton: SELECT code with md5(user_id)
    Singleton->>DB: Query codigoactiva table
    DB-->>Singleton: Code record
    
    alt Code valid and not expired
        Singleton-->>OperacionesCtrl: Code data
        OperacionesCtrl-->>System: ok: true
        System-->>User: Allow password reset
    else Code expired or used
        OperacionesCtrl-->>System: Exception with error
        System-->>User: Error message
    end
```

**Code Activation Flow Diagram**

The system generates unique 6-digit codes with automatic collision handling and 10-minute expiration. Codes are single-use and tied to specific users.

**Sources:** [src/ctrls/OperacionesCtrl.php:1452-1520](), [src/ctrls/OperacionesCtrl.php:1607-1643](), [src/ctrls/OperacionesCtrl.php:1666-1710]()

### Code Activation Methods

| Method | Purpose | Key Parameters |
|--------|---------|----------------|
| `codigoactiva_Add` | Generate and email activation code | `id`, `email`, `cdm` (manual code) |
| `codigoactivaHelper_Add` | Internal code storage helper | `id`, `cd` (code) |
| `codigoactiva_Get` | Validate code without using it | `codActiva`, `key` (md5 user ID) |
| `codigoactivaHelperJson64_Add` | Generate code from base64 employee data | `data` (base64 JSON) |
| `RecuperarByEmailAjax` | Full password recovery flow | `emailactivar` |
| `RecuAsignarClaveAjax` | Complete password reset with code | `codActiva`, `key`, `c` (new password) |

### Code Validation Rules

1. **Uniqueness:** Automatic retry mechanism up to 20 attempts to generate unique code
2. **Expiration:** Codes expire 10 minutes after creation
3. **Single Use:** `activo` field set to 1 after first use, preventing reuse
4. **User Binding:** Codes linked to user via `userselecto_id` with MD5 hash validation

**Sources:** [src/ctrls/OperacionesCtrl.php:1452-1710](), [src/ctrls/OperacionesCtrl.php:952-1035](), [src/ctrls/OperacionesCtrl.php:1062-1126]()

## File Operations

### File Upload System

The `SubirArchivo` method handles secure file uploads with validation:

**Supported Extensions:**
- Images: png, jpg, jpeg
- Documents: pdf, doc, docx, txt
- Spreadsheets: csv, xls, xlsx
- Fonts: ttf

**Upload Process:**

1. Validate `$_FILES` array contains expected field
2. Check for upload errors (size limits, etc.)
3. Extract and validate file extension
4. Create target directory if needed
5. Move uploaded file to destination

**Sources:** [src/ctrls/OperacionesCtrl.php:1800-1845]()

### Image Processing

```mermaid
graph TB
    HTML["HTML with base64 images"]
    PROCESS["processBase64Images()"]
    EXTRACT["Extract data URIs<br/>preg_match_all()"]
    DECODE["base64_decode()"]
    SAVE["Save to disk"]
    CHECK["Check dimensions"]
    RESIZE["redimensionImg2()"]
    REPLACE["replaceBase64ImagesInHtml()"]
    OUTPUT["HTML with file references"]
    
    HTML --> PROCESS
    PROCESS --> EXTRACT
    EXTRACT --> DECODE
    DECODE --> SAVE
    SAVE --> CHECK
    
    CHECK -->|width > maxwidth| RESIZE
    CHECK -->|width <= maxwidth| REPLACE
    RESIZE --> REPLACE
    REPLACE --> OUTPUT
```

**Image Processing Pipeline**

Images embedded as base64 in HTML are extracted, saved to disk, resized if necessary, and replaced with file references.

**Image Processing Methods:**

| Method | Purpose | Key Features |
|--------|---------|--------------|
| `processBase64Images` | Extract base64 images from HTML | Returns array of processed images with paths |
| `redimensionImg2` | Resize images maintaining aspect ratio | Supports JPEG, PNG, GIF; preserves transparency |
| `replaceBase64ImagesInHtml` | Replace base64 with file references | Updates HTML with `<img src="path">` tags |

**Resize Logic:**
- If only width provided: calculates height maintaining ratio
- If only height provided: calculates width maintaining ratio
- Creates true color image resource
- Preserves PNG alpha channel

**Sources:** [src/ctrls/OperacionesCtrl.php:2168-2202](), [src/ctrls/OperacionesCtrl.php:2072-2134](), [src/ctrls/OperacionesCtrl.php:2216-2223]()

### URL Masking

The `crearUrlMask` method provides secure file access through obfuscated URLs:

**Mask Types:**

| Constant | Base Path | Purpose |
|----------|-----------|---------|
| `IndexCtrl::MASK_FLD_REPO_ANEXOS` | `repo/anexos` | Attachment files |
| `IndexCtrl::MASK_FLD_REPO_PROCESOS` | `repo/proc/{year}` | Process documents |

**Masking Process:**

1. Map mask type to base directory path
2. Scan directory for folder matching MD5 hash of ID
3. Resolve masked ID to actual directory name
4. Construct full file path
5. Serve file with appropriate headers (e.g., `Content-Type: application/pdf`)

This prevents direct file system enumeration while allowing controlled access to stored documents.

**Sources:** [src/ctrls/OperacionesCtrl.php:889-927]()

## Utility Operations

### Directory Size Calculation

| Method | Purpose | Parameters |
|--------|---------|------------|
| `GetDirectorySize` | Calculate total size and file count | `d` (path), `ext` (optional filter) |
| `ObtenerTamanosCarpetas` | Get formatted sizes for specific endpoints | `ep` (endpoint constant) |

**Endpoint Constants:**
- `FLD_INFO_FTP_LBL`: "ftp" - galeria/prev directory
- `FLD_INFO_GLR_LBL`: "glr" - galeria directory (zip files)
- `FLD_INFO_REPO`: "repo" - repository directory

**Sources:** [src/ctrls/OperacionesCtrl.php:2310-2335](), [src/ctrls/OperacionesCtrl.php:2355-2376]()

### Cache Management

| Method | Purpose |
|--------|---------|
| `EliminarRecursivo` | Recursively delete files matching pattern |
| `CacheEliminarArchivos` | Clear cache for specific endpoints |

**Sources:** [src/ctrls/OperacionesCtrl.php:2235-2252](), [src/ctrls/OperacionesCtrl.php:2267-2296]()

### API Communication

The `CallAPI` method provides HTTP client functionality:

**Supported Methods:**
- **POST:** JSON-encoded or raw data in body
- **PUT:** Standard PUT request
- **GET:** Parameters in query string

**Configuration:** Accepts custom cURL options array for headers, timeout, etc.

**Sources:** [src/ctrls/OperacionesCtrl.php:2003-2048]()

## Static Data Arrays

`OperacionesCtrl` maintains several static arrays for localization and business data:

### Localization Arrays

```php
public static $GBL_DIAS = array(
    "monday" => "Lunes",
    "tuesday" => "Martes",
    "wednesday" => "Miércoles",
    // ... etc
);

public static $GBL_MESES = array(
    "january" => "enero",
    "february" => "febrero",
    // ... etc
);
```

### Colombian Health System Lists

**EPS (Health Providers):** 36 entries including Colsanitas, Compensar, Coomeva, Sanitas, etc.

**ARL (Occupational Risk Administrators):** 11 entries including major providers

Each list entry contains:
- `vl`: Value identifier
- `lbl`: Display label
- `sel`: Selection status

**Sources:** [src/ctrls/OperacionesCtrl.php:27-136]()

## Key Patterns and Practices

### Error Handling

`OperacionesCtrl` uses consistent error handling patterns:

1. **HTTP Status Codes:** Set via `http_response_code()` before throwing exceptions
2. **Error Constants:** Reference `IndexCtrl::ERR_COD_*` constants
3. **Descriptive Messages:** Include method name and context in exception messages
4. **Error Code Prefixing:** Format: `[ERROR_CODE] method: message`

**Example:**
```php
http_response_code(IndexCtrl::ERR_COD_ENVIO_MAIL_FALLIDO);
throw new Exception('[' . IndexCtrl::ERR_COD_ENVIO_MAIL_FALLIDO . ']enviarCustomEmail: ' . $e->getMessage());
```

### Database Interaction Pattern

Methods follow a consistent pattern for database operations:

1. Build query parameters
2. Call `Singleton::_readInfo()`, `_safeUpdate()`, `_safeInsert()`, etc.
3. Check result count or affected rows
4. Handle errors with appropriate HTTP status codes
5. Return structured array (often with `'ok'` key)

### Static Method Architecture

All methods in `OperacionesCtrl` are `public static`, allowing:
- Direct invocation without instantiation
- Stateless service layer
- Simple delegation from controllers
- Easy testability of individual operations

### Authentication Requirement Patterns

Some methods check for active sessions:
- `authRequ()`: Requires active user session (throws exception if missing)
- `authRequOff()`: Explicitly disables authentication requirement for specific operations

**Sources:** [src/ctrls/OperacionesCtrl.php:1-2700]()

## Integration with Other Components

### ApiboxLib Integration

`OperacionesCtrl` uses `ApiboxLib` for API token management:

```php
include_once dirname(...) . "libs" . DIRECTORY_SEPARATOR . "Apibox" . DIRECTORY_SEPARATOR . "ApiboxLib.php";

$existen = ApiboxLib::Obtener(array('id' => $idUsr));
$rP = ApiboxLib::Crear(array('id' => $idUsr, 'key' => $pkey));
$rP = ApiboxLib::Actualizar(array('id' => $idUsr, 'key' => $pkey));
$validation = ApiboxLib::Comparar(array('pkey' => $pkey));
```

**Sources:** [src/ctrls/OperacionesCtrl.php:676-687](), [src/ctrls/OperacionesCtrl.php:704-774](), [src/ctrls/OperacionesCtrl.php:806-816]()

### MagicPagesLib Integration

Used for temporary secure page generation (reference present but specific usage not visible in provided excerpt).

**Sources:** [src/ctrls/OperacionesCtrl.php:3]()

### Singleton Database Access

All database operations route through `Singleton` methods:

- `Singleton::_readInfo()`: SELECT queries
- `Singleton::_readInfoChar()`: Character-based SELECT
- `Singleton::_safeUpdate()`: Parameterized UPDATE
- `Singleton::_safeInsert()`: Parameterized INSERT
- `Singleton::_classicDelete()`: DELETE operations
- `Singleton::_classicInsertUniqQuery()`: INSERT with unique check

**Sources:** [src/ctrls/OperacionesCtrl.php:570-574](), [src/ctrls/OperacionesCtrl.php:1359-1378](), [src/ctrls/OperacionesCtrl.php:1617-1640]()

### Timezone Management

Nearly all methods that work with dates set timezone:
```php
date_default_timezone_set('America/Bogota');
```

This ensures consistent date/time handling across all operations.

**Sources:** [src/ctrls/OperacionesCtrl.php:252](), [src/ctrls/OperacionesCtrl.php:622](), [src/ctrls/OperacionesCtrl.php:675](), [src/ctrls/OperacionesCtrl.php:1667]()

---

This documentation covers the core operations and architectural patterns of `OperacionesCtrl`. For specific domain operations (employees, users, documents, workflows, packages, etc.), these follow similar patterns with dedicated methods prefixed by entity name (e.g., `empleados_*`, `usuarios_*`, `flujos_*`, `paquetes_*`). For authentication flows specific to the home interface, see [OperacionesHomeCtrl - Home Operations](#4.2).

---

---

## 4.2 OperacionesHomeCtrl - Home Operations

## Purpose and Scope

`OperacionesHomeCtrl` is a specialized business logic controller that handles operations specific to the public-facing home interface (`home.php` entry point). This class provides authentication, account activation, and document retrieval services for unauthenticated or externally authenticated users.

For core authenticated application operations, see [OperacionesCtrl - Core Operations](#4.1). For the public-facing controller that invokes these operations, see [HomeCtrl - Public Home Controller](#3.2). For authenticated REST API operations, see [Rest - REST API Handler](#3.3).

## Class Overview

`OperacionesHomeCtrl` is a static class located at [src/ctrls/OperacionesHomeCtrl.php:1-605](). It contains no instance state and all methods are declared as `public static`. The class serves as an intermediary between `HomeCtrl` and lower-level data operations, often delegating to `OperacionesCtrl` for shared functionality.

### Key Responsibilities

| Responsibility | Methods | Description |
|---|---|---|
| **Account Activation** | `activarCuenta`, `actviarSendMail` | Generate temporary codes, send activation emails, validate codes |
| **Authentication** | `LoginUsur`, `LoginLdapUsur`, `LoginFromExterno`, `LoginAsUsur`, `LoginUsurCod` | Multiple authentication pathways for different integration scenarios |
| **Document Retrieval** | `ListarPdfUrs` | Retrieve user-specific generated PDF documents across workflows |
| **Email Operations** | `ObtenerEtiquetasEmail`, `enviarCustomEmail` | Template-based email generation and sending |
| **Configuration** | `LeerConfigCorp` | Read corporate configuration settings |
| **Usability Tracking** | `Usabilidad_AgregarHome`, `ListarMisInsignias` | Log user interactions and retrieve achievement badges |

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:1-605]()

## Architecture Diagram

```mermaid
graph TB
    subgraph "Entry Point"
        HOME["home.php"]
    end
    
    subgraph "Controller Layer"
        HOMECTRL["HomeCtrl"]
    end
    
    subgraph "Business Logic - Home Operations"
        OPHOMECTRL["OperacionesHomeCtrl"]
        
        AUTH_GROUP["Authentication Methods"]
        ACTIV_GROUP["Activation Methods"]
        DOC_GROUP["Document Methods"]
        EMAIL_GROUP["Email Methods"]
        
        LOGIN_USUR["LoginUsur()"]
        LOGIN_LDAP["LoginLdapUsur()"]
        LOGIN_EXT["LoginFromExterno()"]
        LOGIN_AS["LoginAsUsur()"]
        LOGIN_COD["LoginUsurCod()"]
        
        ACTIVAR_CTA["activarCuenta()"]
        ACTIVAR_MAIL["actviarSendMail()"]
        
        LISTAR_PDF["ListarPdfUrs()"]
        LISTAR_INS["ListarMisInsignias()"]
        
        GET_ETIQ["ObtenerEtiquetasEmail()"]
        SEND_EMAIL["enviarCustomEmail()"]
    end
    
    subgraph "Business Logic - Core Operations"
        OPCTRL["OperacionesCtrl"]
        
        OP_EMAIL["enviarCustomEmail()"]
        OP_USAB["Usabilidad_agregar()"]
        OP_PDF["ListarPdfGenerados()"]
        OP_CORREO["ObtenerCorreoPrincipal()"]
        OP_EXT["ExtUsers_Obtener()"]
        OP_INSIG["ObtenerMisInsignias()"]
    end
    
    subgraph "Data Layer"
        SINGLETON["Singleton"]
        MODELS["Model Classes<br/>Codigoactiva<br/>Userselecto"]
    end
    
    subgraph "External Systems"
        LDAP["LDAP Directory"]
        SMTP["SMTP Server"]
        DB[(MySQL Database)]
    end
    
    HOME --> HOMECTRL
    HOMECTRL --> OPHOMECTRL
    
    OPHOMECTRL --> AUTH_GROUP
    OPHOMECTRL --> ACTIV_GROUP
    OPHOMECTRL --> DOC_GROUP
    OPHOMECTRL --> EMAIL_GROUP
    
    AUTH_GROUP --> LOGIN_USUR
    AUTH_GROUP --> LOGIN_LDAP
    AUTH_GROUP --> LOGIN_EXT
    AUTH_GROUP --> LOGIN_AS
    AUTH_GROUP --> LOGIN_COD
    
    ACTIV_GROUP --> ACTIVAR_CTA
    ACTIV_GROUP --> ACTIVAR_MAIL
    
    DOC_GROUP --> LISTAR_PDF
    DOC_GROUP --> LISTAR_INS
    
    EMAIL_GROUP --> GET_ETIQ
    EMAIL_GROUP --> SEND_EMAIL
    
    LOGIN_USUR --> OPCTRL
    LOGIN_LDAP --> LDAP
    LISTAR_PDF --> OPCTRL
    LISTAR_INS --> OPCTRL
    SEND_EMAIL --> OPCTRL
    
    OPCTRL --> OP_EMAIL
    OPCTRL --> OP_USAB
    OPCTRL --> OP_PDF
    OPCTRL --> OP_CORREO
    OPCTRL --> OP_EXT
    OPCTRL --> OP_INSIG
    
    ACTIVAR_CTA --> SINGLETON
    ACTIVAR_MAIL --> MODELS
    LOGIN_USUR --> SINGLETON
    LOGIN_AS --> SINGLETON
    
    SINGLETON --> DB
    MODELS --> DB
    OP_EMAIL --> SMTP
```

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:1-605](), [src/ctrls/HomeCtrl.php:1-201]()

## Authentication System

`OperacionesHomeCtrl` provides multiple authentication pathways to support various integration scenarios. Unlike the main application authentication in `OperacionesCtrl`, these methods are designed for public-facing access.

### Authentication Flow Diagram

```mermaid
sequenceDiagram
    participant User
    participant HomeCtrl
    participant OpHomeCtrl as OperacionesHomeCtrl
    participant OpCtrl as OperacionesCtrl
    participant Singleton
    participant LDAP
    participant DB as Database
    
    alt Code-Based Authentication
        User->>HomeCtrl: Enter email
        HomeCtrl->>OpHomeCtrl: LoginUsurCod(d)
        OpHomeCtrl->>Singleton: Find user by email
        Singleton->>DB: SELECT from userselecto
        DB-->>Singleton: User data
        Singleton-->>OpHomeCtrl: User record
        OpHomeCtrl->>OpHomeCtrl: actviarSendMail()
        OpHomeCtrl->>OpHomeCtrl: Generate temp code
        OpHomeCtrl->>OpCtrl: enviarCustomEmail()
        OpCtrl-->>User: Email with code
        OpHomeCtrl-->>HomeCtrl: Success response
        
        User->>HomeCtrl: Submit code
        HomeCtrl->>OpHomeCtrl: LoginUsur(u,c)
        OpHomeCtrl->>OpCtrl: ObtenerCorreoPrincipal()
        OpCtrl-->>OpHomeCtrl: Primary email
        OpHomeCtrl->>Singleton: Find user by email
        Singleton->>DB: SELECT with joins
        DB-->>Singleton: User with profile
        Singleton-->>OpHomeCtrl: User data
        OpHomeCtrl->>OpHomeCtrl: activarCuenta()
        OpHomeCtrl->>Singleton: Validate temp code
        Singleton->>DB: SELECT from codigoactiva
        DB-->>Singleton: Code record
        Singleton-->>OpHomeCtrl: Code validated
        OpHomeCtrl-->>HomeCtrl: User authenticated
    end
    
    alt LDAP Authentication
        User->>HomeCtrl: Enter credentials
        HomeCtrl->>OpHomeCtrl: LoginLdapUsur(u,c)
        OpHomeCtrl->>OpHomeCtrl: LeerConfigCorp()
        OpHomeCtrl->>LDAP: ldap_bind(username,password)
        LDAP-->>OpHomeCtrl: Bind success/failure
        alt Bind Failed
            OpHomeCtrl-->>HomeCtrl: Exception: Invalid credentials
        else Bind Success
            OpHomeCtrl->>LDAP: ldap_search(sAMAccountName)
            LDAP-->>OpHomeCtrl: User entries
            alt User found in LDAP but not in system
                OpHomeCtrl-->>HomeCtrl: Exception: Not in Evolusign
            else User exists
                OpHomeCtrl-->>HomeCtrl: Authentication success
            end
        end
    end
```

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:217-383]()

### Authentication Methods

#### LoginUsur - Primary Code-Based Authentication

`LoginUsur` [src/ctrls/OperacionesHomeCtrl.php:254-322]() is the primary authentication method for home users. It accepts an email and temporary activation code, validates the code, and returns user data.

**Key Features:**
- Resolves email aliases to primary email via `OperacionesCtrl::ObtenerCorreoPrincipal` [src/ctrls/OperacionesHomeCtrl.php:265-273]()
- Queries `userselecto` table with LEFT JOINs to `estadoselecto` and `perfilselecto` [src/ctrls/OperacionesHomeCtrl.php:275-282]()
- Falls back to `LoginUsrsExtra` for external user lookups [src/ctrls/OperacionesHomeCtrl.php:284-286]()
- Validates temporary "pase" token if provided (1-minute window) [src/ctrls/OperacionesHomeCtrl.php:296-308]()
- Calls `activarCuenta` to verify activation code [src/ctrls/OperacionesHomeCtrl.php:311-315]()
- Removes password from response for security [src/ctrls/OperacionesHomeCtrl.php:317]()

**Request Structure:**
```php
$d = array(
    "u" => "user@example.com",  // Email or alias
    "c" => "ACTIVATIONCODE123",  // Temporary activation code
    "pase" => "2024-01-15 10:30:00" // Optional: timestamp token
)
```

**Response Structure:**
```php
array(
    "ok" => array(
        "estado" => true,
        "datos" => array(
            "id" => 123,
            "identificacion" => "12345678",
            "nombres" => "Juan",
            "apellidos" => "Pérez",
            "mail" => "user@example.com",
            "tel" => "1234567890",
            "creado" => "2024-01-01 00:00:00",
            "estadoselecto_id" => 1,
            "estadoselecto" => "Activo",
            "perfilselecto_id" => 2,
            "perfilselecto" => "Usuario"
            // Note: "clave" field is removed
        )
    )
)
```

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:254-322]()

#### LoginLdapUsur - Corporate LDAP Authentication

`LoginLdapUsur` [src/ctrls/OperacionesHomeCtrl.php:335-384]() authenticates users against a corporate LDAP/Active Directory server.

**LDAP Connection Process:**
1. Reads LDAP configuration via `LeerConfigCorp()` [src/ctrls/OperacionesHomeCtrl.php:336]()
2. Extracts `ldapurl`, `ldapdmn`, `ldap_bse` configuration [src/ctrls/OperacionesHomeCtrl.php:338-340]()
3. Connects to LDAP server with `ldap_connect()` [src/ctrls/OperacionesHomeCtrl.php:342]()
4. Sets protocol version 3 and disables referrals [src/ctrls/OperacionesHomeCtrl.php:348-349]()
5. Attempts bind with `username@domain` format [src/ctrls/OperacionesHomeCtrl.php:346-351]()
6. On success, searches for user by `sAMAccountName` [src/ctrls/OperacionesHomeCtrl.php:354-357]()

**Error Conditions:**
- Bind failure: Throws "Invalid email address / password" [src/ctrls/OperacionesHomeCtrl.php:380-381]()
- User in LDAP but not in Evolusign: Throws "Existe en el sistema de la corporación pero no en Evolusign" [src/ctrls/OperacionesHomeCtrl.php:376]()

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:335-384]()

#### LoginUsurCod - Request Activation Code

`LoginUsurCod` [src/ctrls/OperacionesHomeCtrl.php:217-239]() is the first step in code-based authentication. It sends an activation email with a temporary code.

**Process:**
1. Validates email is not empty [src/ctrls/OperacionesHomeCtrl.php:218]()
2. Queries `userselecto` table for user by email [src/ctrls/OperacionesHomeCtrl.php:219-222]()
3. If user exists, calls `actviarSendMail` [src/ctrls/OperacionesHomeCtrl.php:227]()
4. Returns success status [src/ctrls/OperacionesHomeCtrl.php:228]()

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:217-239]()

#### LoginAsUsur - Simple User Lookup

`LoginAsUsur` [src/ctrls/OperacionesHomeCtrl.php:427-442]() performs a simple user lookup by email without authentication. Used for checking user existence.

**Query Details:**
- Selects from `userselecto` with LEFT JOINs to `estadoselecto` and `perfilselecto` [src/ctrls/OperacionesHomeCtrl.php:428-432]()
- Uses `LIKE` comparison (potential SQL injection risk if input not sanitized) [src/ctrls/OperacionesHomeCtrl.php:432]()

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:427-442]()

#### LoginFromExterno - External OAuth Integration

`LoginFromExterno` [src/ctrls/OperacionesHomeCtrl.php:394-416]() is designed for third-party authentication (Google, Facebook, Microsoft). The implementation is currently commented out, indicating incomplete or deprecated functionality.

**Intended Behavior (from comments):**
- Would update the `clave` field with current timestamp [src/ctrls/OperacionesHomeCtrl.php:397-414]()
- Timestamp used as temporary authentication token
- Returns affected row count

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:394-416]()

#### LoginUsrsExtra - Extended User Search

`LoginUsrsExtra` [src/ctrls/OperacionesHomeCtrl.php:197-208]() searches for users in the `extusers` table, which appears to store external email aliases.

**Query Structure:**
```sql
SELECT usel.id, usel.identificacion, usel.nombres, usel.clave, 
       usel.apellidos, usel.mail, usel.tel, usel.creado, 
       usel.estadoselecto_id, esel.nombre as estadoselecto, 
       usel.perfilselecto_id, peel.nombre as perfilselecto
FROM userselecto as usel
LEFT JOIN extusers as eu on eu.userselecto_id = usel.id
LEFT JOIN estadoselecto as esel on esel.id = usel.estadoselecto_id
LEFT JOIN perfilselecto as peel on peel.id = usel.perfilselecto_id
WHERE eu.mail like 'search@example.com'
```

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:197-208]()

## Account Activation System

The account activation system uses temporary codes stored in the `codigoactiva` table to verify user email ownership and enable account access.

### Activation Code Flow

```mermaid
sequenceDiagram
    participant User
    participant OpHomeCtrl as OperacionesHomeCtrl
    participant Utiles
    participant Codigoactiva as Codigoactiva Model
    participant Singleton
    participant DB as Database
    participant Email as Email System
    
    User->>OpHomeCtrl: actviarSendMail(email, user_data)
    OpHomeCtrl->>OpHomeCtrl: Validate email format
    
    alt Invalid Email
        OpHomeCtrl-->>User: Exception: Invalid email
    else Valid Email
        OpHomeCtrl->>Singleton: Check existing codes
        Singleton->>DB: SELECT from codigoactiva
        DB-->>Singleton: Previous codes (if any)
        
        loop Generate Unique Code (max 20 attempts)
            OpHomeCtrl->>Utiles: nuevoCl()
            Utiles-->>OpHomeCtrl: Random code string
            OpHomeCtrl->>Codigoactiva: Create new code record
            Codigoactiva->>Codigoactiva: setNombre(code)
            Codigoactiva->>Codigoactiva: setActivo(0)
            Codigoactiva->>Codigoactiva: setUserselecto_id(user_id)
            Codigoactiva->>Codigoactiva: setFecha(timestamp)
            Codigoactiva->>Codigoactiva: saveData()
            Codigoactiva->>DB: INSERT INTO codigoactiva
            
            alt Code Already Exists
                DB-->>Codigoactiva: Duplicate key error
                Codigoactiva-->>OpHomeCtrl: Error message
                Note over OpHomeCtrl: Retry with new code
            else Code Saved Successfully
                DB-->>Codigoactiva: Insert success
                Codigoactiva-->>OpHomeCtrl: Success
                Note over OpHomeCtrl: Exit loop
            end
        end
        
        OpHomeCtrl->>OpHomeCtrl: Load email template
        Note over OpHomeCtrl: nuevaclavehome.phtml
        OpHomeCtrl->>OpHomeCtrl: ObtenerEtiquetasEmail()
        OpHomeCtrl->>OpHomeCtrl: Replace template variables
        OpHomeCtrl->>Email: enviarCustomEmail()
        Email-->>User: Email with activation code
        OpHomeCtrl-->>User: MD5 hash of user ID
    end
```

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:111-185]()

### actviarSendMail - Send Activation Email

`actviarSendMail` [src/ctrls/OperacionesHomeCtrl.php:111-185]() generates a unique temporary code and emails it to the user.

**Implementation Details:**

| Step | Line Numbers | Description |
|---|---|---|
| **Email Validation** | [111-118]() | Checks email presence and format using `FILTER_VALIDATE_EMAIL` |
| **Existing Code Check** | [124]() | Queries for previous activation codes (result unused) |
| **Code Generation Loop** | [136-154]() | Attempts to create unique code up to 20 times |
| **Code Properties** | [137-140]() | Sets: `nombre` (code), `activo=0`, `userselecto_id`, `fecha` (timestamp) |
| **Template Loading** | [156]() | Loads `src/sistema/email/nuevaclavehome.phtml` |
| **Variable Replacement** | [157-165]() | Replaces `{$CLAVE_TMP}` and other tags in template |
| **Email Dispatch** | [169]() | Sends email with subject "Activador Evolusign" |
| **Return Value** | [175]() | Returns `md5($user_id)` on success |

**Code Generation:**
- Uses `Utiles::nuevoCl()` to generate random string [src/ctrls/OperacionesHomeCtrl.php:133]()
- Retries on duplicate key errors [src/ctrls/OperacionesHomeCtrl.php:143-149]()
- Maximum 20 retry attempts [src/ctrls/OperacionesHomeCtrl.php:152-153]()

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:111-185]()

### activarCuenta - Validate Activation Code

`activarCuenta` [src/ctrls/OperacionesHomeCtrl.php:37-68]() validates a temporary activation code before allowing login.

**Validation Logic:**

```mermaid
flowchart TD
    Start["activarCuenta(d)"] --> CheckCodeField{"Field 'c' exists?"}
    CheckCodeField -->|No| Error1["Throw: Campo codActiva inexistente"]
    CheckCodeField -->|Yes| CheckCodeLength{"strlen(code) > 0?"}
    CheckCodeLength -->|No| End["Return (unspecified)"]
    CheckCodeLength -->|Yes| QueryDB["Query: SELECT from codigoactiva<br/>WHERE nombre = code<br/>AND userselecto_id = user_id"]
    
    QueryDB --> CheckExists{"Code record exists?"}
    CheckExists -->|No| Error2["Throw: Código inexistente"]
    CheckExists -->|Yes| CalcExpiry["Calculate expiry:<br/>registered_date + 1 year"]
    
    CalcExpiry --> CheckExpiry{"Current time > expiry?"}
    CheckExpiry -->|Yes| Error3["Throw: Código inactivo por no usar<br/>en los últimos 10 minutos"]
    CheckExpiry -->|No| Success["Return true"]
    
    Error1 --> End
    Error2 --> End
    Error3 --> End
    Success --> End
```

**Expiration Window:**
- Code expires 1 year after creation [src/ctrls/OperacionesHomeCtrl.php:50]()
- Error message incorrectly states "10 minutos" instead of "1 año" [src/ctrls/OperacionesHomeCtrl.php:53]()
- Uses `strtotime('+1 year', ...)` for calculation [src/ctrls/OperacionesHomeCtrl.php:50]()

**Query Structure:**
```sql
SELECT * FROM codigoactiva 
WHERE nombre = 'ACTIVATION_CODE' 
AND userselecto_id = '123'
```

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:37-68]()

### Database Schema - codigoactiva Table

The `codigoactiva` table stores temporary activation codes with the following structure (inferred from code usage):

| Column | Type | Purpose |
|---|---|---|
| `id` | INT (PK) | Primary key |
| `nombre` | VARCHAR | The activation code string |
| `activo` | TINYINT | Status flag (0=inactive, 1=active) |
| `userselecto_id` | INT (FK) | Reference to user in `userselecto` table |
| `fecha` | DATETIME | Creation timestamp |

**Unique Constraint:** The `nombre` field appears to have a unique constraint, causing duplicate key errors during code generation [src/ctrls/OperacionesHomeCtrl.php:143-149]().

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:132-142]()

## Document Listing System

### ListarPdfUrs - User Document Retrieval

`ListarPdfUrs` [src/ctrls/OperacionesHomeCtrl.php:499-582]() retrieves all PDF documents generated for a user across all workflows they've participated in.

### Document Query Architecture

```mermaid
graph TB
    subgraph "Input Parameters"
        PARAM_DM["d['dm']<br/>User Email"]
        PARAM_ID["d['id']<br/>User ID"]
    end
    
    subgraph "Email Collection"
        PRIMARY["Primary Email<br/>from d['dm']"]
        EXTUSERS["Additional Emails<br/>from ExtUsers_Obtener()"]
        ALLEMAILS["allEmails Array<br/>All user emails"]
    end
    
    subgraph "Main Query - docsestados"
        SUBQUERY["Complex Subquery:<br/>Extract version/user/doc<br/>from file path"]
        DOCSE["docsestados table"]
        ADFL["adjuntosflujos table"]
        
        FILTER1["Filter: aceptado = 1"]
        FILTER2["Filter: not adfl.estadosflujos_id is null"]
        FILTER3["Filter: usr LIKE any email in allEmails"]
    end
    
    subgraph "Per-Document Processing"
        LOOP["Loop each document"]
        LISTPDF["OperacionesCtrl::<br/>ListarPdfGenerados(v, u)"]
        BUILD["Build response array:<br/>fl, vcry, v, fancy, u"]
    end
    
    subgraph "Usability Logging"
        USERQUERY["Query user name<br/>from userselecto"]
        USABLOG["OperacionesCtrl::<br/>Usabilidad_agregar()"]
        LOGEVENT["Event: WEB_USR_LGN_OK"]
    end
    
    PARAM_DM --> PRIMARY
    PARAM_ID --> EXTUSERS
    
    PRIMARY --> ALLEMAILS
    EXTUSERS --> ALLEMAILS
    
    ALLEMAILS --> FILTER3
    
    SUBQUERY --> DOCSE
    DOCSE --> ADFL
    FILTER1 --> ADFL
    FILTER2 --> ADFL
    FILTER3 --> ADFL
    
    ADFL --> LOOP
    LOOP --> LISTPDF
    LISTPDF --> BUILD
    
    PARAM_DM --> USERQUERY
    USERQUERY --> USABLOG
    USABLOG --> LOGEVENT
```

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:499-582]()

### Document Query Details

**Subquery Structure** [src/ctrls/OperacionesHomeCtrl.php:529]():
```sql
SELECT docse.id, docse.nombre, docse.aceptado, docse.usuarios_id, 
       docse.fecha, docse.flujos_id,
       SUBSTRING_INDEX(SUBSTRING_INDEX(docse.nombre,'/',-3),'/',1) as ver,
       SUBSTRING_INDEX(SUBSTRING_INDEX(docse.nombre,'/',-2),'/',1) as usr,
       SUBSTRING_INDEX(SUBSTRING_INDEX(docse.nombre,'/',-1),'/',1) as doc
FROM docsestados as docse
```

The subquery extracts path components from the `nombre` field:
- `ver`: Version/attachment ID (3rd from end)
- `usr`: User email (2nd from end)
- `doc`: Document filename (last component)

**Main Query** [src/ctrls/OperacionesHomeCtrl.php:532-535]():
```sql
SELECT docse.ver as adjuntosflujos_id, 
       docse.doc as url, 
       docse.flujos_id, 
       adfl.nombre as nicename, 
       docse.usr
FROM (subquery) as docse
LEFT JOIN adjuntosflujos as adfl on docse.ver = adfl.id
WHERE (docse.usr LIKE 'email1@example.com' 
    OR docse.usr LIKE 'email2@example.com' 
    OR ...)
  AND aceptado = 1 
  AND NOT adfl.estadosflujos_id IS NULL
ORDER BY flujos_id DESC
```

**Email Collection** [src/ctrls/OperacionesHomeCtrl.php:514-526]():
1. Start with primary email from `d['dm']` [src/ctrls/OperacionesHomeCtrl.php:515]()
2. Call `OperacionesCtrl::ExtUsers_Obtener` to get additional emails [src/ctrls/OperacionesHomeCtrl.php:517]()
3. Build `allEmails` array with all associated emails [src/ctrls/OperacionesHomeCtrl.php:520-522]()
4. Use array in dynamic WHERE clause with OR conditions [src/ctrls/OperacionesHomeCtrl.php:534]()

**Per-Document Processing** [src/ctrls/OperacionesHomeCtrl.php:543-560]():
- Loops through query results [src/ctrls/OperacionesHomeCtrl.php:543]()
- Filters out empty URLs [src/ctrls/OperacionesHomeCtrl.php:544]()
- Calls `OperacionesCtrl::ListarPdfGenerados` for each document [src/ctrls/OperacionesHomeCtrl.php:552-553]()
- Builds response array with metadata [src/ctrls/OperacionesHomeCtrl.php:554]()

**Response Structure:**
```php
array(
    "ok" => array(
        array(
            "fl" => array(...),          // PDF file list from ListarPdfGenerados
            "vcry" => "md5hash",         // MD5 of adjuntosflujos_id
            "v" => "123",                // adjuntosflujos_id
            "fancy" => "Document Name",  // Nice name from adjuntosflujos
            "u" => "user@example.com"    // User email
        ),
        // ... more documents
    ),
    "u_u" => array(
        array(
            "nombres" => "Juan",
            "apellidos" => "Pérez",
            "estadoselecto_id" => 1
        )
    )
)
```

**Usability Logging** [src/ctrls/OperacionesHomeCtrl.php:562-579]():
- Queries user's name from `userselecto` [src/ctrls/OperacionesHomeCtrl.php:563-566]()
- Logs event with reference ID `WEB_USR_LGN_OK` [src/ctrls/OperacionesHomeCtrl.php:568-574]()
- Error handling logs to error_log but doesn't throw [src/ctrls/OperacionesHomeCtrl.php:575-577]()

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:499-582]()

## Email System Integration

### Email Template System

`OperacionesHomeCtrl` uses a template-based email system with variable substitution for sending activation codes and notifications.

```mermaid
flowchart LR
    subgraph "Template Source"
        TPL["nuevaclavehome.phtml"]
        VARS["Template Variables:<br/>{$b}, {$u}, {$i}, {$f}<br/>{$CLAVE_TMP}"]
    end
    
    subgraph "Variable Generation"
        GET_ETIQ["ObtenerEtiquetasEmail()"]
        BASE["Base variables:<br/>b: baseUrl<br/>u: home.php<br/>i: index.php<br/>f: timestamp"]
        CUSTOM["Custom variables:<br/>CLAVE_TMP: code"]
        MERGE["Merge arrays"]
    end
    
    subgraph "Processing"
        REPLACE["preg_replace_callback<br/>Pattern: ~{$(.*?)}~si"]
        RENDERED["Rendered HTML"]
    end
    
    subgraph "Delivery"
        SEND["enviarCustomEmail()"]
        DELEGATE["OperacionesCtrl::<br/>enviarCustomEmail()"]
        PHPMAILER["PHPMailer SMTP"]
    end
    
    TPL --> REPLACE
    VARS --> GET_ETIQ
    
    GET_ETIQ --> BASE
    BASE --> MERGE
    CUSTOM --> MERGE
    MERGE --> REPLACE
    
    REPLACE --> RENDERED
    RENDERED --> SEND
    SEND --> DELEGATE
    DELEGATE --> PHPMAILER
```

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:13-99, 156-169]()

### ObtenerEtiquetasEmail - Generate Template Variables

`ObtenerEtiquetasEmail` [src/ctrls/OperacionesHomeCtrl.php:13-25]() creates an associative array of template variables for email generation.

**Default Variables:**

| Key | Value | Description |
|---|---|---|
| `b` | `Utiles::getBaseUrl()` | Base URL of application |
| `u` | `{baseUrl}home.php` | Home page URL |
| `i` | `{baseUrl}index.php` | Main application URL |
| `f` | `date("YmdHis")` | Current timestamp in YmdHis format |

**Usage Pattern:**
```php
$_aed = array('CLAVE_TMP' => $tmpCl);
$replacement_array = self::ObtenerEtiquetasEmail($_aed);
```

Custom variables in `$d` parameter are merged with defaults, overriding any conflicts [src/ctrls/OperacionesHomeCtrl.php:21-23]().

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:13-25]()

### Template Variable Replacement

**Regex Pattern** [src/ctrls/OperacionesHomeCtrl.php:160-165]():
```php
preg_replace_callback(
    '~\{\$(.*?)\}~si',  // Matches {$VARIABLE_NAME}
    function($match) use ($replacement_array) {
        return str_replace($match[0], 
            isset($replacement_array[$match[1]]) 
                ? $replacement_array[$match[1]] 
                : $match[0], 
            $match[0]);
    },
    $tplCode
);
```

- Pattern matches `{$VAR}` format (case-insensitive, dot-matches-newline)
- Replaces with value from `$replacement_array` or keeps original if not found
- Template loaded from `src/sistema/email/nuevaclavehome.phtml` [src/ctrls/OperacionesHomeCtrl.php:156]()

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:156-165]()

### enviarCustomEmail - Email Dispatch

`enviarCustomEmail` [src/ctrls/OperacionesHomeCtrl.php:79-99]() is a private method that delegates to `OperacionesCtrl::enviarCustomEmail`.

**Method Signature:**
```php
private static function enviarCustomEmail(
    $dest1,    // Recipient email(s)
    $titulo,   // Subject line
    $mensaje,  // Message body (HTML)
    $adjuntar = '' // Optional attachment path
)
```

**Implementation:**
- Contains commented-out legacy code using `Correo` class [src/ctrls/OperacionesHomeCtrl.php:81-96]()
- Currently delegates to `OperacionesCtrl::enviarCustomEmail` [src/ctrls/OperacionesHomeCtrl.php:98]()
- For full email implementation details, see [Email System (PHPMailer)](#8.3)

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:79-99]()

## Configuration Management

### LeerConfigCorp - Read Corporate Configuration

`LeerConfigCorp` [src/ctrls/OperacionesHomeCtrl.php:592-602]() reads system-wide configuration settings, particularly for LDAP authentication.

**Implementation:**
```php
public static function LeerConfigCorp(){
    $url_baseCtrls = dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . "ctrls" . DIRECTORY_SEPARATOR;
    include_once( $url_baseCtrls . "OperacionesCtrl.php" );
    
    $cfg = OperacionesCtrl::LeerConfigCorp();
    
    // Commented out: extract specific config values
    // $btn_login = ( isset( $cfg[ OperacionesCtrl::CFG_LOGIN_BTN_STY ]) ? $cfg[ OperacionesCtrl::CFG_LOGIN_BTN_STY ]["val"] : "btn-outline-light" );        
    // $o365_act = filter_var( isset( $cfg[ OperacionesCtrl::CFG_O365_ACT ]) ? $cfg[ OperacionesCtrl::CFG_O365_ACT ]["val"] : false , FILTER_VALIDATE_BOOLEAN);
    
    return array();
}
```

**Current Behavior:**
- Delegates to `OperacionesCtrl::LeerConfigCorp()` [src/ctrls/OperacionesHomeCtrl.php:596]()
- Returns empty array [src/ctrls/OperacionesHomeCtrl.php:601]()
- Commented code suggests intended configuration extraction [src/ctrls/OperacionesHomeCtrl.php:598-599]()

**Used By:**
- `LoginLdapUsur` to get LDAP connection parameters [src/ctrls/OperacionesHomeCtrl.php:336]()
- Configuration includes: `ldapurl`, `ldapdmn`, `ldap_bse` [src/ctrls/OperacionesHomeCtrl.php:338-340]()

For complete configuration management details, see [System Configuration (Corporation.php)](#6.1).

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:592-602]()

## Usability Tracking

### Usability_AgregarHome - Log User Actions

`Usability_AgregarHome` [src/ctrls/OperacionesHomeCtrl.php:451-460]() delegates usability event logging to `OperacionesCtrl`.

**Method Signature:**
```php
public static function Usability_AgregarHome( $d )
```

**Implementation:**
- Includes `OperacionesCtrl.php` [src/ctrls/OperacionesHomeCtrl.php:452-453]()
- Calls `OperacionesCtrl::Usabilidad_agregar($d)` [src/ctrls/OperacionesHomeCtrl.php:456]()
- Re-throws exceptions with original message [src/ctrls/OperacionesHomeCtrl.php:457-459]()

**Example Event** (from `ListarPdfUrs`):
```php
$_olg = array(
    "refid" => "WEB_USR_LGN_OK",
    "vl"=> "Ingreso exitoso front usuario",
    "usr" => "Juan Pérez"
);
OperacionesCtrl::Usabilidad_agregar( $_olg );
```

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:451-460, 568-577]()

### ListarMisInsignias - User Achievement Badges

`ListarMisInsignias` [src/ctrls/OperacionesHomeCtrl.php:469-478]() retrieves user achievement badges or insignias.

**Implementation:**
- Delegates to `OperacionesCtrl::ObtenerMisInsignias($d)` [src/ctrls/OperacionesHomeCtrl.php:474]()
- Wraps exceptions [src/ctrls/OperacionesHomeCtrl.php:475-477]()

For details on the insignia system, see [OperacionesCtrl - Core Operations](#4.1).

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:469-478]()

## Method Reference Table

| Method | Line Numbers | Purpose | Delegates To |
|---|---|---|---|
| `ObtenerEtiquetasEmail` | [13-25]() | Generate email template variables | - |
| `activarCuenta` | [37-68]() | Validate activation code and expiry | `Singleton::_readInfo` |
| `enviarCustomEmail` | [79-99]() | Send custom email | `OperacionesCtrl::enviarCustomEmail` |
| `actviarSendMail` | [111-185]() | Generate and email activation code | `Singleton`, `Codigoactiva`, `Utiles::nuevoCl` |
| `LoginUsrsExtra` | [197-208]() | Search users in extusers table | `Singleton::_readInfo` |
| `LoginUsurCod` | [217-239]() | Request activation code via email | `actviarSendMail` |
| `LoginUsur` | [254-322]() | Authenticate with activation code | `OperacionesCtrl::ObtenerCorreoPrincipal`, `Singleton::_readInfo`, `activarCuenta` |
| `LoginLdapUsur` | [335-384]() | Authenticate via LDAP | `LeerConfigCorp`, LDAP functions |
| `LoginFromExterno` | [394-416]() | OAuth authentication (inactive) | - |
| `LoginAsUsur` | [427-442]() | Simple user lookup by email | `Singleton::_readInfo` |
| `Usabilidad_AgregarHome` | [451-460]() | Log usability event | `OperacionesCtrl::Usabilidad_agregar` |
| `ListarMisInsignias` | [469-478]() | Get user achievement badges | `OperacionesCtrl::ObtenerMisInsignias` |
| `ListarPdfUrs` | [499-582]() | List user's PDF documents | `OperacionesCtrl::ExtUsers_Obtener`, `OperacionesCtrl::ListarPdfGenerados`, `OperacionesCtrl::Usabilidad_agregar` |
| `LeerConfigCorp` | [592-602]() | Read corporate configuration | `OperacionesCtrl::LeerConfigCorp` |

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:1-605]()

## Integration with HomeCtrl

`HomeCtrl` invokes `OperacionesHomeCtrl` in its constructor for external authentication:

```php
if( isset( $_POST["ajax"] ) ){
    if( $_POST["ajax"] == md5( "Api/IntegraAutentica" ) ){
        try{
            $ok = OperacionesHomeCtrl::LoginFromExterno( $_POST );
            echo json_encode($ok);
        }catch (Exception $ex){
            $er = array("err" => $ex->getMessage());
            echo json_encode($er);
        }
        die("");
    }
}
```

**AJAX Endpoint Detection:**
- Checks for `$_POST["ajax"]` parameter [src/ctrls/HomeCtrl.php:73]()
- Compares to `md5("Api/IntegraAutentica")` [src/ctrls/HomeCtrl.php:74]()
- Calls `LoginFromExterno` on match [src/ctrls/HomeCtrl.php:76]()
- Returns JSON response and terminates [src/ctrls/HomeCtrl.php:77-82]()

**Sources:** [src/ctrls/HomeCtrl.php:71-85]()

## Security Considerations

### SQL Injection Risks

Several methods use string concatenation for SQL queries with potential injection vulnerabilities:

| Method | Line | Risk | Query Fragment |
|---|---|---|---|
| `activarCuenta` | [45]() | High | `where nombre = '" . $caa . "'` |
| `LoginUsrsExtra` | [203]() | High | `WHERE eu.mail like '" . $d['u'] . "'` |
| `LoginUsurCod` | [221]() | High | `where mail like '" . trim($d["u"]) . "'` |
| `LoginUsur` | [280]() | High | `where mail like '" . trim($dtllave) . "'` |
| `LoginAsUsur` | [432]() | High | `where mail like '" . $d["u"] . "'` |
| `ListarPdfUrs` | [534]() | High | Dynamic `LIKE` conditions from array |

**Recommendation:** Migrate all queries to use `Singleton::_safeSelect` with prepared statements. See [Singleton - Database Connection Manager](#5.1).

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:45, 203, 221, 280, 432, 534]()

### Authentication Token Issues

**Activation Code Expiry Mismatch:**
- Code expires after 1 year [src/ctrls/OperacionesHomeCtrl.php:50]()
- Error message incorrectly states "10 minutos" [src/ctrls/OperacionesHomeCtrl.php:53]()
- Inconsistency may confuse users

**Pase Token Validation:**
- 1-minute validation window is very short [src/ctrls/OperacionesHomeCtrl.php:297]()
- Vulnerable to clock skew between servers
- IP logging on failure [src/ctrls/OperacionesHomeCtrl.php:305]() but doesn't block

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:50, 53, 297, 305]()

### LDAP Security

**Password Handling:**
- Password passed to `ldap_bind` in plaintext [src/ctrls/OperacionesHomeCtrl.php:351]()
- Appropriate for LDAP protocol but ensure LDAPS (LDAP over TLS) is used
- No configuration indicates TLS enforcement

**Error Suppression:**
- `@ldap_bind` suppresses errors [src/ctrls/OperacionesHomeCtrl.php:351]()
- `@ldap_sort` suppresses errors [src/ctrls/OperacionesHomeCtrl.php:356]()
- Makes debugging authentication issues difficult

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:351, 356]()

### Incomplete Implementation

**LoginFromExterno:**
- Entire method body is commented out [src/ctrls/OperacionesHomeCtrl.php:396-415]()
- Still called from `HomeCtrl` [src/ctrls/HomeCtrl.php:76]()
- Will return `null`, causing JSON encoding of null value
- OAuth integration incomplete or deprecated

**LeerConfigCorp:**
- Returns empty array instead of configuration [src/ctrls/OperacionesHomeCtrl.php:601]()
- Commented code suggests intended behavior [src/ctrls/OperacionesHomeCtrl.php:598-599]()
- `LoginLdapUsur` expects configuration values that aren't returned

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:394-416, 592-602]()

---

---

## 5. Data Layer

## Purpose and Scope

The Data Layer provides database connectivity, query execution, and ORM (Object-Relational Mapping) capabilities for the GESFINANCIERO system. This layer abstracts direct database interaction through three primary components: the `Singleton` connection manager, the `Clsdatos` base ORM class, and dynamically loaded model classes.

For information about how controllers and business logic interact with this layer, see [Business Logic Layer](#4). For details on specific model implementations, see [Data Models](#5.3). For database configuration constants, see [System Configuration](#6.1).

---

## Architecture Overview

The Data Layer follows a three-tier pattern with the `Singleton` class managing connections, `Clsdatos` providing ORM functionality, and model classes representing database tables.

```mermaid
graph TB
    subgraph "Application Layer"
        CTRL["Controllers<br/>(IndexCtrl, OperacionesCtrl)"]
    end
    
    subgraph "ORM Abstraction"
        CLSDATOS["Clsdatos<br/>src/datos/Clsdatos.php"]
        
        CLSDATOS_READ["readInfo()<br/>readInfoById()"]
        CLSDATOS_WRITE["saveData()<br/>updateData()"]
        CLSDATOS_DELETE["deleteById()<br/>deleteByField()"]
    end
    
    subgraph "Connection Management"
        SINGLETON["Singleton<br/>src/datos/Singleton.php"]
        
        SINGLETON_CLASSIC["_classicRead()<br/>_classicUpdate()<br/>_classicInsert()<br/>_classicDelete()"]
        SINGLETON_SAFE["_safeSelect()<br/>_safeUpdate()<br/>_safeInsert()<br/>_safeDelete()<br/>_safeRawQuery()"]
        SINGLETON_META["_metaDatos()<br/>_metaDatosPlus()"]
        SINGLETON_UTIL["_dataTable()<br/>_modelos()"]
    end
    
    subgraph "Model Classes"
        MODELS["Model Classes<br/>src/modelo/*<br/>(extend Clsdatos)"]
    end
    
    subgraph "Database"
        DB[("MySQL<br/>nuevapp_apps")]
    end
    
    subgraph "Configuration"
        CORP["Corporation.php<br/>repo/corp/"]
    end
    
    CTRL --> CLSDATOS
    CTRL --> SINGLETON
    CTRL --> MODELS
    
    MODELS --> CLSDATOS
    
    CLSDATOS --> CLSDATOS_READ
    CLSDATOS --> CLSDATOS_WRITE
    CLSDATOS --> CLSDATOS_DELETE
    
    CLSDATOS_READ --> SINGLETON
    CLSDATOS_WRITE --> SINGLETON
    CLSDATOS_DELETE --> SINGLETON
    
    SINGLETON --> SINGLETON_CLASSIC
    SINGLETON --> SINGLETON_SAFE
    SINGLETON --> SINGLETON_META
    SINGLETON --> SINGLETON_UTIL
    
    SINGLETON_CLASSIC --> DB
    SINGLETON_SAFE --> DB
    SINGLETON_META --> DB
    
    SINGLETON -.->|reads credentials| CORP
```

**Sources:** [src/datos/Singleton.php:1-845](), [src/datos/Clsdatos.php:1-425]()

---

## Connection Management: Singleton Class

The `Singleton` class ([src/datos/Singleton.php]()) implements the Singleton pattern to manage a single MySQL database connection throughout the application lifecycle. It provides two query paradigms: legacy "classic" methods and modern "safe" prepared statement methods.

### Connection Initialization

The constructor establishes a single `mysqli` connection stored in the static property `$lnk`:

```mermaid
sequenceDiagram
    participant App as "Application Code"
    participant Singleton as "Singleton Class"
    participant Corp as "Corporation.php"
    participant MySQL as "MySQL Database"
    
    App->>Singleton: new Singleton()
    
    alt self::$lnk not initialized
        Singleton->>Corp: Load Corporation.php
        Singleton->>Corp: Read HOST, DBUSER, DBPASS, DBNAME
        Singleton->>MySQL: new mysqli(credentials)
        
        alt Connection success
            MySQL-->>Singleton: Connection established
            Singleton->>Singleton: Store in self::$lnk
            Singleton-->>App: Return mysqli instance
        else Connection failure
            MySQL-->>Singleton: connect_errno
            Singleton->>Singleton: Echo error message
        end
    else self::$lnk already exists
        Singleton-->>App: Return existing self::$lnk
    end
```

The constructor accepts optional connection parameters but defaults to values from `Corporation` constants ([src/datos/Singleton.php:24-42]()):

| Parameter | Default Source | Purpose |
|-----------|---------------|---------|
| `$host` | `Corporation::HOST` | Database server hostname |
| `$db` | `Corporation::DBNAME` | Database name |
| `$uname` | `Corporation::DBUSER` | Database username |
| `$pass` | `Corporation::DBPASS` | Database password |

**Sources:** [src/datos/Singleton.php:24-42]()

### Classic Query Methods (Legacy)

These methods construct SQL strings directly without parameter binding, posing SQL injection risks. They are maintained for backward compatibility:

| Method | Purpose | SQL Pattern |
|--------|---------|-------------|
| `_classicReadInfo($tb, $ver, $extra)` | SELECT query | `SELECT $ver FROM $tb $extra` |
| `_classicUpdate($tb, $set, $extra)` | UPDATE statement | `UPDATE $tb SET $set $extra` |
| `_classicInsertUniqQuery($tb, $vls, $fld)` | Single INSERT | `INSERT INTO $tb $fld VALUES $vls` |
| `_classicInsertMultiQuery($tb, $vls, $fld)` | Multi-row INSERT | `INSERT INTO $tb $fld $vls` |
| `_classicDelete($tb, $extra)` | DELETE statement | `DELETE FROM $tb $extra` |

**Example usage pattern** ([src/datos/Singleton.php:314-326]()):
```php
$rows = Singleton::_classicReadInfo("userselecto", "*", "WHERE activo = 1");
```

**Security Warning:** These methods do not sanitize inputs and should be migrated to safe methods.

**Sources:** [src/datos/Singleton.php:263-378]()

### Safe Query Methods (Prepared Statements)

Modern methods using prepared statements with parameter binding to prevent SQL injection:

| Method | Purpose | Parameters |
|--------|---------|------------|
| `_safeSelect($table, $fields, $where, $params)` | SELECT with binding | Table name, field list, WHERE clause, bound values |
| `_safeUpdate($table, $data, $where, $params)` | UPDATE with binding | Table name, column=>value array, WHERE clause, bound values |
| `_safeInsert($table, $data)` | INSERT with binding | Table name, column=>value array |
| `_safeDelete($table, $where, $params)` | DELETE with binding | Table name, WHERE clause, bound values |
| `_safeRawQuery($sql, $params)` | Raw SQL with binding | Full SQL string, bound values |

**Example implementation** ([src/datos/Singleton.php:786-805]()):
```php
// Secure SELECT with parameter binding
$rows = Singleton::_safeSelect('userselecto', '*', 'id = ? AND activo = ?', [123, 1]);

// Secure UPDATE with parameter binding  
$data = ['nombre' => 'John', 'email' => 'john@example.com'];
Singleton::_safeUpdate('userselecto', $data, 'id = ?', [123]);
```

All parameters are bound as strings (`str_repeat('s', count($params))`) for simplicity ([src/datos/Singleton.php:713-714]()).

**Sources:** [src/datos/Singleton.php:686-843]()

### Metadata Inspection Methods

The `Singleton` class provides methods to introspect database schema information:

#### _metaDatos($tb)

Returns column names as an associative array ([src/datos/Singleton.php:70-89]()):

```php
$columns = Singleton::_metaDatos('userselecto');
// Returns: ['id' => 'id', 'nombre' => 'nombre', 'email' => 'email', ...]
```

#### _metaDatosPlus($tb)

Returns detailed metadata including type information ([src/datos/Singleton.php:116-148]()):

```php
$metadata = Singleton::_metaDatosPlus('userselecto');
/* Returns:
[
    'id' => ['nombre' => 'id', 'tipoid' => 3, 'tipo' => 'int', 'largo' => 11],
    'nombre' => ['nombre' => 'nombre', 'tipoid' => 253, 'tipo' => 'varchar', 'largo' => 255],
    'fecha_registro' => ['nombre' => 'fecha_registro', 'tipoid' => 12, 'tipo' => 'datetime', 'largo' => 19]
]
*/
```

Type mapping constants ([src/datos/Singleton.php:91-99]()):

| MySQL Type ID | Constant | Mapped Type |
|---------------|----------|-------------|
| 1 | `SQLTP_TINYINT` | tinyint |
| 3 | `SQLTP_INT` | int |
| 8 | `SQLTP_BIGINT` | bigint |
| 10 | `SQLTP_DATE` | date |
| 12 | `SQLTP_DATETIME` | datetime |
| 245 | `SQLTP_JSON` | json |
| 246 | `SQLTP_DECIMAL` | decimal |
| 252 | `SQLTP_TEXT` | text |
| 253 | `SQLTP_VARCHAR` | varchar |

**Sources:** [src/datos/Singleton.php:70-148]()

### DataTables Integration

The `_dataTable($data)` method generates DataTables-compatible JSON responses ([src/datos/Singleton.php:526-592]()):

```php
$config = ['tb' => 'userselecto'];
$tableData = Singleton::_dataTable($config);
// Returns formatted data structure for DataTables jQuery plugin
```

The method:
1. Inspects table structure using `_metaDatosPlus()`
2. Builds column definitions with formatters for dates and decimals
3. Integrates with SSP (Server-Side Processing) class
4. Supports optional character encoding parameters

**Sources:** [src/datos/Singleton.php:526-592]()

### Code Generation Utilities

The `_modelos($jsMenu)` method generates boilerplate PHP model classes and HTML form templates from database tables ([src/datos/Singleton.php:390-491]()):

```mermaid
graph LR
    DB["Database<br/>INFORMATION_SCHEMA"] --> MODELOS["_modelos()"]
    MODELOS --> PHPFILES["tmpmodelo/<br/>ModelClass.php"]
    MODELOS --> HTMLFILES["tmpvistas/<br/>ModelClass.phtml"]
    MODELOS --> JSMENU["JavaScript<br/>menu entries"]
    
    METADATOS["_metaDatos()"] --> MODELOS
```

Generated model class structure:
- Private properties for each column
- Getter/setter methods for all fields
- Extends `Clsdatos` base class
- Generated form with input fields matching schema

**Sources:** [src/datos/Singleton.php:390-514]()

---

## ORM Layer: Clsdatos Class

The `Clsdatos` class ([src/datos/Clsdatos.php]()) extends `Singleton` and provides Active Record-style ORM functionality. Models extend this class to inherit CRUD operations.

### CRUD Operations Overview

```mermaid
graph TB
    subgraph "Clsdatos CRUD Methods"
        CREATE["saveData()<br/>Creates new record<br/>Returns: insert_id"]
        READ_ONE["readInfoById()<br/>Fetches single record by ID<br/>Returns: Object instance"]
        READ_MANY["readInfo(ver, extra)<br/>Fetches multiple records<br/>Returns: Array of objects"]
        UPDATE["updateData()<br/>Updates existing record by ID<br/>Returns: affected_rows"]
        DELETE_ID["deleteById()<br/>Deletes record by ID<br/>Returns: affected_rows"]
        DELETE_FIELD["deleteByField(campo, valor)<br/>Deletes by field value<br/>Returns: affected_rows"]
    end
    
    CREATE --> PREPARE_INSERT["Prepare INSERT with placeholders"]
    READ_ONE --> PREPARE_SELECT_ID["Prepare SELECT WHERE id = ?"]
    READ_MANY --> PREPARE_SELECT_ALL["Prepare SELECT with filters"]
    UPDATE --> PREPARE_UPDATE["Prepare UPDATE SET ... WHERE id = ?"]
    DELETE_ID --> PREPARE_DELETE_ID["Prepare DELETE WHERE id = ?"]
    DELETE_FIELD --> PREPARE_DELETE_FIELD["Prepare DELETE WHERE campo = ?"]
    
    PREPARE_INSERT --> BIND_PARAMS["bind_param() with 's' types"]
    PREPARE_SELECT_ID --> BIND_PARAMS
    PREPARE_SELECT_ALL --> BIND_PARAMS
    PREPARE_UPDATE --> BIND_PARAMS
    PREPARE_DELETE_ID --> BIND_PARAMS
    PREPARE_DELETE_FIELD --> BIND_PARAMS
    
    BIND_PARAMS --> EXECUTE["execute()"]
```

**Sources:** [src/datos/Clsdatos.php:34-423]()

### Read Operations

#### readInfoById()

Fetches a single record by ID and returns a populated object instance ([src/datos/Clsdatos.php:88-138]()):

```php
$user = new userselecto();
$user->setId(123);
$loadedUser = $user->readInfoById();
// Returns userselecto object with all fields populated
```

The method:
1. Searches for a `getId()` method using reflection
2. Constructs `SELECT * FROM tablename WHERE id = ?`
3. Uses metadata to bind result columns to object properties
4. Returns populated object instance

#### readInfo($ver, $extra)

Fetches multiple records with custom SELECT fields and WHERE clauses ([src/datos/Clsdatos.php:146-200]()):

```php
$user = new userselecto();
$users = $user->readInfo("id, nombre, email", "WHERE activo = 1 ORDER BY nombre");
// Returns array of userselecto objects
```

Parameters:
- `$ver`: Column list or aggregate functions (e.g., `"id, COUNT(*)"`)
- `$extra`: SQL clauses after FROM (WHERE, ORDER BY, LIMIT, etc.)

**Fallback mechanism:** If prepared statement returns no results, the method falls back to direct query execution ([src/datos/Clsdatos.php:180-189]()).

**Sources:** [src/datos/Clsdatos.php:88-200]()

### Write Operations

#### saveData()

Inserts a new record using all non-ID properties ([src/datos/Clsdatos.php:272-333]()):

```mermaid
sequenceDiagram
    participant Model as "Model Instance"
    participant saveData as "saveData()"
    participant Metadata as "Metadata Query"
    participant Insert as "INSERT Statement"
    
    Model->>saveData: Call saveData()
    saveData->>Metadata: SELECT * LIMIT 1
    Metadata-->>saveData: Column names
    
    loop For each column (except id)
        saveData->>Model: Call get{ColumnName}()
        Model-->>saveData: Return value
    end
    
    saveData->>saveData: Build placeholders array
    saveData->>Insert: Prepare INSERT statement
    saveData->>Insert: bind_param with 's' types
    saveData->>Insert: execute()
    Insert-->>saveData: insert_id
    saveData-->>Model: Return new ID
```

Example usage:
```php
$user = new userselecto();
$user->setNombre("John Doe");
$user->setEmail("john@example.com");
$newId = $user->saveData(); // Returns ID of inserted record
```

**Sources:** [src/datos/Clsdatos.php:272-333]()

#### updateData()

Updates an existing record identified by its ID ([src/datos/Clsdatos.php:339-423]()):

```php
$user = new userselecto();
$user->setId(123);
$user->setNombre("Jane Doe");
$user->setEmail("jane@example.com");
$affectedRows = $user->updateData(); // Returns number of rows updated
```

Key behavior:
- Only updates fields with non-empty values ([src/datos/Clsdatos.php:365-368]())
- Validates ID is numeric ([src/datos/Clsdatos.php:350-352]())
- Constructs `UPDATE table SET field1=?, field2=? WHERE id = ?`
- Binds all values as strings except the final ID parameter as integer

**Sources:** [src/datos/Clsdatos.php:339-423]()

#### saveDataFromPost($entidades)

Processes POST data arrays to batch-save multiple records ([src/datos/Clsdatos.php:208-266]()):

```php
// POST data: $_POST['nombre'] = ['John', 'Jane']
//            $_POST['email'] = ['john@ex.com', 'jane@ex.com']
$user = new userselecto();
$ids = $user->saveDataFromPost(true); // Returns array of saved IDs
```

Parameters:
- `$entidades`: If true, applies `htmlentities()` to all values for XSS protection

The method:
1. Determines array length from first POST field
2. Iterates through array indices
3. Creates object instance per row
4. Calls `updateData()` if ID exists, otherwise `saveData()`
5. Returns array of successfully saved IDs

**Sources:** [src/datos/Clsdatos.php:208-266]()

### Delete Operations

#### deleteById()

Deletes record using the object's ID property ([src/datos/Clsdatos.php:34-61]()):

```php
$user = new userselecto();
$user->setId(123);
$deletedCount = $user->deleteById(); // Returns affected_rows
```

Constructs: `DELETE FROM tablename WHERE id = ?`

#### deleteByField($campo, $valor)

Deletes records matching a specific field value ([src/datos/Clsdatos.php:67-82]()):

```php
$user = new userselecto();
$deletedCount = $user->deleteByField('email', 'john@example.com');
```

Constructs: `DELETE FROM tablename WHERE $campo = ?`

**Note:** Both methods bind the value as integer type (`'i'`), which may cause issues with non-numeric values.

**Sources:** [src/datos/Clsdatos.php:34-82]()

### Dynamic Method Calling

The `Clsdatos` class relies on PHP's magic methods and reflection to dynamically invoke getters and setters. All CRUD operations use this pattern:

```php
// Dynamic getter invocation
$value = $this->{"get" . Singleton::toCap($fieldName)}();

// Dynamic setter invocation  
$this->{"set" . Singleton::toCap($fieldName)}($value);
```

The `toCap()` utility capitalizes the first letter ([src/datos/Singleton.php:512-514]()):
```php
public static function toCap($str) {
    return strtoupper(substr($str, 0, 1)) . substr($str, 1, strlen($str));
}
```

**Sources:** [src/datos/Clsdatos.php:120](), [src/datos/Clsdatos.php:173](), [src/datos/Clsdatos.php:236](), [src/datos/Singleton.php:512-514]()

### Error Handling

The class maintains an internal error message property accessible through:

- `obtenerError()`: Returns last MySQL error message ([src/datos/Clsdatos.php:18-20]())
- `limpiarError()`: Clears the error message ([src/datos/Clsdatos.php:26-28]())

Errors are captured from `self::$lnk->error` when operations fail:

```php
if (!$stmt = self::$lnk->prepare($query)) {
    $this->mensaje_error = self::$lnk->error;
    return -1;
}
```

**Sources:** [src/datos/Clsdatos.php:11-28]()

---

## Model Layer Integration

Models in `src/modelo/` extend `Clsdatos` to inherit ORM functionality. Each model represents a database table following a naming convention:

### Naming Convention

| Database Table | Model Class | File Location |
|----------------|-------------|---------------|
| `userselecto` | `Userselecto` | `src/modelo/userselecto.php` |
| `perfilselecto` | `Perfilselecto` | `src/modelo/perfilselecto.php` |
| `apibox` | `Apibox` | `src/modelo/apibox.php` |
| `codigoactiva` | `Codigoactiva` | `src/modelo/codigoactiva.php` |
| `magicpages` | `Magicpages` | `src/modelo/magicpages.php` |

The class name is derived by capitalizing the first letter of the table name (see `toCap()` function).

### Model Structure Pattern

Generated models follow this structure:

```php
class Userselecto extends Clsdatos {
    private $id = 0;
    private $nombre = "";
    private $email = "";
    
    public function getId() { return $this->id; }
    public function setId($vl) { $this->id = $vl; }
    
    public function getNombre() { return $this->nombre; }
    public function setNombre($vl) { $this->nombre = $vl; }
    
    // ... more getters/setters
}
```

### Dynamic Model Loading

Entry points load all models dynamically ([index.php]() and [home.php]()):

```php
// Load all model files from src/modelo/
$actualPath = dirname(__FILE__);
$modelDir = $actualPath . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "modelo";
foreach (glob($modelDir . DIRECTORY_SEPARATOR . "*.php") as $filename) {
    include_once $filename;
}
```

This convention-over-configuration approach allows new models to be added without modifying bootstrap code.

**Sources:** Referenced from high-level architecture diagrams

---

## Query Method Comparison

The following table contrasts legacy classic methods with modern safe methods:

| Feature | Classic Methods | Safe Methods |
|---------|----------------|--------------|
| **SQL Injection Protection** | ❌ None - direct string concatenation | ✅ Prepared statements with parameter binding |
| **Parameter Binding** | ❌ Manual string escaping required | ✅ Automatic via `bind_param()` |
| **Type Safety** | ❌ No type validation | ✅ Type hints (all as strings 's') |
| **Method Prefix** | `_classic*` | `_safe*` |
| **Error Handling** | ✅ Throws exceptions | ✅ Throws exceptions |
| **Return Values** | Boolean or array | Boolean, array, or throws |
| **Use Case** | ⚠️ Legacy code only - migrate away | ✅ All new development |
| **Examples** | `_classicReadInfo()`, `_classicUpdate()` | `_safeSelect()`, `_safeUpdate()` |

### Migration Path

To migrate from classic to safe methods:

**Before (Vulnerable):**
```php
$extra = "WHERE email = '" . $_POST['email'] . "'"; // SQL injection risk
$users = Singleton::_classicReadInfo('userselecto', '*', $extra);
```

**After (Secure):**
```php
$users = Singleton::_safeSelect('userselecto', '*', 'email = ?', [$_POST['email']]);
```

**Sources:** [src/datos/Singleton.php:263-378](), [src/datos/Singleton.php:686-843]()

---

## Advanced Usage Patterns

### Character Encoding Control

The `_readInfoChar()` method allows explicit character set conversion ([src/datos/Singleton.php:205-253]()):

```php
// Convert from Latin-1 to UTF-8
$rows = Singleton::_readInfoChar(
    'userselecto', 
    '*', 
    'WHERE activo = 1',
    'utf8',      // Target encoding
    'latin1'     // Source encoding
);
```

### Custom State Reading

The `_readEstado()` method provides a standardized pattern for reading lookup tables ([src/datos/Singleton.php:626-684]()):

```php
$config = [
    'tabla' => 'estadoselecto',
    'id' => 5,
    'ordenasc' => 2,
    'limite' => 10
];
$estados = Singleton::_readEstado($config);
```

Supports:
- Filtering by ID
- Ascending/descending order
- Result limits
- Debug mode (outputs SQL without execution)

**Sources:** [src/datos/Singleton.php:205-253](), [src/datos/Singleton.php:626-684]()

### Utility Methods

#### _arrayToTableReference()

Converts object arrays to associative lookup tables ([src/datos/Singleton.php:52-58]()):

```php
$users = $userModel->readInfo();
$lookup = Singleton::_arrayToTableReference($users, 'getId', 'getNombre');
// Returns: [1 => 'John Doe', 2 => 'Jane Smith', ...]
```

**Sources:** [src/datos/Singleton.php:52-58]()

---

## Technical Considerations

### Security Issues

1. **Classic Methods**: All `_classic*` methods construct SQL via string concatenation, creating SQL injection vulnerabilities. These should be considered deprecated ([src/datos/Singleton.php:263-378]()).

2. **Type Binding**: Safe methods bind all parameters as strings (`'s'`), which works but lacks type precision ([src/datos/Singleton.php:713-714]()).

3. **Error Exposure**: Connection errors echo directly to output ([src/datos/Singleton.php:35-36]()), potentially revealing sensitive information.

### Performance Characteristics

1. **Single Connection**: The Singleton pattern ensures only one database connection exists, avoiding connection overhead but limiting concurrent query execution.

2. **No Connection Pooling**: Each request creates a new connection. No connection pooling mechanism is implemented.

3. **Metadata Caching**: Metadata methods query schema on every call. No caching mechanism exists ([src/datos/Singleton.php:70-148]()).

4. **Fallback Query**: `readInfo()` executes queries twice if the first attempt returns empty results ([src/datos/Clsdatos.php:180-189]()).

### Limitations

1. **No Transaction Support**: No exposed methods for BEGIN, COMMIT, or ROLLBACK operations.

2. **Table Name Convention**: Class names must match table names (case-insensitive) for ORM to work ([src/datos/Clsdatos.php:37]()).

3. **ID Field Required**: All CRUD operations assume an `id` field exists ([src/datos/Clsdatos.php:42](), [src/datos/Clsdatos.php:106]()).

4. **String-Only Updates**: `updateData()` only updates fields with `strlen() > 0`, preventing explicit null or zero values ([src/datos/Clsdatos.php:366]()).

**Sources:** [src/datos/Singleton.php:24-42](), [src/datos/Clsdatos.php:34-423]()

---

## Best Practices

### For New Development

1. **Use Safe Methods Exclusively**: Always use `_safe*` methods for database queries ([src/datos/Singleton.php:686-843]())

2. **Extend Clsdatos for Models**: Create model classes that extend `Clsdatos` for automatic CRUD ([src/datos/Clsdatos.php:9]())

3. **Follow Naming Conventions**: Table names should match model class names in lowercase ([src/datos/Clsdatos.php:37]())

4. **Handle Errors Explicitly**: Always check for `err_info` in result arrays when calling metadata methods

### For Legacy Code Maintenance

1. **Identify Vulnerable Code**: Search for `_classic*` method calls in the codebase

2. **Migrate Incrementally**: Replace classic methods with safe equivalents:
   - `_classicReadInfo()` → `_safeSelect()`
   - `_classicUpdate()` → `_safeUpdate()`
   - `_classicInsertUniqQuery()` → `_safeInsert()`
   - `_classicDelete()` → `_safeDelete()`

3. **Test Thoroughly**: Prepared statements handle escaping differently; verify queries return expected results

**Sources:** [src/datos/Singleton.php:263-378](), [src/datos/Singleton.php:686-843]()

---

## Related Documentation

- For controller interaction with the data layer, see [Controller Layer](#3)
- For business logic that uses these classes, see [Business Logic Layer](#4)
- For database connection configuration, see [System Configuration](#6.1)
- For specific model implementations, see [Data Models](#5.3)
- For the `Singleton` class details, see [Singleton - Database Connection Manager](#5.1)
- For the `Clsdatos` class details, see [Clsdatos - ORM and Data Access](#5.2)

---

---

## 5.1 Singleton - Database Connection Manager

## Purpose and Scope

The `Singleton` class serves as the centralized database connection manager for the GESFINANCIERO system. It implements the Singleton pattern to ensure a single `mysqli` connection instance is shared across the application, and provides a comprehensive set of query utilities, metadata inspection tools, and DataTables integration.

This document covers connection management, query methods (both classic and safe variants), metadata operations, DataTables support, and code generation utilities. For ORM-style data access that builds on top of Singleton, see [Clsdatos - ORM and Data Access](#5.2). For database configuration and credentials, see [System Configuration (Corporation.php)](#6.1).

**Sources:** [src/datos/Singleton.php:1-845]()

---

## Connection Management

### Singleton Pattern Implementation

The `Singleton` class maintains a single static `mysqli` connection instance in `Singleton::$lnk`. The constructor checks if a connection already exists; if not, it establishes one using credentials from the `Corporation` class.

```mermaid
graph TB
    APP["Application Code"]
    CTOR["Singleton::__construct()"]
    LNK["Singleton::$lnk<br/>(static mysqli instance)"]
    CORP["Corporation::HOST<br/>Corporation::DBUSER<br/>Corporation::DBPASS<br/>Corporation::DBNAME"]
    DB[("MySQL Database<br/>nuevapp_apps")]
    
    APP -->|"new Singleton()"| CTOR
    CTOR -->|"if !self::$lnk"| LNK
    CTOR -->|"reads credentials"| CORP
    CTOR -->|"new mysqli()"| DB
    LNK -.->|"shared connection"| DB
    
    style LNK fill:#f9f9f9
    style DB fill:#e8e8e8
```

**Diagram: Singleton Connection Initialization Flow**

**Sources:** [src/datos/Singleton.php:10-42](), [repo/corp/Corporation.php:17-20]()

### Constructor Parameters

The constructor accepts optional parameters to override default credentials:

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `$host` | string | `Corporation::HOST` | Database host |
| `$db` | string | `Corporation::DBNAME` | Database name |
| `$uname` | string | `Corporation::DBUSER` | Database username |
| `$pass` | string | `Corporation::DBPASS` | Database password |

If any parameter is an empty string, the corresponding `Corporation` constant is used instead. The connection is stored in `self::$lnk` and returned on success.

**Sources:** [src/datos/Singleton.php:24-42]()

### Connection Error Handling

Connection failures are reported via `echo` with the error code and message from `mysqli::connect_errno` and `mysqli::connect_error`. No exception is thrown; the method simply returns without setting `self::$lnk`.

**Sources:** [src/datos/Singleton.php:34-36]()

### Destructor

The destructor attempts to close the connection if `self::$lnk` exists and has a `close()` method. Note the logic contains a double-negative condition that may prevent proper closure in some cases.

**Sources:** [src/datos/Singleton.php:601-609]()

---

## Classic Query Methods (Legacy/Unsafe)

The "classic" methods construct SQL queries using string concatenation, which presents SQL injection risks if used with untrusted input. These methods exist for backward compatibility but should not be used in new code.

```mermaid
graph LR
    subgraph "Classic Query Methods (Unsafe)"
        CR["_classicReadInfo()"]
        CU["_classicUpdate()"]
        CI["_classicInsertUniqQuery()"]
        CIM["_classicInsertMultiQuery()"]
        CD["_classicDelete()"]
    end
    
    LNK["Singleton::$lnk->query()"]
    DB[("MySQL DB")]
    
    CR -->|"SELECT string"| LNK
    CU -->|"UPDATE string"| LNK
    CI -->|"INSERT string"| LNK
    CIM -->|"INSERT string"| LNK
    CD -->|"DELETE string"| LNK
    
    LNK --> DB
    
    style CR fill:#ffcccc
    style CU fill:#ffcccc
    style CI fill:#ffcccc
    style CIM fill:#ffcccc
    style CD fill:#ffcccc
```

**Diagram: Classic (Unsafe) Query Method Flow**

### _classicReadInfo()

Executes a SELECT query and returns an array of associative arrays.

**Method Signature:**
```php
public static function _classicReadInfo($tb, $ver = "*", $extra = "")
```

**Parameters:**
- `$tb` - Table name (converted to lowercase)
- `$ver` - Columns to select (default: `"*"`)
- `$extra` - SQL clauses like WHERE, ORDER BY, LIMIT

**Returns:** Array of rows as associative arrays. Closes connection after fetching.

**Sources:** [src/datos/Singleton.php:314-326]()

### _classicUpdate()

Executes an UPDATE query with manual SET and WHERE clauses.

**Method Signature:**
```php
public static function _classicUpdate($tb, $set, $extra)
```

**Parameters:**
- `$tb` - Table name (converted to lowercase)
- `$set` - SET clause (e.g., `"campo='valor'"`)
- `$extra` - Additional SQL (e.g., `"WHERE id=1"`)

**Returns:** `true` on success.

**Throws:** `Exception` with mysqli error message on failure.

**Sources:** [src/datos/Singleton.php:288-303]()

### _classicInsertUniqQuery()

Inserts a single row using manually constructed VALUES clause.

**Method Signature:**
```php
public static function _classicInsertUniqQuery($tb, $vls, $fld = "")
```

**Parameters:**
- `$tb` - Table name (converted to lowercase)
- `$vls` - VALUES clause (e.g., `"(1,'text')"`)
- `$fld` - Optional field list (e.g., `"(id,nombre)"`)

**Returns:** `true` on success.

**Throws:** `Exception` with mysqli error message on failure.

**Sources:** [src/datos/Singleton.php:364-378]()

### _classicInsertMultiQuery()

Similar to `_classicInsertUniqQuery()` but allows bulk inserts with multiple VALUES sets.

**Sources:** [src/datos/Singleton.php:339-353]()

### _classicDelete()

Executes a DELETE statement with manually constructed WHERE clause.

**Method Signature:**
```php
public static function _classicDelete($tb, $extra)
```

**Parameters:**
- `$tb` - Table name (converted to lowercase)
- `$extra` - WHERE and other clauses

**Returns:** `true` on success.

**Throws:** `Exception` with mysqli error message on failure.

**Sources:** [src/datos/Singleton.php:263-277]()

---

## Safe Query Methods (Prepared Statements)

The "safe" methods use prepared statements with parameter binding to prevent SQL injection. These should be preferred for all new code.

```mermaid
graph TB
    subgraph "Safe Query Methods (Prepared Statements)"
        SS["_safeSelect()"]
        SU["_safeUpdate()"]
        SI["_safeInsert()"]
        SD["_safeDelete()"]
        SR["_safeRawQuery()"]
    end
    
    subgraph "Prepared Statement Flow"
        PREP["mysqli->prepare()"]
        BIND["stmt->bind_param()"]
        EXEC["stmt->execute()"]
        FETCH["stmt->get_result()"]
    end
    
    DB[("MySQL DB")]
    
    SS --> PREP
    SU --> PREP
    SI --> PREP
    SD --> PREP
    SR --> PREP
    
    PREP --> BIND
    BIND --> EXEC
    EXEC --> FETCH
    FETCH --> DB
    
    style SS fill:#ccffcc
    style SU fill:#ccffcc
    style SI fill:#ccffcc
    style SD fill:#ccffcc
    style SR fill:#ccffcc
```

**Diagram: Safe (Prepared Statement) Query Method Flow**

### _safeSelect()

Executes a SELECT query using prepared statements with optional WHERE clause and parameter binding.

**Method Signature:**
```php
public static function _safeSelect($table, $fields = '*', $where = '', $params = [])
```

**Parameters:**
- `$table` - Table name (backtick-enclosed automatically)
- `$fields` - Columns to select (default: `'*'`)
- `$where` - WHERE clause without the "WHERE" keyword
- `$params` - Array of values to bind (treated as strings)

**Returns:** Array of associative arrays on success, or `['err_info' => string]` on error.

**Example Usage:**
```php
$users = Singleton::_safeSelect('userselecto', '*', 'email = ?', ['user@example.com']);
```

**Sources:** [src/datos/Singleton.php:786-805]()

### _safeUpdate()

Updates records using prepared statements with automatic SET clause construction.

**Method Signature:**
```php
public static function _safeUpdate($table, $data, $where, $params = [])
```

**Parameters:**
- `$table` - Table name
- `$data` - Associative array of column => value pairs for SET
- `$where` - WHERE clause (without "WHERE" keyword)
- `$params` - Additional parameters to bind for WHERE clause

**Returns:** `true` on success.

**Throws:** `Exception` on prepare or execute failure.

**Example Usage:**
```php
Singleton::_safeUpdate('userselecto', 
    ['nombre' => 'John Doe', 'email' => 'john@example.com'], 
    'id = ?', 
    [123]
);
```

**Sources:** [src/datos/Singleton.php:696-722]()

### _safeInsert()

Inserts a single row using prepared statements.

**Method Signature:**
```php
public static function _safeInsert($table, $data)
```

**Parameters:**
- `$table` - Table name
- `$data` - Associative array of column => value pairs

**Returns:** `true` on success.

**Throws:** `Exception` on prepare or execute failure.

**Example Usage:**
```php
Singleton::_safeInsert('userselecto', [
    'nombre' => 'Jane Doe',
    'email' => 'jane@example.com',
    'clave' => password_hash('secret', PASSWORD_DEFAULT)
]);
```

**Sources:** [src/datos/Singleton.php:759-775]()

### _safeDelete()

Deletes rows using prepared statements.

**Method Signature:**
```php
public static function _safeDelete($table, $where, $params = [])
```

**Parameters:**
- `$table` - Table name
- `$where` - WHERE clause with `?` placeholders
- `$params` - Array of values to bind

**Returns:** `true` on success.

**Throws:** `Exception` on prepare or execute failure.

**Example Usage:**
```php
Singleton::_safeDelete('userselecto', 'id = ? AND deleted = ?', [123, 1]);
```

**Sources:** [src/datos/Singleton.php:735-749]()

### _safeRawQuery()

Executes arbitrary SQL with prepared statement parameter binding. Useful for complex queries not covered by the other safe methods.

**Method Signature:**
```php
public static function _safeRawQuery($sql, $params = [])
```

**Parameters:**
- `$sql` - Full SQL query (SELECT, INSERT, UPDATE, DELETE, etc.)
- `$params` - Array of values to bind to `?` placeholders

**Returns:** 
- For SELECT queries: Array of associative arrays
- For other queries: `true` on success

**Throws:** `Exception` on prepare or execute failure.

**Example Usage:**
```php
$results = Singleton::_safeRawQuery(
    "SELECT u.*, p.nombre as perfil FROM userselecto u 
     JOIN perfilselecto p ON u.perfil = p.id 
     WHERE u.estado = ? AND u.institucion = ?",
    [1, 5]
);
```

**Sources:** [src/datos/Singleton.php:822-843]()

---

## Metadata Inspection Methods

The metadata methods allow runtime inspection of database table structure, useful for code generation and dynamic query construction.

```mermaid
graph TB
    APP["Application Code"]
    
    subgraph "Metadata Methods"
        MD["_metaDatos()<br/>Returns field names"]
        MDP["_metaDatosPlus()<br/>Returns field details"]
    end
    
    subgraph "Field Information"
        NAMES["Field Names Only"]
        DETAILS["Field Names<br/>Type IDs<br/>Mapped Types<br/>Lengths"]
    end
    
    TYPES["Type Constants<br/>SQLTP_TINYINT<br/>SQLTP_INT<br/>SQLTP_VARCHAR<br/>SQLTP_TEXT<br/>SQLTP_DATE<br/>SQLTP_DATETIME<br/>SQLTP_DECIMAL<br/>SQLTP_JSON"]
    
    APP -->|"_metaDatos('users')"| MD
    APP -->|"_metaDatosPlus('users')"| MDP
    
    MD --> NAMES
    MDP --> DETAILS
    
    MDP -.->|"maps type IDs"| TYPES
    
    style NAMES fill:#f9f9f9
    style DETAILS fill:#f9f9f9
```

**Diagram: Metadata Inspection Methods**

### _metaDatos()

Retrieves field names for a table by executing `SELECT * FROM table LIMIT 1` and extracting metadata.

**Method Signature:**
```php
public static function _metaDatos($tb)
```

**Parameters:**
- `$tb` - Table name (converted to lowercase)

**Returns:** Associative array where both keys and values are field names, or `['err_info' => string]` on error.

**Example Output:**
```php
[
    'id' => 'id',
    'nombre' => 'nombre',
    'email' => 'email',
    'created_at' => 'created_at'
]
```

**Sources:** [src/datos/Singleton.php:70-89]()

### _metaDatosPlus()

Retrieves detailed field information including types and lengths.

**Method Signature:**
```php
public static function _metaDatosPlus($tb)
```

**Parameters:**
- `$tb` - Table name (converted to lowercase)

**Returns:** Associative array keyed by field name with detailed information for each field:
- `nombre` - Field name
- `tipoid` - MySQL type ID (numeric)
- `tipo` - Mapped type constant (e.g., `Singleton::SQLTP_VARCHAR`)
- `largo` - Field length

**Type Mapping Table:**

| MySQL Type ID | Mapped Constant | Description |
|---------------|-----------------|-------------|
| 1 | `SQLTP_TINYINT` | Tiny integer |
| 3 | `SQLTP_INT` | Integer |
| 8 | `SQLTP_BIGINT` | Big integer |
| 10 | `SQLTP_DATE` | Date |
| 12 | `SQLTP_DATETIME` | Datetime |
| 245 | `SQLTP_JSON` | JSON (note: swapped with DECIMAL) |
| 246 | `SQLTP_DECIMAL` | Decimal (note: swapped with JSON) |
| 252 | `SQLTP_TEXT` | Text |
| 253 | `SQLTP_VARCHAR` | Variable character |

**Note:** There's a potential bug at lines 96-97 where `SQLTP_DECIMAL` and `SQLTP_JSON` constant values appear to be swapped.

**Example Output:**
```php
[
    'id' => [
        'nombre' => 'id',
        'tipoid' => 3,
        'tipo' => 'int',
        'largo' => 11
    ],
    'email' => [
        'nombre' => 'email',
        'tipoid' => 253,
        'tipo' => 'varchar',
        'largo' => 100
    ]
]
```

**Sources:** [src/datos/Singleton.php:91-148]()

---

## Legacy Read Methods

These methods use prepared statements but with specific character encoding handling. They are semi-legacy and used for backward compatibility.

### _readInfo()

Executes a SELECT query and converts results to UTF-8 encoding.

**Method Signature:**
```php
public static function _readInfo($tb, $ver = "*", $extra = "")
```

**Parameters:**
- `$tb` - Table name
- `$ver` - Columns to select
- `$extra` - Additional SQL clauses

**Returns:** Array of rows with values converted to UTF-8 using `mb_convert_encoding()`.

**Sources:** [src/datos/Singleton.php:156-194]()

### _readInfoChar()

Similar to `_readInfo()` but allows custom character encoding conversion.

**Method Signature:**
```php
public static function _readInfoChar($tb, $ver = "*", $extra = "", $desdeChar = "utf8", $hasta = "")
```

**Parameters:**
- `$tb` - Table name
- `$ver` - Columns to select
- `$extra` - Additional SQL clauses
- `$desdeChar` - Target encoding (or source if `$hasta` is provided)
- `$hasta` - Optional source encoding for conversion

**Sources:** [src/datos/Singleton.php:205-253]()

### _readEstado()

Specialized method for reading state/status records with ordering and filtering capabilities.

**Method Signature:**
```php
public static function _readEstado($d)
```

**Parameters:**
- `$d` - Configuration array with keys:
  - `tabla` - Table name (required)
  - `id` - Filter by ID
  - `ordendesc` - Order by column DESC
  - `ordenasc` - Order by column ASC
  - `limite` - LIMIT clause
  - `debug` - If true, prints SQL and dies

**Returns:** Result from `_safeRawQuery()`.

**Throws:** `Exception` if result contains `err_info` key.

**Sources:** [src/datos/Singleton.php:626-684]()

---

## DataTables Integration

The `_dataTable()` method provides seamless integration with the DataTables jQuery plugin for server-side processing of large datasets.

```mermaid
graph LR
    CLIENT["Client Browser<br/>DataTables JS"]
    POST["POST Request<br/>$_POST params"]
    DT["_dataTable()"]
    META["_metaDatosPlus()"]
    SSP["SSP::simple()<br/>(DataTables lib)"]
    DB[("MySQL DB")]
    JSON["JSON Response"]
    
    CLIENT -->|"DataTables AJAX"| POST
    POST --> DT
    DT -->|"inspect schema"| META
    META --> DB
    DT -->|"build columns config"| SSP
    SSP -->|"query with pagination"| DB
    SSP --> JSON
    JSON --> CLIENT
    
    style DT fill:#f9f9f9
    style SSP fill:#e8e8e8
```

**Diagram: DataTables Server-Side Processing Flow**

### _dataTable()

Automatically generates DataTables configuration from table metadata and processes DataTables AJAX requests.

**Method Signature:**
```php
public static function _dataTable($data)
```

**Parameters:**
- `$data` - Configuration array:
  - `tb` - Table name (required)
  - `codifica_a` - Optional encoding target
  - `codifica_desde` - Optional encoding source

**Returns:** Array structure ready for JSON encoding and DataTables consumption.

**Processing Steps:**

1. **Metadata Inspection:** Calls `_metaDatosPlus()` to get table structure
2. **Column Configuration:** Builds column array with formatters:
   - `SQLTP_DATETIME` fields: Formatted as `Y-m-d H:i:s`
   - `SQLTP_DECIMAL` fields: Formatted as currency with `$` prefix
   - `id` field: Creates both data column and `DT_RowId` with `row_` prefix
   - Other fields: Mapped directly
3. **SSP Delegation:** Uses `SSP::simple()` from DataTables PHP library
4. **Connection Management:** Closes existing connection before SSP creates new one

**Example Column Configuration:**
```php
// For DATETIME field:
[
    'db' => 'created_at',
    'dt' => 'created_at',
    'formatter' => function($d, $row) {
        return date('Y-m-d H:i:s', strtotime($d));
    }
]

// For DECIMAL field:
[
    'db' => 'amount',
    'dt' => 'amount',
    'formatter' => function($d, $row) {
        return '$' . number_format($d);
    }
]
```

**Sources:** [src/datos/Singleton.php:526-592]()

---

## Code Generation Utilities

The Singleton class includes utilities for generating model classes and view templates from database schema, facilitating rapid development.

```mermaid
graph TB
    MODELOS["_modelos()"]
    META["_metaDatosPlus()"]
    INFO["INFORMATION_SCHEMA.TABLES"]
    
    subgraph "Generated Files"
        MODEL["tmpmodelo/*.php<br/>Model Classes"]
        VIEW["tmpvistas/*.phtml<br/>Form Templates"]
        MENU["JavaScript Menu Entries"]
    end
    
    DB[("Database Schema")]
    
    MODELOS -->|"list tables"| INFO
    INFO --> DB
    MODELOS -->|"foreach table"| META
    META --> DB
    
    MODELOS -->|"if !jsMenu"| MODEL
    MODELOS -->|"if !jsMenu"| VIEW
    MODELOS -->|"if jsMenu"| MENU
    
    style MODEL fill:#ccffcc
    style VIEW fill:#ccffcc
    style MENU fill:#ffcccc
```

**Diagram: Code Generation Process**

### _modelos()

Generates PHP model classes and PHTML form templates for all tables in the configured database.

**Method Signature:**
```php
public static function _modelos($jsMenu = false)
```

**Parameters:**
- `$jsMenu` - If `true`, only outputs JavaScript menu entries instead of creating files

**Process:**

1. **Directory Creation:** Creates `tmpmodelo/` and `tmpvistas/` directories in `src/datos/`
2. **Table Iteration:** Queries `INFORMATION_SCHEMA.TABLES` for all tables
3. **Per-Table Generation:**
   - Inspects table metadata with `_metaDatos()`
   - Generates PHP class extending `Clsdatos`
   - Creates private properties for each field
   - Generates getter/setter methods
   - Creates corresponding PHTML form template with inputs

**Generated Model Class Structure:**
```php
class Tablename extends Clsdatos {
    private $id = 0;
    private $campo = "";
    
    public function getId() { return $this->id; }
    public function setId($vl) { $this->id = $vl; }
    
    public function getCampo() { return $this->campo; }
    public function setCampo($vl) { $this->campo = $vl; }
}
```

**Generated PHTML Template Structure:**
- Form with POST method
- Table-based layout for each field
- Label and input for each column
- Hidden fields for page ID and JS menu ID
- Submit button

**Menu Output (if `$jsMenu = true`):**
Prints JavaScript lines like:
```javascript
pageMenu.agregarMenu(utilidades.appPath("img/") + "admin_casos.png", "Tablename", "modelos/Tablename.phtml");
```

**Sources:** [src/datos/Singleton.php:390-491]()

### Helper Methods for Code Generation

#### toCap()

Capitalizes the first letter of a string.

**Method Signature:**
```php
public static function toCap($str)
```

**Returns:** String with first letter capitalized, or empty string if input is empty.

**Sources:** [src/datos/Singleton.php:512-514]()

#### RwFile()

Writes text to a file, overwriting existing content.

**Method Signature:**
```php
public static function RwFile($flwr, $txt)
```

**Parameters:**
- `$flwr` - File path
- `$txt` - Text content to write

**Sources:** [src/datos/Singleton.php:500-504]()

---

## Utility Methods

### _arrayToTableReference()

Converts an array of objects into an associative lookup table by invoking specified methods on each object.

**Method Signature:**
```php
public static function _arrayToTableReference($arreglo, $campoId = "getId", $campoValor = "getNombre")
```

**Parameters:**
- `$arreglo` - Array of objects
- `$campoId` - Method name to get key (default: `"getId"`)
- `$campoValor` - Method name to get value (default: `"getNombre"`)

**Returns:** Associative array with `id => value` mappings.

**Example:**
```php
$usuarios = [...]; // Array of user objects
$lookup = Singleton::_arrayToTableReference($usuarios, "getId", "getNombre");
// Result: [1 => "John Doe", 2 => "Jane Smith", ...]
```

**Sources:** [src/datos/Singleton.php:52-58]()

---

## Architecture Summary

```mermaid
graph TB
    subgraph "Controllers"
        INDEXCTRL["IndexCtrl"]
        OPCTRL["OperacionesCtrl"]
        HOMECTRL["HomeCtrl"]
        REST["Rest"]
    end
    
    subgraph "Singleton - Database Connection Manager"
        CTOR["__construct()<br/>Connection Singleton"]
        
        subgraph "Query Methods"
            CLASSIC["Classic Methods<br/>(Unsafe)<br/>_classicReadInfo()<br/>_classicUpdate()<br/>_classicInsert*()<br/>_classicDelete()"]
            SAFE["Safe Methods<br/>(Prepared Statements)<br/>_safeSelect()<br/>_safeUpdate()<br/>_safeInsert()<br/>_safeDelete()<br/>_safeRawQuery()"]
            LEGACY["Legacy Read Methods<br/>_readInfo()<br/>_readInfoChar()<br/>_readEstado()"]
        end
        
        subgraph "Utilities"
            META["Metadata<br/>_metaDatos()<br/>_metaDatosPlus()"]
            DT["DataTables<br/>_dataTable()"]
            CODEGEN["Code Generation<br/>_modelos()"]
            HELPERS["Helpers<br/>_arrayToTableReference()<br/>toCap()<br/>RwFile()"]
        end
    end
    
    subgraph "Configuration"
        CORP["Corporation<br/>HOST<br/>DBUSER<br/>DBPASS<br/>DBNAME"]
    end
    
    subgraph "External Libraries"
        SSP["SSP::simple()<br/>DataTables PHP"]
    end
    
    DB[("MySQL Database<br/>nuevapp_apps")]
    
    INDEXCTRL --> CLASSIC
    INDEXCTRL --> SAFE
    INDEXCTRL --> LEGACY
    OPCTRL --> CLASSIC
    OPCTRL --> SAFE
    OPCTRL --> LEGACY
    HOMECTRL --> SAFE
    REST --> SAFE
    
    CTOR -.->|"reads config"| CORP
    CTOR -->|"mysqli connection"| DB
    
    CLASSIC -->|"direct query()"| DB
    SAFE -->|"prepared statements"| DB
    LEGACY -->|"prepared statements"| DB
    META -->|"schema inspection"| DB
    
    DT --> META
    DT --> SSP
    SSP --> DB
    
    CODEGEN --> META
    
    style CLASSIC fill:#ffcccc
    style SAFE fill:#ccffcc
    style LEGACY fill:#ffffcc
```

**Diagram: Singleton Class Architecture and Usage**

---

## Usage Recommendations

### Security Best Practices

1. **Prefer Safe Methods:** Always use `_safe*()` methods in new code to prevent SQL injection
2. **Avoid Classic Methods:** The `_classic*()` methods should be considered deprecated and gradually migrated
3. **Validate Input:** Even with prepared statements, validate and sanitize user input before passing to queries
4. **Externalize Credentials:** The hard-coded credentials in `Corporation` constants should be moved to environment variables

### Performance Considerations

1. **Connection Reuse:** The Singleton pattern ensures connection reuse across requests
2. **Prepared Statement Caching:** mysqli automatically caches prepared statements, providing performance benefits for repeated queries
3. **DataTables Optimization:** Use `_dataTable()` for large datasets to leverage server-side pagination
4. **Metadata Caching:** Consider caching results from `_metaDatosPlus()` to avoid repeated schema queries

### Migration Path

For legacy code using classic methods, follow this migration pattern:

**Before:**
```php
$result = Singleton::_classicReadInfo('userselecto', '*', "WHERE email = '$email'");
```

**After:**
```php
$result = Singleton::_safeSelect('userselecto', '*', 'email = ?', [$email]);
```

**Sources:** [src/datos/Singleton.php:1-845]()

---

## Related Documentation

- [Clsdatos - ORM and Data Access](#5.2) - ORM layer built on Singleton
- [Data Models](#5.3) - Model classes that use Clsdatos/Singleton
- [System Configuration (Corporation.php)](#6.1) - Database credentials and configuration
- [OperacionesCtrl - Core Operations](#4.1) - Primary consumer of Singleton methods
- [IndexCtrl - Main Application Controller](#3.1) - Controller that uses Singleton extensively

---

---

## 5.2 Clsdatos - ORM and Data Access

## Purpose and Scope

This document describes the `Clsdatos` class, which provides ORM (Object-Relational Mapping) functionality for the GESFINANCIERO system. `Clsdatos` implements an Active Record pattern that allows model classes to perform CRUD operations directly on database tables using object-oriented syntax.

For database connection management and query utilities, see [Singleton - Database Connection Manager](#5.1). For information about model classes that extend `Clsdatos`, see [Data Models](#5.3).

**Sources:** [src/datos/Clsdatos.php:1-425]()

## Class Architecture

`Clsdatos` extends `Singleton` to inherit database connection capabilities. The class is designed to be extended by model classes located in `src/modelo/`, with each model representing a database table. The class name maps directly to the table name (converted to lowercase).

```mermaid
graph TB
    Singleton["Singleton<br/>Database Connection Manager"]
    Clsdatos["Clsdatos<br/>Base ORM Class<br/>src/datos/Clsdatos.php"]
    Models["Model Classes<br/>src/modelo/*<br/>Extend Clsdatos"]
    
    subgraph "Core Components"
        ErrorHandling["Error Handling<br/>obtenerError()<br/>limpiarError()"]
        ReadOps["Read Operations<br/>readInfo()<br/>readInfoById()"]
        WriteOps["Write Operations<br/>saveData()<br/>updateData()"]
        DeleteOps["Delete Operations<br/>deleteById()<br/>deleteByField()"]
        BulkOps["Bulk Operations<br/>saveDataFromPost()"]
    end
    
    subgraph "Database Layer"
        Connection["self::$lnk<br/>mysqli connection"]
        PreparedStmts["Prepared Statements<br/>mysqli_stmt"]
    end
    
    Singleton --> Clsdatos
    Clsdatos --> Models
    
    Clsdatos --> ErrorHandling
    Clsdatos --> ReadOps
    Clsdatos --> WriteOps
    Clsdatos --> DeleteOps
    Clsdatos --> BulkOps
    
    ReadOps --> Connection
    WriteOps --> Connection
    DeleteOps --> Connection
    BulkOps --> Connection
    
    Connection --> PreparedStmts
```

**Sources:** [src/datos/Clsdatos.php:9-11](), [src/datos/Singleton.php:8-10]()

## CRUD Operations Overview

`Clsdatos` provides a complete set of CRUD operations that work through prepared statements. All operations use the class name (lowercased) to determine the target table.

| Operation Category | Methods | Security | Return Type |
|-------------------|---------|----------|-------------|
| **Create** | `saveData()` | Prepared statements | `int` (insert_id) |
| **Read** | `readInfo()`, `readInfoById()` | Prepared statements | `array` or `object` |
| **Update** | `updateData()` | Prepared statements | `int` (affected_rows) |
| **Delete** | `deleteById()`, `deleteByField()` | Prepared statements | `int` (affected_rows) |
| **Bulk** | `saveDataFromPost()` | Prepared statements | `array` (IDs) |

**Table Naming Convention:**
- Class name: `Userselecto`
- Table name: `userselecto` (automatic lowercase conversion)
- ID field: Always `id` (required for Active Record pattern)

**Sources:** [src/datos/Clsdatos.php:34-424]()

## Read Operations

### readInfoById()

Retrieves a single record by ID and populates a new instance of the calling class with the data. Uses reflection to dynamically call setter methods based on column names.

```mermaid
sequenceDiagram
    participant Model as "Model Instance<br/>(e.g., $user)"
    participant Clsdatos as "Clsdatos::readInfoById()"
    participant DB as "self::$lnk<br/>(mysqli)"
    participant Metadata as "stmt->result_metadata()"
    
    Model->>Clsdatos: readInfoById()
    Clsdatos->>Clsdatos: Extract ID via getId()
    Clsdatos->>DB: prepare("SELECT * FROM table WHERE id = ?")
    DB-->>Clsdatos: prepared statement
    Clsdatos->>DB: bind_param('i', $_id)
    Clsdatos->>DB: execute()
    Clsdatos->>Metadata: fetch field metadata
    Metadata-->>Clsdatos: field names array
    Clsdatos->>DB: bind_result() to $row array
    Clsdatos->>DB: fetch()
    DB-->>Clsdatos: row data
    Clsdatos->>Clsdatos: Create new instance
    Clsdatos->>Model: Call setters dynamically<br/>(e.g., setNombre($val))
    Clsdatos-->>Model: populated object
```

**Key Implementation Details:**

1. **Dynamic Method Resolution:** Looks for `getId()` method using reflection [src/datos/Clsdatos.php:96-100]()
2. **Table Name Resolution:** Uses `get_class($this)` and converts to lowercase [src/datos/Clsdatos.php:92]()
3. **Dynamic Setters:** Calls `set{CapitalizedFieldName}()` for each column [src/datos/Clsdatos.php:120]()
4. **Result Binding:** Uses `result_metadata()` and `bind_result()` pattern [src/datos/Clsdatos.php:110-116]()

**Example Usage:**
```php
$user = new Userselecto();
$user->setId(42);
$populatedUser = $user->readInfoById();
// $populatedUser contains all fields from userselecto table where id=42
```

**Sources:** [src/datos/Clsdatos.php:88-138]()

### readInfo()

Retrieves multiple records based on custom SELECT and WHERE clauses. Returns an array of populated model instances.

**Method Signature:**
```php
public function readInfo($ver = "*", $extra = "")
```

**Parameters:**
- `$ver`: Column specification (e.g., `"id, nombre"` or `"COUNT(id)"`)
- `$extra`: SQL clauses (e.g., `"WHERE activo = 1 ORDER BY nombre"`)

**Implementation Pattern:**

1. Constructs query: `SELECT {$ver} FROM {table} {$extra}` [src/datos/Clsdatos.php:157]()
2. Prepares statement and binds results dynamically [src/datos/Clsdatos.php:159-168]()
3. Creates new model instance for each row [src/datos/Clsdatos.php:171]()
4. Populates instances using dynamic setters [src/datos/Clsdatos.php:172-175]()
5. Falls back to non-prepared query if no results (legacy support) [src/datos/Clsdatos.php:180-189]()

**Sources:** [src/datos/Clsdatos.php:146-200]()

## Write Operations

### saveData()

Inserts a new record using values from the current object's properties. Returns the auto-increment ID of the newly created record.

```mermaid
graph TB
    Start["saveData() called"]
    GetClass["Get class name<br/>$_nombre = get_class($this)"]
    GetMetadata["Query table metadata<br/>SELECT * FROM table LIMIT 1"]
    ExtractValues["Extract values via getters<br/>$valores[$field] = $this->getNombre()"]
    BuildQuery["Build INSERT query<br/>INSERT INTO table (fields) VALUES (?, ?, ...)"]
    PrepareStmt["Prepare statement<br/>self::$lnk->prepare($query)"]
    BindParams["Bind parameters<br/>bind_param('sss...', $values)"]
    Execute["Execute statement"]
    GetInsertId["Get insert_id"]
    Return["Return insert_id"]
    
    Start --> GetClass
    GetClass --> GetMetadata
    GetMetadata --> ExtractValues
    ExtractValues --> BuildQuery
    BuildQuery --> PrepareStmt
    PrepareStmt --> BindParams
    BindParams --> Execute
    Execute --> GetInsertId
    GetInsertId --> Return
```

**Key Features:**

1. **Automatic Field Discovery:** Uses `result_metadata()` to discover table structure [src/datos/Clsdatos.php:281-290]()
2. **Dynamic Getter Invocation:** Calls `get{CapitalizedFieldName}()` for each field [src/datos/Clsdatos.php:287]()
3. **Null Handling:** Converts empty strings to NULL [src/datos/Clsdatos.php:303]()
4. **Type Binding:** All parameters bound as strings ('s' type) [src/datos/Clsdatos.php:316]()
5. **Reference Binding:** Uses references for bind_param [src/datos/Clsdatos.php:313-314]()

**Error Handling:**
- Stores error in `$this->mensaje_error` [src/datos/Clsdatos.php:292, 309, 323]()
- Returns -1 on failure [src/datos/Clsdatos.php:274]()

**Sources:** [src/datos/Clsdatos.php:272-333]()

### updateData()

Updates an existing record identified by the object's ID. Only updates fields that have non-empty values.

**Update Logic:**

1. **ID Validation:** Extracts and validates ID > 0 [src/datos/Clsdatos.php:340-352]()
2. **Selective Updates:** Only includes fields with `strlen($value) > 0` [src/datos/Clsdatos.php:366-369]()
3. **Query Construction:** Builds `UPDATE table SET field1=?, field2=? WHERE id=?` [src/datos/Clsdatos.php:389]()
4. **Type Binding:** All fields as strings, ID as integer (`'sss...i'`) [src/datos/Clsdatos.php:401]()
5. **Return Value:** Number of affected rows [src/datos/Clsdatos.php:413]()

**Critical Detail:** The ID parameter is appended last and bound as integer type [src/datos/Clsdatos.php:371, 401]()

**Sources:** [src/datos/Clsdatos.php:339-423]()

## Delete Operations

Both delete methods use prepared statements with integer parameter binding for security.

### deleteById()

Deletes the record corresponding to the current object's ID.

```php
// Implementation pattern
$sql = "DELETE FROM " . $_nombre . " WHERE id = ?";
$stmt->bind_param('i', $_id);
```

**Sources:** [src/datos/Clsdatos.php:34-61]()

### deleteByField()

Deletes records matching a specific field value.

```php
// Implementation pattern
public function deleteByField($campo, $valor)
$sql = "DELETE FROM " . $_nombre . " WHERE " . $campo . " = ?";
$stmt->bind_param('i', $valor);
```

**Security Note:** Field name is concatenated directly (no parameterization), so should only be called with validated/hardcoded field names.

**Sources:** [src/datos/Clsdatos.php:67-82]()

## Bulk Operations

### saveDataFromPost()

Processes HTML form arrays (multiple records) and performs bulk insert/update operations. Designed for forms where field names use array notation (e.g., `name="campo[]"`).

```mermaid
graph TB
    Start["saveDataFromPost($entidades)"]
    GetMetadata["Get table metadata<br/>Singleton::_metaDatos($entidad)"]
    CountRecords["Count records from $_POST arrays<br/>$totalArreglo = sizeof($_POST[field])"]
    LoopStart["for i = 0 to totalArreglo"]
    CreateInstance["Create new instance<br/>$o = new $entidad()"]
    PopulateFields["Populate fields from $_POST[field][i]"]
    OptionalEncode["Optional: htmlentities($value)"]
    CheckId["$o->getId() > 0?"]
    DoUpdate["$o->updateData()"]
    DoInsert["$o->saveData()"]
    CollectId["$oArr[] = ID"]
    LoopEnd["Next record"]
    Return["Return array of IDs"]
    
    Start --> GetMetadata
    GetMetadata --> CountRecords
    CountRecords --> LoopStart
    LoopStart --> CreateInstance
    CreateInstance --> PopulateFields
    PopulateFields --> OptionalEncode
    OptionalEncode --> CheckId
    CheckId -->|"Yes"| DoUpdate
    CheckId -->|"No"| DoInsert
    DoUpdate --> CollectId
    DoInsert --> CollectId
    CollectId --> LoopEnd
    LoopEnd -->|"More records"| LoopStart
    LoopEnd -->|"Done"| Return
```

**Processing Steps:**

1. **Metadata Extraction:** Gets all field names from table [src/datos/Clsdatos.php:212]()
2. **Array Size Detection:** Determines record count from first POST array [src/datos/Clsdatos.php:218-225]()
3. **Record Iteration:** Loops through each record index [src/datos/Clsdatos.php:228]()
4. **Object Population:** Creates instance and calls setters [src/datos/Clsdatos.php:230-246]()
5. **HTML Entity Encoding:** Optional parameter for XSS protection [src/datos/Clsdatos.php:240-242]()
6. **Smart Save:** Updates if ID exists, inserts otherwise [src/datos/Clsdatos.php:251-257]()

**Example Form Structure:**
```html
<input type="text" name="nombre[]" />
<input type="text" name="email[]" />
<input type="hidden" name="id[]" value="0" />
```

**Sources:** [src/datos/Clsdatos.php:208-266]()

## Dynamic Method Resolution

`Clsdatos` uses PHP reflection and magic methods to work generically with any model class. The pattern relies on naming conventions.

### Naming Convention Map

| Database Column | Getter Method | Setter Method | Usage |
|----------------|---------------|---------------|--------|
| `id` | `getId()` | `setId($v)` | Primary key |
| `nombre` | `getNombre()` | `setNombre($v)` | String field |
| `fecha_creado` | `getFechaCreado()` | `setFechaCreado($v)` | Underscore to CamelCase |
| `activo` | `getActivo()` | `setActivo($v)` | Boolean/tinyint |

### Capitalization Logic

The `Singleton::toCap()` method converts field names to method names:

```php
// From Singleton class
public static function toCap($str) {
    return strtoupper(substr($str, 0, 1)) . substr($str, 1, strlen($str));
}
```

**Examples:**
- `nombre` → `Nombre` → `getNombre()` / `setNombre()`
- `fecha_creado` → `Fecha_creado` → `getFechaCreado()` / `setFechaCreado()`

**Dynamic Invocation Pattern:**
```php
// Reading data
$value = $this->{"get" . Singleton::toCap($fieldName)}();

// Writing data
$this->{"set" . Singleton::toCap($fieldName)}($value);
```

**Sources:** [src/datos/Clsdatos.php:120, 173, 236, 287, 365](), [src/datos/Singleton.php:512-514]()

## Error Handling

`Clsdatos` implements a simple error message storage mechanism instead of throwing exceptions.

### Error Management Methods

```mermaid
graph LR
    Operation["CRUD Operation<br/>(saveData, updateData, etc.)"]
    CheckError["Check mysqli error<br/>self::$lnk->error"]
    StoreError["Store in $mensaje_error"]
    ReturnFailure["Return -1 or null"]
    ClientCheck["Client calls obtenerError()"]
    ClientClear["Client calls limpiarError()"]
    
    Operation --> CheckError
    CheckError -->|"Error exists"| StoreError
    StoreError --> ReturnFailure
    ReturnFailure --> ClientCheck
    ClientCheck --> ClientClear
```

### Error Handling Pattern

**Private Property:**
```php
private $mensaje_error = null;
```

**Public Methods:**
```php
public function obtenerError()    // Returns error message
public function limpiarError()    // Clears error message
```

**Usage in Operations:**
```php
if (!$stmt) {
    $this->mensaje_error = self::$lnk->error;
    return -1;
}
```

**Error Storage Points:**
- [src/datos/Clsdatos.php:55]() - deleteById failure
- [src/datos/Clsdatos.php:77]() - deleteByField failure
- [src/datos/Clsdatos.php:126]() - readInfoById prepare failure
- [src/datos/Clsdatos.php:192]() - readInfo prepare failure
- [src/datos/Clsdatos.php:292]() - saveData metadata failure
- [src/datos/Clsdatos.php:309]() - saveData prepare failure
- [src/datos/Clsdatos.php:323]() - saveData execute failure
- [src/datos/Clsdatos.php:374]() - updateData metadata failure
- [src/datos/Clsdatos.php:393]() - updateData prepare failure
- [src/datos/Clsdatos.php:407]() - updateData execute failure

**Sources:** [src/datos/Clsdatos.php:11-28]()

## Integration with Model Classes

Model classes extend `Clsdatos` and define private properties with getters/setters following the naming convention.

### Model Class Structure

```mermaid
graph TB
    subgraph "Model Class Example: Userselecto"
        Properties["Private Properties<br/>$id = 0<br/>$nombre = ''<br/>$email = ''<br/>$activo = 0"]
        Getters["Getter Methods<br/>getId()<br/>getNombre()<br/>getEmail()<br/>getActivo()"]
        Setters["Setter Methods<br/>setId($v)<br/>setNombre($v)<br/>setEmail($v)<br/>setActivo($v)"]
    end
    
    subgraph "Inherited from Clsdatos"
        CRUD["CRUD Operations<br/>saveData()<br/>updateData()<br/>readInfo()<br/>readInfoById()<br/>deleteById()"]
    end
    
    subgraph "Database Table: userselecto"
        Columns["Columns<br/>id INT<br/>nombre VARCHAR<br/>email VARCHAR<br/>activo TINYINT"]
    end
    
    Properties --> Getters
    Properties --> Setters
    Getters --> CRUD
    Setters --> CRUD
    CRUD --> Columns
```

### Active Record Pattern Implementation

**Create:**
```php
$user = new Userselecto();
$user->setNombre("John Doe");
$user->setEmail("john@example.com");
$user->setActivo(1);
$newId = $user->saveData();  // Returns insert_id
```

**Read:**
```php
// Single record
$user = new Userselecto();
$user->setId(42);
$user = $user->readInfoById();

// Multiple records
$user = new Userselecto();
$users = $user->readInfo("*", "WHERE activo = 1 ORDER BY nombre");
```

**Update:**
```php
$user = new Userselecto();
$user->setId(42);
$user = $user->readInfoById();
$user->setEmail("newemail@example.com");
$affectedRows = $user->updateData();
```

**Delete:**
```php
$user = new Userselecto();
$user->setId(42);
$affectedRows = $user->deleteById();
```

**Sources:** [src/datos/Clsdatos.php:9]()

## Table Name to Class Name Mapping

The mapping between database tables and PHP classes is automatic and case-insensitive.

| Database Table | PHP Class | Automatic Conversion |
|---------------|-----------|---------------------|
| `userselecto` | `Userselecto` | `strtolower(get_class($this))` |
| `perfilselecto` | `Perfilselecto` | `strtolower(get_class($this))` |
| `docsestados` | `Docsestados` | `strtolower(get_class($this))` |
| `apibox` | `Apibox` | `strtolower(get_class($this))` |
| `codigoactiva` | `Codigoactiva` | `strtolower(get_class($this))` |

**Implementation References:**
- [src/datos/Clsdatos.php:37]() - deleteById table name
- [src/datos/Clsdatos.php:68]() - deleteByField table name
- [src/datos/Clsdatos.php:105]() - readInfoById table name
- [src/datos/Clsdatos.php:157]() - readInfo table name
- [src/datos/Clsdatos.php:281]() - saveData table name
- [src/datos/Clsdatos.php:359]() - updateData table name

**Convention Rule:** All table names must be lowercase in the database to ensure case-insensitive matching.

**Sources:** [src/datos/Clsdatos.php:37, 68, 92, 105, 150, 157, 278, 355]()

## Prepared Statement Security

All CRUD operations in `Clsdatos` use MySQLi prepared statements to prevent SQL injection.

### Parameter Binding Types

| Operation | Method | Binding Pattern | Type String |
|-----------|--------|----------------|-------------|
| Delete by ID | `deleteById()` | Single integer | `'i'` |
| Delete by field | `deleteByField()` | Single integer | `'i'` |
| Read by ID | `readInfoById()` | Single integer | `'i'` |
| Insert | `saveData()` | Multiple strings | `'sss...'` |
| Update | `updateData()` | Strings + integer ID | `'sss...i'` |

### Security Features

1. **No String Concatenation:** SQL is built with placeholders [src/datos/Clsdatos.php:47, 69, 105, 305, 389]()
2. **Prepared Statements:** All queries use `mysqli::prepare()` [src/datos/Clsdatos.php:49, 71, 106, 282, 360]()
3. **Parameter Binding:** Values bound separately from query [src/datos/Clsdatos.php:50, 72, 107, 318, 404]()
4. **Reference Binding:** Uses references for `bind_param()` [src/datos/Clsdatos.php:313-318, 396-404]()

**Exception:** Field names in `deleteByField()` are concatenated directly and should only receive validated input [src/datos/Clsdatos.php:69]()

**Sources:** [src/datos/Clsdatos.php:34-424]()

---

---

## 5.3 Data Models

## Purpose and Scope

This document describes the data model layer in GESFINANCIERO, including the structure of model classes, dynamic loading mechanisms, naming conventions, and common patterns. Models represent database tables and provide an object-oriented interface for data manipulation through the Active Record pattern.

For information about the base ORM functionality that models inherit, see [Clsdatos - ORM and Data Access](#5.2). For database connection management and query execution, see [Singleton - Database Connection Manager](#5.1).

---

## Model Architecture Overview

The model layer follows a convention-over-configuration approach where PHP classes in the `src/modelo/` directory automatically map to database tables. All models extend `Clsdatos`, which provides CRUD operations and dynamic property access.

### Model Class Hierarchy

```mermaid
graph TB
    Singleton["Singleton<br/>Database Connection<br/>Query Utilities"]
    Clsdatos["Clsdatos<br/>Base ORM Class<br/>CRUD Operations"]
    
    subgraph "User Domain Models"
        userselecto["userselecto<br/>User Selection/Authentication"]
        perfilselecto["perfilselecto<br/>User Profile Data"]
        estadoselecto["estadoselecto<br/>Status/State Management"]
        extusers["extusers<br/>External Users"]
    end
    
    subgraph "Document Domain Models"
        docsestados["docsestados<br/>Document States"]
        adjuntosflujos["adjuntosflujos<br/>Workflow Attachments"]
        plantillas["plantillas<br/>Document Templates"]
        firmas["firmas<br/>Digital Signatures"]
    end
    
    subgraph "System Domain Models"
        apibox["apibox<br/>API Token Storage"]
        codigoactiva["codigoactiva<br/>Activation Codes"]
        magicpages["magicpages<br/>Temporary Pages"]
        institucion["institucion<br/>Institution Data"]
    end
    
    subgraph "Financial Domain Models"
        conceptos["conceptos<br/>Financial Concepts"]
        cuentas["cuentas<br/>Accounts"]
        transacciones["transacciones<br/>Transactions"]
    end
    
    Singleton --> Clsdatos
    Clsdatos --> userselecto
    Clsdatos --> perfilselecto
    Clsdatos --> estadoselecto
    Clsdatos --> extusers
    Clsdatos --> docsestados
    Clsdatos --> adjuntosflujos
    Clsdatos --> plantillas
    Clsdatos --> firmas
    Clsdatos --> apibox
    Clsdatos --> codigoactiva
    Clsdatos --> magicpages
    Clsdatos --> institucion
    Clsdatos --> conceptos
    Clsdatos --> cuentas
    Clsdatos --> transacciones
```

**Sources:** [src/datos/Clsdatos.php:9](), [index.php:9-11](), [home.php:9-11]()

---

## Dynamic Model Loading

Models are loaded automatically during application bootstrap using the `Utiles::IncluirArchivos()` utility function, which includes all PHP files from the `src/modelo/` directory.

### Loading Sequence Diagram

```mermaid
sequenceDiagram
    participant Entry as index.php/home.php
    participant Utiles as Utiles Class
    participant FileSystem as File System
    participant PHP as PHP Interpreter
    
    Entry->>Entry: "Load Singleton"
    Entry->>Entry: "Load Clsdatos"
    Entry->>Utiles: "IncluirArchivos('src/modelo')"
    Utiles->>FileSystem: "Scan Directory"
    FileSystem-->>Utiles: "List of .php Files"
    
    loop For Each PHP File
        Utiles->>PHP: "include_once(file)"
        PHP->>PHP: "Parse & Register Class"
    end
    
    Utiles-->>Entry: "All Models Loaded"
    Entry->>Entry: "Continue Bootstrap"
```

**Loading Implementation:**
- Entry points call `Utiles::IncluirArchivos()` at [index.php:11]() and [home.php:11]()
- All files in `src/modelo/` are included automatically
- Models become available for instantiation throughout the application

**Sources:** [index.php:11](), [home.php:11]()

---

## Naming Conventions

The system follows strict naming conventions that map PHP class names to MySQL table names and class methods to database columns.

### Convention Rules

| Convention Type | Rule | Example |
|----------------|------|---------|
| **Class Name** | Lowercase, matches table name exactly | Class `userselecto` → Table `userselecto` |
| **Table Name** | Lowercase, no prefix | Table `apibox` |
| **Property Getters** | `get` + Capitalized field name | `getId()`, `getNombre()`, `getFechaCreacion()` |
| **Property Setters** | `set` + Capitalized field name | `setId()`, `setNombre()`, `setFechaCreacion()` |
| **Column Names** | Lowercase, snake_case in database | `fecha_creacion` → `getFechaCreacion()` |

### Table-to-Model Mapping

```mermaid
graph LR
    subgraph "Database Layer"
        T1["Table: userselecto"]
        T2["Table: apibox"]
        T3["Table: docsestados"]
    end
    
    subgraph "Model Layer"
        M1["Class: userselecto"]
        M2["Class: apibox"]
        M3["Class: docsestados"]
    end
    
    subgraph "Field Mapping"
        F1["Column: id<br/>Column: nombre<br/>Column: fecha_creacion"]
        F2["Method: getId()<br/>Method: getNombre()<br/>Method: getFechaCreacion()"]
    end
    
    T1 -.->|"Convention"| M1
    T2 -.->|"Convention"| M2
    T3 -.->|"Convention"| M3
    M1 --> F1
    F1 --> F2
```

**Name Transformation:**
The `Singleton::toCap()` method converts database field names to method names by capitalizing the first letter. For example:
- `nombre` becomes `setNombre()` and `getNombre()`
- `fecha_creacion` becomes `setFechaCreacion()` and `getFechaCreacion()`

**Sources:** [src/datos/Clsdatos.php:120, 173, 236, 287, 365]()

---

## Base Class Functionality

All models inherit from `Clsdatos`, which provides standard CRUD operations and dynamic method calling. Models do not need to implement getter/setter methods explicitly; they are handled dynamically.

### Inherited Methods

| Method | Purpose | Return Type | Implementation |
|--------|---------|-------------|----------------|
| `readInfoById()` | Fetch single record by ID | Object instance | [Clsdatos.php:88-138]() |
| `readInfo($fields, $filter)` | Fetch multiple records | Array of objects | [Clsdatos.php:146-200]() |
| `saveData()` | Insert new record | Integer (new ID) | [Clsdatos.php:272-333]() |
| `updateData()` | Update existing record | Integer (affected rows) | [Clsdatos.php:339-423]() |
| `deleteById()` | Delete by ID | Integer (affected rows) | [Clsdatos.php:34-61]() |
| `deleteByField($field, $value)` | Delete by field | Integer (affected rows) | [Clsdatos.php:67-82]() |
| `saveDataFromPost($entities)` | Bulk save from POST | Array of IDs | [Clsdatos.php:208-266]() |

### Dynamic Property Access

Models use PHP's magic methods to dynamically handle getter and setter calls without explicit method declarations.

```mermaid
graph TB
    subgraph "Model Instance"
        Model["userselecto Instance"]
    end
    
    subgraph "Dynamic Method Calls"
        GetId["getId()"]
        SetId["setId(123)"]
        GetNombre["getNombre()"]
        SetNombre["setNombre('John')"]
    end
    
    subgraph "Clsdatos Implementation"
        Metadata["_metaDatos()<br/>Fetch Table Schema"]
        ToCap["toCap()<br/>Capitalize Field Names"]
        Setter["Internal Property Storage"]
    end
    
    Model --> GetId
    Model --> SetId
    Model --> GetNombre
    Model --> SetNombre
    
    GetId --> Metadata
    SetId --> Setter
    GetNombre --> Metadata
    SetNombre --> Setter
    
    Metadata --> ToCap
```

**Usage Example:**
When `readInfoById()` is called at [Clsdatos.php:117-123](), it dynamically calls setter methods for each database column:
```
$o->{"set" . Singleton::toCap($key)}($val);
```

**Sources:** [src/datos/Clsdatos.php:120, 173, 236, 287, 365]()

---

## Model Categories

Models are organized into functional domains based on their business purpose.

### User Domain Models

| Model Class | Table | Purpose |
|-------------|-------|---------|
| `userselecto` | `userselecto` | Primary user authentication and selection |
| `perfilselecto` | `perfilselecto` | User profile and preferences |
| `estadoselecto` | `estadoselecto` | User state and status tracking |
| `extusers` | `extusers` | External/LDAP integrated users |

**User models support authentication flows documented in [Authentication System](#10.1).**

### Document Domain Models

| Model Class | Table | Purpose |
|-------------|-------|---------|
| `docsestados` | `docsestados` | Document workflow states |
| `adjuntosflujos` | `adjuntosflujos` | Workflow attachment management |
| `plantillas` | `plantillas` | Document templates |
| `firmas` | `firmas` | Digital signature storage |

**Document models are used extensively in [Document and Workflow APIs](#9.4).**

### System Domain Models

| Model Class | Table | Purpose |
|-------------|-------|---------|
| `apibox` | `apibox` | API token storage and management |
| `codigoactiva` | `codigoactiva` | Temporary activation codes |
| `magicpages` | `magicpages` | Temporary secure page generation |
| `institucion` | `institucion` | Institution/organization data |

**System models support infrastructure services like [ApiboxLib](#8.1) and [MagicPagesLib](#8.2).**

### Financial Domain Models

| Model Class | Table | Purpose |
|-------------|-------|---------|
| `conceptos` | `conceptos` | Financial concepts and categories |
| `cuentas` | `cuentas` | Account management |
| `transacciones` | `transacciones` | Financial transaction records |

**Financial models implement the core business logic of GESFINANCIERO's financial management features.**

**Sources:** Based on system architecture diagrams and inferred from database naming conventions.

---

## Model Lifecycle

Understanding how model instances are created, populated, persisted, and destroyed is essential for working with the data layer.

### CRUD Operation Flow

```mermaid
sequenceDiagram
    participant Controller as Controller/Operation
    participant Model as Model Instance
    participant Clsdatos as Clsdatos Base
    participant Singleton as Singleton Connection
    participant DB as MySQL Database
    
    rect rgb(240, 240, 240)
        note right of Controller: CREATE Operation
        Controller->>Model: "new userselecto()"
        Controller->>Model: "setNombre('John')"
        Controller->>Model: "setEmail('john@example.com')"
        Controller->>Model: "saveData()"
        Model->>Clsdatos: "saveData()"
        Clsdatos->>Singleton: "_metaDatos()"
        Singleton-->>Clsdatos: "Table Schema"
        Clsdatos->>Clsdatos: "Build INSERT Query"
        Clsdatos->>Singleton: "prepare() & execute()"
        Singleton->>DB: "INSERT INTO userselecto..."
        DB-->>Singleton: "insert_id"
        Singleton-->>Clsdatos: "New ID"
        Clsdatos-->>Model: "Return ID"
        Model-->>Controller: "Record ID"
    end
    
    rect rgb(240, 240, 240)
        note right of Controller: READ Operation
        Controller->>Model: "new userselecto()"
        Controller->>Model: "setId(123)"
        Controller->>Model: "readInfoById()"
        Model->>Clsdatos: "readInfoById()"
        Clsdatos->>Singleton: "prepare('SELECT * FROM userselecto WHERE id = ?')"
        Singleton->>DB: "Execute Query"
        DB-->>Singleton: "Result Set"
        Singleton-->>Clsdatos: "Row Data"
        Clsdatos->>Clsdatos: "Populate Object Properties"
        Clsdatos-->>Model: "Hydrated Object"
        Model-->>Controller: "User Data"
    end
    
    rect rgb(240, 240, 240)
        note right of Controller: UPDATE Operation
        Controller->>Model: "setNombre('Jane')"
        Controller->>Model: "updateData()"
        Model->>Clsdatos: "updateData()"
        Clsdatos->>Clsdatos: "Build UPDATE Query"
        Clsdatos->>Singleton: "prepare() & execute()"
        Singleton->>DB: "UPDATE userselecto SET..."
        DB-->>Singleton: "affected_rows"
        Singleton-->>Clsdatos: "Rows Affected"
        Clsdatos-->>Model: "Affected Count"
        Model-->>Controller: "Success/Failure"
    end
    
    rect rgb(240, 240, 240)
        note right of Controller: DELETE Operation
        Controller->>Model: "deleteById()"
        Model->>Clsdatos: "deleteById()"
        Clsdatos->>Singleton: "prepare('DELETE FROM userselecto WHERE id = ?')"
        Singleton->>DB: "Execute Query"
        DB-->>Singleton: "affected_rows"
        Singleton-->>Clsdatos: "Rows Affected"
        Clsdatos-->>Model: "Delete Count"
        Model-->>Controller: "Success/Failure"
    end
```

**Sources:** [src/datos/Clsdatos.php:88-138, 146-200, 272-333, 339-423, 34-61]()

---

## Model Usage Patterns

### Pattern 1: Single Record Retrieval

```
// Create instance and set ID
$user = new userselecto();
$user->setId(123);

// Load from database
$user->readInfoById();

// Access properties
$name = $user->getNombre();
$email = $user->getEmail();
```

**Implementation:** [Clsdatos.php:88-138]()

### Pattern 2: Collection Retrieval with Filtering

```
// Create instance
$users = new userselecto();

// Fetch with filters
$results = $users->readInfo("*", "WHERE activo = 1 ORDER BY nombre");

// Iterate results
foreach ($results as $user) {
    echo $user->getNombre();
}
```

**Implementation:** [Clsdatos.php:146-200]()

### Pattern 3: Creating New Records

```
// Create and populate instance
$user = new userselecto();
$user->setNombre("John Doe");
$user->setEmail("john@example.com");
$user->setActivo(1);

// Save to database
$newId = $user->saveData();
```

**Implementation:** [Clsdatos.php:272-333]()

### Pattern 4: Updating Existing Records

```
// Load existing record
$user = new userselecto();
$user->setId(123);
$user->readInfoById();

// Modify properties
$user->setNombre("Jane Doe");
$user->setEmail("jane@example.com");

// Persist changes
$affectedRows = $user->updateData();
```

**Implementation:** [Clsdatos.php:339-423]()

### Pattern 5: Bulk Operations from POST Data

```
// Process form submission with multiple records
$user = new userselecto();
$savedIds = $user->saveDataFromPost(true); // true = htmlentities encoding

// Returns array of IDs for successfully saved records
foreach ($savedIds as $id) {
    // Process each saved record
}
```

**Implementation:** [Clsdatos.php:208-266]()

**Sources:** [src/datos/Clsdatos.php:34-423]()

---

## Error Handling

Models provide error tracking through inherited methods from `Clsdatos`.

### Error Management Methods

| Method | Purpose | Usage |
|--------|---------|-------|
| `obtenerError()` | Retrieve last database error | Returns MySQL error string |
| `limpiarError()` | Clear error state | Resets error message to null |

**Error Detection Pattern:**
Operations return `-1` to indicate failure and set `$this->mensaje_error` to the MySQL error message.

```mermaid
graph TB
    Operation["Model Operation<br/>saveData(), updateData(), etc."]
    CheckResult["Check Return Value"]
    Success["Return Value > 0"]
    Failure["Return Value = -1"]
    GetError["obtenerError()"]
    ErrorMsg["MySQL Error Message"]
    
    Operation --> CheckResult
    CheckResult --> Success
    CheckResult --> Failure
    Failure --> GetError
    GetError --> ErrorMsg
```

**Example Error Handling:**
```
$user = new userselecto();
$result = $user->saveData();

if ($result === -1) {
    $error = $user->obtenerError();
    // Handle error condition
}
```

**Sources:** [src/datos/Clsdatos.php:11-28, 55, 78, 126, 192, 292, 309, 323, 374, 408]()

---

## Query Building and Execution

The base `Clsdatos` class uses prepared statements for all database operations, providing SQL injection protection.

### Query Construction Flow

```mermaid
graph TB
    Start["Model Method Called"]
    GetMeta["Fetch Table Metadata<br/>_metaDatos()"]
    BuildSQL["Construct SQL String<br/>with Placeholders"]
    Prepare["Prepare Statement<br/>mysqli::prepare()"]
    BindParams["Bind Parameters<br/>bind_param()"]
    Execute["Execute Statement"]
    ProcessResults["Process Results"]
    CloseStmt["Close Statement"]
    
    Start --> GetMeta
    GetMeta --> BuildSQL
    BuildSQL --> Prepare
    Prepare --> BindParams
    BindParams --> Execute
    Execute --> ProcessResults
    ProcessResults --> CloseStmt
```

**Prepared Statement Usage:**

**INSERT Operations:** [Clsdatos.php:305-328]()
- Builds placeholders: `('?', '?', '?')`
- Binds all values as strings: `str_repeat('s', count($params))`
- Returns `insert_id` on success

**UPDATE Operations:** [Clsdatos.php:389-414]()
- Builds SET clause: `field1=?, field2=?`
- Binds values as strings with ID as integer: `str_repeat('s', count($params)-1) . "i"`
- Returns `affected_rows` on success

**SELECT Operations:** [Clsdatos.php:106-124, 159-189]()
- Uses `result_metadata()` to fetch column information
- Dynamically binds result columns
- Populates model instances with fetched data

**DELETE Operations:** [Clsdatos.php:47-53, 71-75]()
- Simple WHERE clause with ID or field
- Returns `affected_rows` on success

**Sources:** [src/datos/Clsdatos.php:47-414]()

---

## Model Extension and Customization

While most models use the base `Clsdatos` functionality without modification, models can override methods or add custom business logic.

### Extension Pattern

```mermaid
graph TB
    Base["Clsdatos<br/>Base CRUD Methods"]
    Model["Custom Model<br/>e.g., userselecto"]
    
    subgraph "Inherited Methods"
        CRUD["readInfo()<br/>saveData()<br/>updateData()<br/>deleteById()"]
    end
    
    subgraph "Custom Methods"
        Custom["authenticateUser()<br/>generateToken()<br/>sendActivation()"]
    end
    
    Base --> Model
    Base --> CRUD
    Model --> Custom
    CRUD -.->|"Available to"| Custom
```

**Custom Model Example Structure:**
```
class userselecto extends Clsdatos {
    // Inherited: all CRUD operations
    
    // Custom method example
    public function validateCredentials($password) {
        // Custom business logic
        $stored = $this->getPassword();
        return password_verify($password, $stored);
    }
    
    // Custom query example
    public function findByEmail($email) {
        return $this->readInfo("*", "WHERE email = '" . $email . "'");
    }
}
```

**Note:** Custom models would be located in `src/modelo/` and loaded automatically during bootstrap.

**Sources:** [src/datos/Clsdatos.php:9](), [index.php:11]()

---

## Model-Controller Integration

Models are instantiated and used throughout the controller and business logic layers to perform data operations.

### Integration Points

```mermaid
graph TB
    subgraph "Controller Layer"
        IndexCtrl["IndexCtrl"]
        HomeCtrl["HomeCtrl"]
    end
    
    subgraph "Business Logic Layer"
        OpCtrl["OperacionesCtrl"]
        OpHomeCtrl["OperacionesHomeCtrl"]
    end
    
    subgraph "Model Layer"
        Models["Model Instances<br/>userselecto, apibox, etc."]
    end
    
    subgraph "Database"
        DB["MySQL<br/>nuevapp_apps"]
    end
    
    IndexCtrl --> OpCtrl
    HomeCtrl --> OpHomeCtrl
    OpCtrl --> Models
    OpHomeCtrl --> Models
    Models --> DB
```

**Controller Usage Pattern:**

Controllers instantiate models as needed:
```
// In OperacionesCtrl or similar
public function usuarios_Agregar() {
    $user = new userselecto();
    $user->setNombre($_POST['nombre']);
    $user->setEmail($_POST['email']);
    
    $id = $user->saveData();
    if ($id > 0) {
        return ["success" => true, "id" => $id];
    } else {
        return ["success" => false, "error" => $user->obtenerError()];
    }
}
```

**Sources:** [src/datos/Clsdatos.php:1-425](), system architecture diagrams

---

## Model Conventions Summary

### Table Reference

| Convention | Rule | Example |
|-----------|------|---------|
| **File Location** | `src/modelo/*.php` | `src/modelo/userselecto.php` |
| **Class Name** | Lowercase, matches table | `class userselecto` |
| **Table Name** | Lowercase | `userselecto` |
| **Extends** | Always extends `Clsdatos` | `class userselecto extends Clsdatos` |
| **Primary Key** | Always named `id` | `getId()`, `setId()` |
| **Field Access** | Camel case methods | `fecha_creacion` → `getFechaCreacion()` |
| **Auto-loading** | Automatic via `Utiles::IncluirArchivos()` | No manual require needed |

**Sources:** [src/datos/Clsdatos.php:9](), [index.php:11](), [home.php:11]()

---

---

## 6. Configuration and Infrastructure

## Purpose and Scope

This document describes the configuration and infrastructure components of the GESFINANCIERO system. It covers how system-wide settings are managed, database and SMTP credentials are stored, static data resources are structured, and the infrastructure requirements for deployment.

For detailed documentation of the `Corporation` configuration class and its constants, see [System Configuration (Corporation.php)](#6.1). For information about static data resources like `data.json`, see [Static Data Resources](#6.2).

## Overview

GESFINANCIERO uses a centralized configuration approach where system-wide constants and credentials are defined in the `Corporation` class. This configuration pattern provides a single source of truth for database connections, SMTP settings, and application-level constants. The system also maintains static data resources in JSON format for reference data that drives UI components and application logic.

The infrastructure requirements are straightforward: a PHP 7.4+ runtime, MySQL database server, and Apache/Nginx web server. The system integrates with external services including an SMTP mail server and optionally an LDAP directory for corporate authentication.

## Configuration Architecture

### Configuration Class Structure

```mermaid
graph TB
    subgraph "Configuration Layer"
        CORP["Corporation Class<br/>repo/corp/Corporation.php"]
        
        subgraph "Configuration Constants"
            DB_CONFIG["Database Configuration<br/>HOST, DBUSER, DBPASS, DBNAME"]
            SMTP_CONFIG["SMTP Configuration<br/>MAIL_HOST, MAIL_PORT<br/>MAIL_USERNAME, MAIL_PASSWORD"]
            APP_CONFIG["Application Configuration<br/>CONFIG, MAIL_SUBJECT<br/>MAIL_REMITENTE"]
        end
    end
    
    subgraph "Consumers"
        SINGLETON["Singleton Class<br/>src/core/Singleton.php<br/>Database Connection"]
        PHPMAILER["PHPMailer Integration<br/>src/libs/PHPMailer-61/<br/>Email Sending"]
        OPERATIONS["OperacionesCtrl<br/>OperacionesHomeCtrl<br/>Business Logic"]
    end
    
    subgraph "External Infrastructure"
        MYSQL["MySQL Database<br/>nuevapp_apps"]
        SMTP["SMTP Server<br/>smtp.ipage.com:25"]
    end
    
    CORP --> DB_CONFIG
    CORP --> SMTP_CONFIG
    CORP --> APP_CONFIG
    
    DB_CONFIG --> SINGLETON
    SMTP_CONFIG --> PHPMAILER
    
    SINGLETON --> MYSQL
    PHPMAILER --> SMTP
    
    OPERATIONS --> SINGLETON
    OPERATIONS --> PHPMAILER
```

**Diagram: Configuration Flow from Corporation Class to Infrastructure**

The `Corporation` class acts as the configuration registry for the entire application. It defines class constants that are accessed statically throughout the codebase without requiring instantiation.

Sources: [repo/corp/Corporation.php:1-23]()

### Configuration Constants Reference

| Constant Name | Type | Purpose | Default Value |
|---------------|------|---------|---------------|
| `CONFIG` | boolean | Global configuration flag | `false` |
| `HOST` | string | Database host | `'db'` |
| `DBUSER` | string | Database username | `'rootapps'` |
| `DBPASS` | string | Database password | `'rootapps'` |
| `DBNAME` | string | Database name | `'nuevapp_apps'` |
| `MAIL_HOST` | string | SMTP server hostname | `'smtp.ipage.com'` |
| `MAIL_PORT` | integer | SMTP port | `25` |
| `MAIL_USERNAME` | string | SMTP authentication username | `'admin@nuevapp.com'` |
| `MAIL_PASSWORD` | string | SMTP authentication password | `'73cn0l0g1@Info.'` |
| `MAIL_SMTPAUTHE` | boolean | Enable SMTP authentication | `true` |
| `MAIL_SMTPSECURE` | string | SMTP security protocol | `""` (empty) |
| `MAIL_REMITENTE` | string | Default sender email | `'admin@nuevapp.com'` |
| `MAIL_LABEL_REMITENTE` | string | Default sender name | `'Nuevapp Notify'` |
| `MAIL_SUBJECT` | string | Default email subject | `""` (empty) |

Sources: [repo/corp/Corporation.php:4-22]()

### Configuration Access Pattern

The `Corporation` constants are accessed statically throughout the application:

```php
// Database configuration accessed by Singleton
$host = Corporation::HOST;
$user = Corporation::DBUSER;
$pass = Corporation::DBPASS;
$dbname = Corporation::DBNAME;

// SMTP configuration accessed by PHPMailer integration
$mail->Host = Corporation::MAIL_HOST;
$mail->Port = Corporation::MAIL_PORT;
$mail->Username = Corporation::MAIL_USERNAME;
$mail->Password = Corporation::MAIL_PASSWORD;
```

This pattern provides centralized configuration but has the critical drawback of hardcoding credentials in version-controlled source code.

Sources: [repo/corp/Corporation.php:17-20](), [repo/corp/Corporation.php:6-14]()

## Infrastructure Components

### System Infrastructure Topology

```mermaid
graph TB
    subgraph "Web Server Tier"
        APACHE["Apache/Nginx<br/>HTTP Server"]
        PHP["PHP 7.4+ Runtime<br/>FPM/mod_php"]
    end
    
    subgraph "Application Tier"
        INDEX["index.php<br/>Main Entry Point"]
        HOME["home.php<br/>Public Entry Point"]
        CONTROLLERS["Controller Layer<br/>IndexCtrl, HomeCtrl"]
        OPERATIONS["Business Logic<br/>OperacionesCtrl"]
    end
    
    subgraph "Data Tier"
        SINGLETON["Singleton<br/>Connection Manager"]
        MYSQL["MySQL Server<br/>Database: nuevapp_apps"]
    end
    
    subgraph "External Services"
        SMTP_SRV["SMTP Server<br/>smtp.ipage.com:25<br/>Unencrypted"]
        LDAP_SRV["LDAP Directory<br/>Corporate Authentication<br/>Optional"]
    end
    
    subgraph "File System"
        REPO["repo/ Modules<br/>Runtime Data Storage"]
        SRC["src/ Application Code<br/>Controllers, Models, Libs"]
    end
    
    APACHE --> PHP
    PHP --> INDEX
    PHP --> HOME
    
    INDEX --> CONTROLLERS
    HOME --> CONTROLLERS
    CONTROLLERS --> OPERATIONS
    
    OPERATIONS --> SINGLETON
    SINGLETON --> MYSQL
    
    OPERATIONS --> SMTP_SRV
    OPERATIONS --> LDAP_SRV
    
    OPERATIONS --> REPO
    CONTROLLERS --> SRC
```

**Diagram: Infrastructure Component Topology**

Sources: [README.md:19-28](), [repo/corp/Corporation.php:6-20]()

### Technology Stack

The infrastructure requirements are documented in the project README:

| Component | Technology | Version |
|-----------|-----------|---------|
| Backend Language | PHP | 7.4+ |
| Database | MySQL | Not specified |
| Web Server | Apache or Nginx | Not specified |
| Frontend | Bootstrap, JavaScript, HTML5, CSS3 | Bootstrap 5+ |
| Version Control | Git + GitHub | - |

Sources: [README.md:19-28]()

### Database Configuration

The database configuration uses a containerized approach, as indicated by the `HOST` constant value of `'db'`:

- **Host**: `db` (Docker container name or localhost alias)
- **Database Name**: `nuevapp_apps`
- **Username**: `rootapps`
- **Password**: `rootapps`
- **Connection Type**: MySQL TCP connection via `Singleton` class

The `Singleton` class reads these constants to establish database connections. Connection pooling is handled through PHP's persistent connection feature, though the exact implementation depends on the `Singleton` configuration.

Sources: [repo/corp/Corporation.php:17-20]()

### SMTP Configuration

The email infrastructure uses an external SMTP relay:

- **SMTP Server**: `smtp.ipage.com`
- **Port**: 25 (unencrypted)
- **Authentication**: Enabled (`MAIL_SMTPAUTHE = true`)
- **Security**: None (`MAIL_SMTPSECURE = ""`)
- **Credentials**: Stored in `Corporation` constants

**Security Concern**: The SMTP configuration uses port 25 without TLS/SSL encryption, meaning email credentials and message contents are transmitted in cleartext. This is a significant security vulnerability.

Sources: [repo/corp/Corporation.php:6-14]()

## Static Data Resources

### Data Structure and Purpose

The system maintains static data resources in JSON format, primarily located in `src/data.json`. This file contains structured reference data used by the application.

```mermaid
graph LR
    DATA_FILE["src/data.json<br/>Static Reference Data"]
    
    subgraph "Data Structure"
        LIST_ITEMS["Array of Objects<br/>id, txt properties"]
    end
    
    subgraph "Consumers"
        UI["UI Components<br/>Dropdowns, Lists"]
        CONTROLLERS["Controllers<br/>Data Validation"]
        FORMS["Form Generation<br/>Dynamic Options"]
    end
    
    DATA_FILE --> LIST_ITEMS
    LIST_ITEMS --> UI
    LIST_ITEMS --> CONTROLLERS
    LIST_ITEMS --> FORMS
```

**Diagram: Static Data Resource Flow**

### Data.json Structure

The `data.json` file contains an array of objects representing educational grade levels:

```json
[
  {"id":"list-1-list","txt":"Prejardín Inicial"},
  {"id":"list-0-list","txt":"Transición A"},
  {"id":"list-2-list","txt":"Primero A"},
  {"id":"list-6-list","txt":"Cuarto A"},
  {"id":"list-9-list","txt":"Jardín A"},
  {"id":"list-8-list","txt":"Prejardín A"},
  {"id":"list-7-list","txt":"Quinto A"},
  {"id":"list-3-list","txt":"Primero B"},
  {"id":"list-5-list","txt":"Tercero A"},
  {"id":"list-4-list","txt":"Segundo A"}
]
```

Each object contains:
- **id**: Unique identifier with format `list-{number}-list`
- **txt**: Display text (Spanish educational grade level names)

This data appears to support an educational institution context, specifically the Jardín Botánico (Botanical Garden) mentioned in the repository name.

Sources: [src/data.json:1-1]()

## Configuration Data Flow

### Bootstrap and Configuration Loading

```mermaid
sequenceDiagram
    participant Entry as "index.php/home.php"
    participant Bootstrap as "Bootstrap Process"
    participant Corp as "Corporation Class"
    participant Singleton as "Singleton Class"
    participant DB as "MySQL Database"
    
    Entry->>Bootstrap: "Initialize Application"
    Bootstrap->>Bootstrap: "Load Dependencies"
    Bootstrap->>Corp: "Load Corporation.php"
    
    Note over Corp: "Class constants defined<br/>at parse time"
    
    Bootstrap->>Singleton: "First database access"
    Singleton->>Corp: "Read Corporation::HOST"
    Singleton->>Corp: "Read Corporation::DBUSER"
    Singleton->>Corp: "Read Corporation::DBPASS"
    Singleton->>Corp: "Read Corporation::DBNAME"
    
    Singleton->>Singleton: "Create mysqli connection"
    Singleton->>DB: "Connect to nuevapp_apps"
    DB-->>Singleton: "Connection established"
    
    Singleton-->>Bootstrap: "Database ready"
    Bootstrap-->>Entry: "Application initialized"
```

**Diagram: Configuration Loading Sequence**

The configuration is loaded during the application bootstrap process. The `Corporation` class is included early in the execution flow, and its constants are available immediately through static access. The `Singleton` class reads these constants on first instantiation to establish database connectivity.

Sources: [repo/corp/Corporation.php:1-23]()

## Deployment Considerations

### Environment Setup Requirements

To deploy GESFINANCIERO, the following infrastructure components must be configured:

1. **Web Server**: Apache 2.4+ or Nginx with PHP-FPM support
2. **PHP Runtime**: PHP 7.4 or higher with extensions:
   - `mysqli` for database connectivity
   - `openssl` for encryption and token generation
   - `ldap` for LDAP authentication (optional)
   - `gd` or `imagick` for image processing
   - `mbstring` for multi-byte string handling

3. **Database Server**: MySQL 5.7+ or MariaDB 10.3+
   - Database: `nuevapp_apps`
   - Character set: UTF-8 recommended
   - Timezone: Should match PHP timezone configuration

4. **SMTP Access**: Outbound SMTP connectivity to mail server
   - Port 25 must be accessible for email functionality
   - Authentication credentials configured in `Corporation` class

5. **File System Permissions**:
   - `repo/` directories must be writable for runtime data storage
   - `src/` directories require read access only
   - Upload directories need appropriate write permissions

### Docker Containerization

The use of `HOST = 'db'` in the configuration suggests Docker containerization support. In a Docker Compose setup:

- The PHP application container connects to a `db` service container
- Database credentials use simple values suitable for development
- Production deployments should override these via environment variables

### Configuration Security Issues

**Critical Security Concerns**:

1. **Hardcoded Credentials**: Database and SMTP credentials are committed to version control in [repo/corp/Corporation.php:8-10]() and [repo/corp/Corporation.php:17-20]()

2. **Unencrypted SMTP**: Email transmission uses port 25 without TLS/SSL encryption [repo/corp/Corporation.php:7-11]()

3. **Weak Database Credentials**: The password `'rootapps'` is a weak credential for database access [repo/corp/Corporation.php:19]()

**Recommended Security Improvements**:

1. **Externalize Configuration**: Move credentials to environment variables:
   ```php
   const HOST = getenv('DB_HOST') ?: 'localhost';
   const DBUSER = getenv('DB_USER') ?: 'user';
   const DBPASS = getenv('DB_PASS') ?: 'pass';
   ```

2. **Use Encrypted SMTP**: Configure TLS/SSL on port 587 or 465:
   ```php
   const MAIL_PORT = 587;
   const MAIL_SMTPSECURE = 'tls';
   ```

3. **Implement .env Files**: Use a library like `vlucas/phpdotenv` to load configuration from `.env` files that are excluded from version control

4. **Strong Credentials**: Use complex, randomly-generated passwords for all services

## Module-Level Configuration

Individual modules in the `repo/` directory may contain their own configuration or initialization logic in their `index.php` entry points. However, all modules share access to the centralized `Corporation` configuration through PHP's autoloading and include mechanisms.

The `repo/corp/` module is special because it houses the `Corporation` class itself, making it the source of system-wide configuration.

For detailed information about individual module configurations, see [Module System](#7).

---

**Related Pages**:
- [System Configuration (Corporation.php)](#6.1) - Detailed documentation of all configuration constants
- [Static Data Resources](#6.2) - In-depth coverage of JSON data files and their structure
- [Singleton - Database Connection Manager](#5.1) - How configuration is consumed for database connectivity
- [Email System (PHPMailer)](#8.3) - How SMTP configuration is used for email sending
- [Environment Configuration](#11.1) - Deployment-specific configuration guidance
- [Security Hardening](#11.2) - Security recommendations for production deployments

Sources: [repo/corp/Corporation.php:1-23](), [src/data.json:1-1](), [README.md:19-28]()

---

---

## 6.1 System Configuration (Corporation.php)

The `Corporation` class centralizes all system-wide configuration constants including database credentials, SMTP server settings, and email defaults. This class acts as the single source of truth for infrastructure configuration across the entire GESFINANCIERO application.

**Scope:** This document covers the `Corporation` configuration class, its constants, and how they are consumed throughout the system. For database connection management that uses these credentials, see [Singleton - Database Connection Manager](#5.1). For email functionality that uses the SMTP configuration, see [Email System (PHPMailer)](#8.3).

## File Location and Structure

The `Corporation` class is located at [repo/corp/Corporation.php:1-22]() and contains only constant declarations with no methods or instantiation logic. The file's location within the `repo/corp/` module directory follows the repository module architecture described in [Repository Structure](#1.2).

**File Path:** `repo/corp/Corporation.php`

**Class Structure:**
```
Corporation (static class)
├── CONFIG constant
├── Email/SMTP constants (7 constants)
└── Database constants (4 constants)
```

Sources: [repo/corp/Corporation.php:1-22]()

## Configuration Constants

### Database Configuration

The following constants define the MySQL database connection parameters:

| Constant | Value | Purpose |
|----------|-------|---------|
| `HOST` | `'db'` | Database host (Docker service name) |
| `DBUSER` | `'rootapps'` | Database username |
| `DBPASS` | `'rootapps'` | Database password |
| `DBNAME` | `'nuevapp_apps'` | Database schema name |

Sources: [repo/corp/Corporation.php:17-20]()

### Email and SMTP Configuration

The following constants configure the email sending infrastructure via PHPMailer:

| Constant | Value | Purpose |
|----------|-------|---------|
| `MAIL_SMTPAUTHE` | `true` | Enable SMTP authentication |
| `MAIL_PORT` | `25` | SMTP server port |
| `MAIL_HOST` | `'smtp.ipage.com'` | SMTP server hostname |
| `MAIL_USERNAME` | `'admin@nuevapp.com'` | SMTP authentication username |
| `MAIL_PASSWORD` | `'73cn0l0g1@Info.'` | SMTP authentication password |
| `MAIL_SMTPSECURE` | `''` | SMTP encryption (empty = no TLS/SSL) |
| `MAIL_REMITENTE` | `'admin@nuevapp.com'` | Default sender email address |
| `MAIL_LABEL_REMITENTE` | `'Nuevapp Notify'` | Default sender display name |
| `MAIL_SUBJECT` | `''` | Default email subject (empty) |

Sources: [repo/corp/Corporation.php:6-15]()

### General Configuration

| Constant | Value | Purpose |
|----------|-------|---------|
| `CONFIG` | `false` | General configuration flag (purpose unclear) |

Sources: [repo/corp/Corporation.php:4]()

## System Integration

The `Corporation` class is consumed by multiple layers of the application, primarily the data layer and email services.

### Database Configuration Flow

```mermaid
graph TB
    CORP["Corporation class<br/>repo/corp/Corporation.php"]
    
    SING_CONST["Singleton::__construct()<br/>src/datos/Singleton.php:24-42"]
    SING_DT["Singleton::_dataTable()<br/>src/datos/Singleton.php:526-592"]
    SING_MOD["Singleton::_modelos()<br/>src/datos/Singleton.php:390-491"]
    
    MYSQLI["mysqli connection<br/>self::$lnk"]
    SSP["SSP DataTables class<br/>src/libs/datatable/ssp.class.php"]
    
    SING_CONST -->|"includes at line 26"| CORP
    SING_DT -->|"includes at line 573"| CORP
    SING_MOD -->|"includes at line 391"| CORP
    
    CORP -->|"HOST constant"| SING_CONST
    CORP -->|"DBUSER constant"| SING_CONST
    CORP -->|"DBPASS constant"| SING_CONST
    CORP -->|"DBNAME constant"| SING_CONST
    
    SING_CONST -->|"creates connection"| MYSQLI
    
    CORP -->|"credentials array"| SING_DT
    SING_DT -->|"sql_details"| SSP
```

**Corporation Loading Pattern in Singleton:**

The `Singleton` class dynamically includes `Corporation.php` at three distinct locations:

1. **Constructor ([src/datos/Singleton.php:26]()):** Loads when establishing the initial database connection
2. **DataTable method ([src/datos/Singleton.php:573]()):** Loads when building SQL details for SSP DataTables integration
3. **Model generator ([src/datos/Singleton.php:391]()):** Loads when generating model classes from database schema

The inclusion path is constructed dynamically:
```php
include_once dirname(dirname(dirname( __FILE__ ))) . 
    DIRECTORY_SEPARATOR . "repo" . 
    DIRECTORY_SEPARATOR . "corp" . 
    DIRECTORY_SEPARATOR . "Corporation.php";
```

Sources: [src/datos/Singleton.php:26](), [src/datos/Singleton.php:573](), [src/datos/Singleton.php:391]()

### Database Connection Instantiation

```mermaid
sequenceDiagram
    participant App as "Application Code"
    participant Sing as "Singleton::__construct()"
    participant Corp as "Corporation constants"
    participant MySQLi as "mysqli instance"
    
    App->>Sing: new Singleton()
    
    alt "Connection doesn't exist (self::$lnk is null)"
        Sing->>Sing: include_once Corporation.php
        Sing->>Corp: Read Corporation::HOST
        Sing->>Corp: Read Corporation::DBUSER
        Sing->>Corp: Read Corporation::DBPASS
        Sing->>Corp: Read Corporation::DBNAME
        
        Sing->>MySQLi: new mysqli($_host, $_uname, $_pass, $_db)
        
        alt "Connection successful"
            MySQLi-->>Sing: connection object
            Sing->>Sing: Store in self::$lnk
            Sing-->>App: return self::$lnk
        else "Connection failed"
            MySQLi-->>Sing: connect_errno
            Sing->>Sing: echo error message
        end
    else "Connection already exists"
        Sing-->>App: return self::$lnk
    end
```

The constructor uses the Corporation constants with fallback logic: if custom parameters are provided to the constructor, they override the Corporation defaults. However, the current implementation has a bug - it checks if parameters are provided but always uses Corporation constants due to incorrect ternary logic at [src/datos/Singleton.php:28-31]().

Sources: [src/datos/Singleton.php:24-42]()

### Email Configuration Consumption

While the provided files don't show direct usage of the email constants, based on the system architecture (see [Email System (PHPMailer)](#8.3)), the `MAIL_*` constants are consumed by:

- `OperacionesCtrl::enviar_Notificacion()` method
- `OperacionesCtrl::enviarCustomEmail()` method  
- `OperacionesHomeCtrl::actviarSendMail()` method

These methods use PHPMailer and configure it with the Corporation SMTP constants.

Sources: [repo/corp/Corporation.php:6-15]()

## Constant Access Pattern

The Corporation class uses public constants accessed via the class scope resolution operator:

```php
// Database constants
$host = Corporation::HOST;
$user = Corporation::DBUSER;
$pass = Corporation::DBPASS;
$name = Corporation::DBNAME;

// Email constants
$smtpHost = Corporation::MAIL_HOST;
$smtpUser = Corporation::MAIL_USERNAME;
// ... etc
```

This pattern allows static access without instantiation, as the Corporation class is never instantiated - it serves purely as a namespace for configuration constants.

Sources: [src/datos/Singleton.php:28-31]()

## Security Considerations

### Critical Security Issues

The Corporation class exhibits a **critical security vulnerability** by hardcoding sensitive credentials directly in source code:

**Exposed Credentials:**

1. **Database Password:** `'rootapps'` stored in plaintext at [repo/corp/Corporation.php:19]()
2. **SMTP Password:** `'73cn0l0g1@Info.'` stored in plaintext at [repo/corp/Corporation.php:10]()
3. **Email Account:** Full SMTP credentials for `admin@nuevapp.com`

**Risk Factors:**

- Credentials are committed to version control (Git)
- Anyone with repository access can view production credentials
- Credential rotation requires code changes and redeployment
- Different environments (dev/staging/prod) cannot use different credentials
- Password appears in commit history permanently

### Security Risk Matrix

| Credential Type | Location | Severity | Impact |
|----------------|----------|----------|---------|
| Database Password | [repo/corp/Corporation.php:19]() | **CRITICAL** | Full database access, data breach, data loss |
| SMTP Password | [repo/corp/Corporation.php:10]() | **HIGH** | Email account compromise, spam relay, phishing |
| Database Username | [repo/corp/Corporation.php:18]() | **MEDIUM** | Information disclosure |
| SMTP Username | [repo/corp/Corporation.php:9]() | **MEDIUM** | Information disclosure |
| Database Host | [repo/corp/Corporation.php:17]() | **LOW** | Infrastructure mapping |

Sources: [repo/corp/Corporation.php:6-20]()

## Best Practices and Migration Path

### Recommended Configuration Approach

The system should migrate from hardcoded constants to environment-based configuration:

**Current Pattern (Insecure):**
```php
const DBPASS = 'rootapps';  // Hardcoded in source
```

**Recommended Pattern (Secure):**
```php
const DBPASS = ''; // Empty default

public static function getDbPass() {
    return getenv('DB_PASSWORD') ?: self::DBPASS;
}
```

### Environment Variable Migration

**Step 1: Define Environment Variables**
```bash
# .env file (not committed to Git)
DB_HOST=db
DB_USER=rootapps
DB_PASS=secure_password_here
DB_NAME=nuevapp_apps

MAIL_HOST=smtp.ipage.com
MAIL_PORT=25
MAIL_USER=admin@nuevapp.com
MAIL_PASS=secure_smtp_password
```

**Step 2: Modify Corporation Class**
```php
class Corporation {
    const HOST   = ''; // Defaults
    const DBUSER = '';
    const DBPASS = '';
    const DBNAME = '';
    
    public static function getHost() {
        return getenv('DB_HOST') ?: 'db';
    }
    
    public static function getDbUser() {
        return getenv('DB_USER') ?: 'rootapps';
    }
    
    // ... similar methods for all credentials
}
```

**Step 3: Update Consumers**
```php
// In Singleton::__construct()
$_host = Corporation::getHost();
$_uname = Corporation::getDbUser();
$_pass = Corporation::getDbPass();
$_db = Corporation::getDbName();
```

### Additional Security Recommendations

1. **Immediate Actions:**
   - Rotate all exposed credentials
   - Add `Corporation.php` to `.gitignore` (use template file instead)
   - Create `Corporation.php.example` with empty values for documentation

2. **Short-term Actions:**
   - Implement environment variable support
   - Use Docker secrets or environment files
   - Add credential validation on startup

3. **Long-term Actions:**
   - Implement secrets management (HashiCorp Vault, AWS Secrets Manager)
   - Use connection string encryption at rest
   - Implement credential rotation automation
   - Add audit logging for credential access

For deployment and environment configuration guidance, see [Environment Configuration](#11.1). For security hardening recommendations, see [Security Hardening](#11.2).

Sources: [repo/corp/Corporation.php:1-22](), System Architecture Analysis

## Usage Examples

### Database Connection via Singleton

When any component needs database access, it instantiates `Singleton` which automatically loads Corporation constants:

```php
// Implicit loading in any data operation
$singleton = new Singleton();
$results = Singleton::_readInfo('userselecto', '*', 'WHERE active=1');
```

The Corporation constants are loaded at [src/datos/Singleton.php:26]() during the first `Singleton` instantiation.

Sources: [src/datos/Singleton.php:24-42]()

### DataTables Integration

When building DataTables server-side processing, Corporation credentials are assembled into an `sql_details` array:

```php
// From Singleton::_dataTable() method
$sql_details = array(
    'user' => Corporation::DBUSER,
    'pass' => Corporation::DBPASS,
    'db'   => Corporation::DBNAME,
    'host' => Corporation::HOST
);
```

This array is then passed to the SSP (Server-Side Processing) class for DataTables AJAX queries at [src/datos/Singleton.php:574-579]().

Sources: [src/datos/Singleton.php:574-579]()

### Model Code Generation

The model generator tool (`Singleton::_modelos()`) uses the database name constant to introspect the schema:

```php
$_db = Corporation::DBNAME;  // 'nuevapp_apps'

// Query INFORMATION_SCHEMA for all tables
$r = self::_readInfo(
    "INFORMATION_SCHEMA.TABLES", 
    "*", 
    "where TABLE_SCHEMA like '" . $_db . "'"
);
```

This enables automatic model class generation from database tables at [src/datos/Singleton.php:391-403]().

Sources: [src/datos/Singleton.php:390-491]()

## Configuration Modification Workflow

### Current Workflow (Problematic)

```mermaid
graph LR
    DEV["Developer"]
    CORP["Corporation.php"]
    GIT["Git Repository"]
    PROD["Production Server"]
    
    DEV -->|"1. Modify constants"| CORP
    CORP -->|"2. Commit changes"| GIT
    GIT -->|"3. Pull/Deploy"| PROD
    PROD -->|"4. Credentials exposed"| GIT
    
    style PROD fill:#ffcccc
    style GIT fill:#ffcccc
```

**Problems:**
- Credentials in commit history
- Cannot use different credentials per environment
- Requires code deployment for credential changes
- All repository viewers see production credentials

Sources: System Architecture Analysis

### Recommended Workflow

```mermaid
graph LR
    ADMIN["System Administrator"]
    ENV["Environment Variables<br/>.env / Docker Secrets"]
    CORP["Corporation.php<br/>(methods only)"]
    GIT["Git Repository<br/>(no credentials)"]
    PROD["Production Server"]
    
    ADMIN -->|"1. Set secure vars"| ENV
    ENV -->|"2. Read at runtime"| CORP
    CORP -->|"3. Code in Git"| GIT
    GIT -->|"4. Deploy safely"| PROD
    PROD -->|"5. Reads from"| ENV
    
    style PROD fill:#ccffcc
    style GIT fill:#ccffcc
    style ENV fill:#ccffcc
```

**Benefits:**
- No credentials in version control
- Per-environment configuration
- Runtime credential changes without redeployment
- Restricted access to production secrets

Sources: Best Practices Analysis

## Conclusion

The `Corporation` class serves as the central configuration registry for GESFINANCIERO, but its current implementation of hardcoding credentials represents a critical security vulnerability. Migration to environment-based configuration should be prioritized as a security hardening initiative. All database and email operations in the system ultimately depend on these constants, making this class a critical infrastructure component that warrants secure implementation practices.

For information on externalizing these credentials during deployment, see [Environment Configuration](#11.1).

---

---

## 6.2 Static Data Resources

## Purpose and Scope

This document describes static data resources in the GESFINANCIERO system—specifically, JSON-formatted configuration files that store application-level constants and reference data. These resources provide structured, version-controlled data that can be consumed by multiple application components without database queries.

For system-wide configuration constants such as database credentials and SMTP settings, see [System Configuration (Corporation.php)](#6.1). For dynamically loaded database models, see [Data Models](#5.3).

**Sources:** [src/data.json:1-1]()

---

## Overview

GESFINANCIERO uses static JSON files to store reference data that:
- Remains relatively constant across deployments
- Does not require database storage
- Needs to be version-controlled
- Should be accessible to frontend and backend code

Currently, the primary static data resource is `src/data.json`, which contains educational level (grade) definitions used throughout the system.

**Sources:** [src/data.json:1-1]()

---

## Data Structure and Content

### Educational Levels Configuration (data.json)

The `src/data.json` file contains an array of educational level objects used for categorizing students, classes, and financial transactions by grade level.

#### File Location
```
src/data.json
```

#### Structure

Each object in the array contains two fields:

| Field | Type | Description | Example |
|-------|------|-------------|---------|
| `id` | string | Unique identifier for the grade level, following the pattern `list-{n}-list` | `"list-1-list"` |
| `txt` | string | Display name in Spanish for the educational level | `"Prejardín Inicial"` |

#### Complete Data Set

The file contains 10 educational levels:

```json
[
  {"id":"list-1-list","txt":"Prejardín Inicial"},
  {"id":"list-0-list","txt":"Transición A"},
  {"id":"list-2-list","txt":"Primero A"},
  {"id":"list-6-list","txt":"Cuarto A"},
  {"id":"list-9-list","txt":"Jardín A"},
  {"id":"list-8-list","txt":"Prejardín A"},
  {"id":"list-7-list","txt":"Quinto A"},
  {"id":"list-3-list","txt":"Primero B"},
  {"id":"list-5-list","txt":"Tercero A"},
  {"id":"list-4-list","txt":"Segundo A"}
]
```

#### Educational Level Hierarchy

The grade levels represent Colombian preschool and primary education:

**Preschool Levels:**
- Prejardín (Pre-kindergarten)
- Jardín (Kindergarten)
- Transición (Transition)

**Primary Levels:**
- Primero (First grade)
- Segundo (Second grade)
- Tercero (Third grade)
- Cuarto (Fourth grade)
- Quinto (Fifth grade)

**Sources:** [src/data.json:1-1]()

---

## Data Access Patterns

### Static Data Loading Flow

```mermaid
graph TB
    subgraph "Client Layer"
        BROWSER["Browser"]
        AJAX["AJAX Request"]
    end
    
    subgraph "Server Layer"
        ENTRY["index.php or home.php"]
        CTRL["IndexCtrl or HomeCtrl"]
        FILE["src/data.json"]
    end
    
    subgraph "Rendering"
        SELECT["Select/Dropdown Element"]
        FILTER["Grade Filter Component"]
        VALIDATION["Grade Validation Logic"]
    end
    
    BROWSER -->|"Page Load"| ENTRY
    ENTRY --> CTRL
    CTRL -->|"file_get_contents() or require"| FILE
    FILE -->|"JSON Array"| CTRL
    CTRL -->|"Embed in HTML"| SELECT
    CTRL -->|"Pass to Template"| FILTER
    
    BROWSER -->|"Dynamic Load"| AJAX
    AJAX -->|"API Request"| CTRL
    CTRL -->|"Read JSON"| FILE
    FILE -->|"JSON Response"| AJAX
    AJAX -->|"Populate UI"| SELECT
    
    SELECT --> VALIDATION
    FILTER --> VALIDATION
```

**Diagram: Static Data Loading and Consumption**

**Sources:** [src/data.json:1-1]()

### Common Usage Patterns

#### Server-Side Loading

Static data files are typically loaded using PHP's file system functions:

```php
// Loading JSON data
$gradeData = json_decode(file_get_contents('src/data.json'), true);

// Iterating for dropdown generation
foreach ($gradeData as $grade) {
    echo "<option value='{$grade['id']}'>{$grade['txt']}</option>";
}
```

#### Client-Side Loading

JavaScript can fetch static data via:
- Direct AJAX request to the JSON file
- Embedded in HTML during server-side rendering
- Passed through API endpoints that include reference data

**Sources:** [src/data.json:1-1]()

---

## Integration Points

### System Components That Consume Grade Data

```mermaid
graph TB
    DATA["src/data.json"]
    
    subgraph "UI Components"
        DROPDOWN["Grade Selection Dropdowns"]
        FILTER["Grade Filter Panels"]
        REPORTS["Grade-based Reports"]
    end
    
    subgraph "Business Logic"
        VALIDATION["Input Validation"]
        ENROLLMENT["Student Enrollment"]
        BILLING["Grade-based Billing"]
    end
    
    subgraph "Data Operations"
        QUERY["Grade Query Filters"]
        GROUPING["Grade-based Grouping"]
        EXPORT["Export by Grade"]
    end
    
    DATA --> DROPDOWN
    DATA --> FILTER
    DATA --> REPORTS
    DATA --> VALIDATION
    DATA --> ENROLLMENT
    DATA --> BILLING
    DATA --> QUERY
    DATA --> GROUPING
    DATA --> EXPORT
```

**Diagram: Grade Data Integration Points**

**Sources:** [src/data.json:1-1]()

### Likely Integration with Controllers

Based on the system architecture, `data.json` is likely consumed by:

| Controller | Usage Context | Purpose |
|------------|---------------|---------|
| `IndexCtrl` | Student/employee management endpoints | Populating grade selection in forms |
| `HomeCtrl` | Public-facing pages | Displaying grade-based information |
| `OperacionesCtrl` | Business logic operations | Validating grade assignments |
| `OperacionesHomeCtrl` | Document listing operations | Filtering documents by grade |

**Sources:** [src/data.json:1-1]()

---

## Data Maintenance

### Adding New Educational Levels

To add a new grade level:

1. **Edit `src/data.json`:**
   ```json
   {"id":"list-10-list","txt":"Sexto A"}
   ```

2. **Follow ID Naming Convention:**
   - Pattern: `list-{number}-list`
   - Ensure unique number across all entries
   - Use sequential numbering when possible

3. **Use Proper Spanish Naming:**
   - Follow Colombian educational terminology
   - Include section designation (A, B, etc.) if applicable
   - Use proper capitalization

4. **Test Integration:**
   - Verify dropdown population
   - Check filter functionality
   - Validate form submissions
   - Test reporting queries

**Sources:** [src/data.json:1-1]()

### Data Validation Rules

The current structure has these implicit requirements:

| Rule | Description | Enforcement |
|------|-------------|-------------|
| Unique IDs | No duplicate `id` values | Application-level validation |
| ID Format | Must match `list-{n}-list` pattern | Convention-based |
| Non-empty Text | `txt` field must be populated | Required for UI display |
| Valid JSON | File must be valid JSON array | PHP `json_decode()` will fail if invalid |

**Sources:** [src/data.json:1-1]()

### Version Control Considerations

`src/data.json` is tracked in Git, which means:

- **Changes are auditable** through commit history
- **Multi-environment consistency** is maintained
- **Rollback is possible** if incorrect data is added
- **Merge conflicts** can occur if multiple developers modify simultaneously

**Best Practice:** Coordinate grade level additions across development team to avoid conflicts.

**Sources:** [src/data.json:1-1]()

---

## Security and Access Control

### File System Security

Static data files should have appropriate file system permissions:

```bash
# Recommended permissions for data.json
chmod 644 src/data.json
chown www-data:www-data src/data.json
```

This allows:
- Web server to read the file
- Only privileged users to write
- Protection against unauthorized modification

**Sources:** [src/data.json:1-1]()

### Data Exposure Considerations

Since `src/data.json` contains only educational level names:
- **No sensitive data** is exposed
- **Direct web access** should still be restricted via `.htaccess` or server configuration
- **API exposure** is safe if the data needs to be publicly available

**Recommendation:** Serve static data through controlled API endpoints rather than direct file access.

**Sources:** [src/data.json:1-1]()

---

## Extending the Static Data System

### Adding New Static Data Files

To add additional static data resources:

1. **Create JSON file in `src/` directory:**
   ```
   src/departments.json
   src/fee-types.json
   src/payment-terms.json
   ```

2. **Follow consistent structure:**
   ```json
   [
     {"id": "unique-identifier", "txt": "Display Name", "metadata": {...}}
   ]
   ```

3. **Document in this wiki page** with structure and usage

4. **Create loader functions** in appropriate controller or utility class

**Sources:** [src/data.json:1-1]()

### Alternative Data Formats

While JSON is the current format, other options include:

| Format | Pros | Cons | Use Case |
|--------|------|------|----------|
| JSON | Easy parsing, widely supported | Can't include comments | Current standard |
| PHP Array | Native to PHP, can include logic | Not accessible to JS without API | Server-only data |
| YAML | Human-readable, supports comments | Requires external parser | Complex configurations |
| CSV | Simple, Excel-compatible | Limited structure | Tabular data only |

**Current Standard:** JSON is recommended for new static data files.

**Sources:** [src/data.json:1-1]()

---

## Relationship to Database Data

### Static vs Dynamic Data

Understanding when to use static files vs database:

| Criteria | Static File (JSON) | Database Table |
|----------|-------------------|----------------|
| Change Frequency | Rarely (yearly) | Frequently (daily) |
| Data Volume | Small (<100 records) | Large (>1000 records) |
| User Modification | Developer/Admin only | End users can modify |
| Version Control | Tracked in Git | Not in version control |
| Performance | Fast (file read) | Query overhead |
| Examples | Grade levels, categories | Students, transactions, documents |

**Decision Rule:** If data changes rarely and needs to be consistent across environments, use static files. If data changes frequently or is user-generated, use database tables.

**Sources:** [src/data.json:1-1]()

### Migration Path

If static data grows too large or requires frequent updates:

1. **Create database table:**
   ```sql
   CREATE TABLE grade_levels (
     id VARCHAR(50) PRIMARY KEY,
     txt VARCHAR(100) NOT NULL,
     display_order INT,
     active BOOLEAN DEFAULT TRUE
   );
   ```

2. **Populate from JSON:**
   ```php
   $data = json_decode(file_get_contents('src/data.json'), true);
   foreach ($data as $grade) {
       // Insert into database
   }
   ```

3. **Update references** throughout codebase
4. **Remove static file** or keep as backup/seed data

**Sources:** [src/data.json:1-1]()

---

## Performance Considerations

### Caching Strategies

For frequently accessed static data:

**Server-Side Caching:**
```php
// Cache in PHP array on first load
static $gradeData = null;
if ($gradeData === null) {
    $gradeData = json_decode(file_get_contents('src/data.json'), true);
}
return $gradeData;
```

**Client-Side Caching:**
- Use browser localStorage to cache after first fetch
- Set appropriate Cache-Control headers for HTTP caching
- Consider service workers for offline availability

**Sources:** [src/data.json:1-1]()

### File Size Monitoring

Current file metrics:

| Metric | Current Value |
|--------|---------------|
| Record Count | 10 grade levels |
| File Size | ~500 bytes (approximate) |
| Load Time | <1ms on typical server |

**Threshold Alert:** If file grows beyond 100 records or 50KB, consider database migration.

**Sources:** [src/data.json:1-1]()

---

## Best Practices

### Data Quality Standards

1. **Consistency:** Use consistent naming patterns for IDs
2. **Completeness:** Never leave `txt` fields empty
3. **Uniqueness:** Ensure all IDs are unique
4. **Ordering:** Consider adding an `order` or `sort` field for display sequence
5. **Validation:** Implement JSON schema validation in deployment pipeline

**Sources:** [src/data.json:1-1]()

### Documentation Requirements

For each static data file, document:
- File path and purpose
- Field definitions and constraints
- Where/how the data is consumed
- Update procedures and ownership
- Migration plan if data grows

**Sources:** [src/data.json:1-1]()

### Code Review Checklist

When reviewing changes to static data files:
- [ ] JSON syntax is valid
- [ ] No duplicate IDs introduced
- [ ] All required fields are present
- [ ] Display text is properly formatted
- [ ] Change is coordinated with UI updates
- [ ] Testing has been performed

**Sources:** [src/data.json:1-1]()

---

## Summary

`src/data.json` provides static educational level data for the GESFINANCIERO system, serving as version-controlled reference data for UI components, validation logic, and business operations. This pattern of storing configuration data in JSON files offers a simple, performant solution for small, rarely-changing datasets that need to be consistent across all deployment environments.

**Key Points:**
- Contains 10 Colombian educational levels from Prejardín to Quinto
- Uses `list-{n}-list` ID pattern for consistency
- Consumed by controllers for dropdown population and validation
- Should be maintained through Git version control
- Can be migrated to database if data volume or update frequency increases

**Sources:** [src/data.json:1-1]()

---

---

## 7. Module System

## Purpose and Scope

This document describes the module system architecture used in GESFINANCIERO, located in the `repo/` directory. The module system implements a plugin-like architecture where each module has a tracked entry point (`index.php`) and ignored runtime data. This pattern separates version-controlled code from user-generated content, enabling modular extensibility and secure multi-environment deployments.

For specific configuration constants stored in the `corp` module, see [System Configuration](#6.1). For details on how the main application entry points may route to modules, see [Application Entry Points](#2). For documentation of individual modules, see sections [7.1](#7.1) through [7.7](#7.7).

---

## Architecture Overview

The module system consists of seven primary modules organized under the `repo/` directory. Each module follows a consistent pattern: a tracked `index.php` entry point with all other content treated as runtime data.

### Module Directory Structure

```mermaid
graph TB
    subgraph "repo/"
        REPO["repo/"]
        
        ANEXOS["anexos/"]
        ANEXOS_INDEX["anexos/index.php<br/>(tracked)"]
        ANEXOS_DATA["anexos/*<br/>(ignored)"]
        
        AVATAR["avatar/"]
        AVATAR_INDEX["avatar/index.php<br/>(tracked)"]
        AVATAR_DATA["avatar/*<br/>(ignored)"]
        
        PROC["proc/"]
        PROC_INDEX["proc/index.php<br/>(tracked)"]
        PROC_DATA["proc/*<br/>(ignored)"]
        
        COM["com/"]
        COM_INDEX["com/index.php<br/>(tracked)"]
        COM_DATA["com/*<br/>(ignored)"]
        
        RECURSOS["recursos/"]
        RECURSOS_INDEX["recursos/index.php<br/>(tracked)"]
        RECURSOS_DATA["recursos/*<br/>(ignored)"]
        
        USUARIOS["usuarios/"]
        USUARIOS_INDEX["usuarios/index.php<br/>(tracked)"]
        USUARIOS_DATA["usuarios/*<br/>(ignored)"]
        
        CORP["corp/"]
        CORP_INDEX["corp/index.php<br/>(tracked)"]
        CORP_CLASS["corp/Corporation.php<br/>(tracked)"]
        CORP_DATA["corp/*<br/>(ignored)"]
    end
    
    REPO --> ANEXOS
    REPO --> AVATAR
    REPO --> PROC
    REPO --> COM
    REPO --> RECURSOS
    REPO --> USUARIOS
    REPO --> CORP
    
    ANEXOS --> ANEXOS_INDEX
    ANEXOS --> ANEXOS_DATA
    
    AVATAR --> AVATAR_INDEX
    AVATAR --> AVATAR_DATA
    
    PROC --> PROC_INDEX
    PROC --> PROC_DATA
    
    COM --> COM_INDEX
    COM --> COM_DATA
    
    RECURSOS --> RECURSOS_INDEX
    RECURSOS --> RECURSOS_DATA
    
    USUARIOS --> USUARIOS_INDEX
    USUARIOS --> USUARIOS_DATA
    
    CORP --> CORP_INDEX
    CORP --> CORP_CLASS
    CORP --> CORP_DATA
```

**Sources:** [.gitignore:16-29]()

### Module Inventory

| Module | Directory | Purpose (Inferred) | Entry Point | Special Notes |
|--------|-----------|-------------------|-------------|---------------|
| **anexos** | `repo/anexos/` | Attachment/annex file management | `index.php` | Handles document attachments |
| **avatar** | `repo/avatar/` | User profile image storage | `index.php` | User avatar uploads and processing |
| **proc** | `repo/proc/` | Processing operations | `index.php` | Procedure/process handling |
| **com** | `repo/com/` | Communication or common utilities | `index.php` | Communication subsystem |
| **recursos** | `repo/recursos/` | Resource file management | `index.php` | Static resource handling |
| **usuarios** | `repo/usuarios/` | User-specific data storage | `index.php` | User data and operations |
| **corp** | `repo/corp/` | Corporate configuration | `index.php` | Contains `Corporation.php` class |

**Sources:** [.gitignore:16-29](), directory structure inference

---

## Module Entry Point Pattern

Each module implements a standardized entry point pattern where only the `index.php` file is tracked in version control, serving as the module's public interface.

### Entry Point Implementation

All current module entry points are empty placeholder files:

```mermaid
graph LR
    ANEXOS_PHP["repo/anexos/index.php"]
    AVATAR_PHP["repo/avatar/index.php"]
    PROC_PHP["repo/proc/index.php"]
    COM_PHP["repo/com/index.php"]
    RECURSOS_PHP["repo/recursos/index.php"]
    USUARIOS_PHP["repo/usuarios/index.php"]
    
    ANEXOS_PHP --> EMPTY["Empty<br/>Implementation<br/><?php ?>"]
    AVATAR_PHP --> EMPTY
    PROC_PHP --> EMPTY
    COM_PHP --> EMPTY
    RECURSOS_PHP --> EMPTY
    USUARIOS_PHP --> EMPTY
```

**Current Implementation Status:**

All module `index.php` files contain only minimal PHP opening/closing tags:

- [repo/anexos/index.php:1-2](): Empty implementation
- [repo/avatar/index.php:1-3](): Empty implementation
- [repo/com/index.php:1-3](): Empty implementation
- [repo/proc/index.php:1-2](): Empty implementation
- [repo/recursos/index.php:1-3](): Empty implementation
- [repo/usuarios/index.php:1-2](): Empty implementation

This indicates the module system is a defined architectural pattern awaiting implementation, or these entry points serve as routing placeholders while actual functionality resides in the main controllers.

**Sources:** [repo/anexos/index.php:1-2](), [repo/avatar/index.php:1-3](), [repo/com/index.php:1-3](), [repo/proc/index.php:1-2](), [repo/recursos/index.php:1-3](), [repo/usuarios/index.php:1-2]()

---

## Git Tracking Strategy

The `.gitignore` file implements a deliberate pattern that separates code from data at the module level.

### Tracking Pattern in .gitignore

```mermaid
graph TB
    subgraph "Git Tracking Behavior"
        IGNORE["Ignore Pattern<br/>repo/*/(*"]
        EXCEPT["Exception Pattern<br/>!repo/*/index.php"]
        
        RESULT_TRACKED["Tracked Files<br/>index.php only"]
        RESULT_IGNORED["Ignored Files<br/>All runtime data"]
    end
    
    IGNORE --> RESULT_IGNORED
    EXCEPT --> RESULT_TRACKED
```

### Configuration Details

The `.gitignore` file uses a two-step pattern:

1. **Global Ignore** ([.gitignore:16-21]()):
   ```
   repo/anexos/*
   repo/avatar/*
   repo/proc/*
   repo/com/*
   repo/recursos/*
   repo/usuarios/*
   ```
   
2. **Selective Tracking** ([.gitignore:24-29]()):
   ```
   !repo/anexos/index.php
   !repo/avatar/index.php
   !repo/proc/index.php
   !repo/com/index.php
   !repo/recursos/index.php
   !repo/usuarios/index.php
   ```

### Implications

| Aspect | Behavior | Benefit |
|--------|----------|---------|
| **Code** | `index.php` tracked in Git | Version control for module logic |
| **Runtime Data** | All other files ignored | Prevents user data in repository |
| **Uploads** | User-generated content excluded | Security: no sensitive data commits |
| **Environment Separation** | Each environment has own data | Clean multi-environment deployment |
| **Module Addition** | Add directory + index.php | Easy module scaffolding |

**Sources:** [.gitignore:16-29]()

---

## Module Isolation and Runtime Data

Each module operates as an isolated namespace where runtime data is completely separated from version-controlled code.

### Data Isolation Pattern

```mermaid
graph TB
    subgraph "Module Isolation Model"
        CODE["Code Layer<br/>index.php<br/>Version Controlled"]
        
        DATA["Data Layer<br/>Runtime Files<br/>Not in Git"]
        
        TYPES["Data Types"]
        UPLOADS["User Uploads<br/>(avatars, attachments)"]
        CACHE["Cached Data<br/>(processing results)"]
        LOGS["Module Logs<br/>(usage tracking)"]
        CONFIG["Local Config<br/>(environment-specific)"]
        
        CODE -.->|"generates"| DATA
        DATA --> TYPES
        TYPES --> UPLOADS
        TYPES --> CACHE
        TYPES --> LOGS
        TYPES --> CONFIG
    end
```

### Module-Specific Runtime Data Examples

| Module | Likely Runtime Content | Usage Pattern |
|--------|----------------------|---------------|
| `anexos/` | PDF files, document attachments | Written by document upload operations |
| `avatar/` | User profile images (JPG, PNG) | Written by user profile update operations |
| `proc/` | Processing queue, temporary files | Written by background processing tasks |
| `com/` | Communication logs, message cache | Written by messaging/notification system |
| `recursos/` | Uploaded resources, media files | Written by resource management operations |
| `usuarios/` | User-specific files, preferences | Written by user operations |
| `corp/` | Corporate documents, configurations | Written by corporate data operations |

**Sources:** [.gitignore:16-29](), module naming conventions

---

## Module Integration with Main Application

The module system integrates with the main application through potential routing from entry points, though current implementations are placeholders.

### Integration Architecture

```mermaid
sequenceDiagram
    participant User
    participant IndexPHP as "index.php"
    participant IndexCtrl
    participant ModuleIndex as "repo/*/index.php"
    participant RuntimeData as "repo/*/data"
    
    User->>IndexPHP: "HTTP Request"
    IndexPHP->>IndexCtrl: "Instantiate Controller"
    
    alt "Direct Module Request"
        User->>ModuleIndex: "Direct Access<br/>(if configured)"
        ModuleIndex->>RuntimeData: "Access Runtime Data"
        RuntimeData-->>ModuleIndex: "Return Data"
        ModuleIndex-->>User: "Response"
    else "Controller-Mediated Access"
        IndexCtrl->>RuntimeData: "Access via Controller"
        RuntimeData-->>IndexCtrl: "Return Data"
        IndexCtrl-->>User: "Response"
    end
```

### Current Integration Status

Based on the empty `index.php` implementations, modules currently operate through one of these patterns:

1. **Controller Integration**: Module functionality is implemented in main controllers (`IndexCtrl`, `OperacionesCtrl`) which directly access module directories for runtime data
2. **Planned Architecture**: Entry points are scaffolded for future direct module routing
3. **Hybrid Approach**: Some modules may handle routing while others are pure data storage

### Example Access Patterns

**Direct File Access (Likely Current):**
```
Controllers access module data directly:
- OperacionesCtrl::SubirArchivo() → writes to repo/anexos/
- User avatar operations → read/write repo/avatar/
- Resource operations → manage repo/recursos/
```

**Future Modular Routing (Planned):**
```
Requests routed to module entry points:
- /repo/anexos/index.php?action=upload
- /repo/avatar/index.php?action=get&user=123
- /repo/recursos/index.php?action=list
```

**Sources:** [repo/anexos/index.php:1-2](), [repo/avatar/index.php:1-3](), integration inference from empty implementations

---

## Adding New Modules

The module system's architecture makes adding new modules straightforward through a consistent pattern.

### Module Creation Workflow

```mermaid
flowchart TD
    START["Create New Module"]
    
    MKDIR["Create Directory<br/>mkdir repo/newmodule"]
    
    INDEX["Create Entry Point<br/>touch repo/newmodule/index.php"]
    
    GITIGNORE["Update .gitignore<br/>Add ignore + exception"]
    
    IMPLEMENT["Implement Logic<br/>in index.php"]
    
    COMMIT["Commit Entry Point<br/>git add repo/newmodule/index.php"]
    
    RUNTIME["Runtime Data<br/>Auto-ignored"]
    
    START --> MKDIR
    MKDIR --> INDEX
    INDEX --> GITIGNORE
    GITIGNORE --> IMPLEMENT
    IMPLEMENT --> COMMIT
    COMMIT --> RUNTIME
```

### Required Steps

1. **Create Module Directory:**
   ```bash
   mkdir -p repo/newmodule
   ```

2. **Create Entry Point:**
   ```bash
   touch repo/newmodule/index.php
   ```

3. **Update .gitignore:**
   Add ignore pattern:
   ```
   repo/newmodule/*
   ```
   Add exception:
   ```
   !repo/newmodule/index.php
   ```

4. **Implement Module Logic:**
   Edit `repo/newmodule/index.php` with module functionality

5. **Version Control:**
   ```bash
   git add .gitignore
   git add repo/newmodule/index.php
   git commit -m "Add newmodule module"
   ```

All runtime data files created in `repo/newmodule/` will automatically be ignored by Git.

**Sources:** [.gitignore:16-29](), module pattern

---

## Module-Specific Notes

### Special Case: corp Module

The `corp` module is unique as it houses the `Corporation.php` class containing system-wide configuration constants. While following the general module pattern, it serves a dual purpose as both a module and a configuration namespace.

**Key Files:**
- [repo/corp/index.php](): Module entry point (currently empty)
- `repo/corp/Corporation.php`: Configuration constants (tracked, see [System Configuration](#6.1))

The `Corporation` class is loaded directly by the bootstrap process in `index.php` and `home.php`, making it a critical system component beyond the typical module pattern.

**Sources:** [.gitignore:16-29](), architecture diagrams

---

## Current Implementation Status

### Empty Entry Points

All module entry points are currently empty placeholder files ([repo/*/index.php]()), containing only PHP opening tags. This suggests one of three scenarios:

1. **Planned Architecture**: The module system is defined but not yet fully implemented
2. **Alternative Routing**: Module functionality exists in main controllers rather than modular entry points
3. **Data-Only Modules**: Modules serve primarily as data storage namespaces accessed by controllers

### Recommended Actions

For teams working with this codebase:

- **Document Intent**: Clarify whether modules should implement routing logic or remain data-only namespaces
- **Implement or Remove**: Either implement module entry points or remove empty files to reduce confusion
- **Migration Path**: If migrating from controller-based to module-based routing, document the transition strategy
- **Convention Guide**: Establish conventions for what logic belongs in module entry points vs main controllers

**Sources:** [repo/anexos/index.php:1-2](), [repo/avatar/index.php:1-3](), [repo/com/index.php:1-3](), [repo/proc/index.php:1-2](), [repo/recursos/index.php:1-3](), [repo/usuarios/index.php:1-2]()

---

## Benefits of This Architecture

The module system's entry-point-only tracking pattern provides several architectural advantages:

| Benefit | Description |
|---------|-------------|
| **Code/Data Separation** | Version control contains only logic, never user data |
| **Security** | Prevents accidental commits of sensitive uploads or cached data |
| **Environment Independence** | Each deployment can have different runtime data while sharing code |
| **Horizontal Scalability** | New modules can be added without modifying core application |
| **Clean Git History** | Large binary files never pollute repository history |
| **Plugin Architecture** | Modules operate as isolated plugins with defined interfaces |

**Sources:** [.gitignore:16-29](), architectural analysis

---

## Related Documentation

- **Individual Module Documentation**: See sections [7.1](#7.1) through [7.7](#7.7) for detailed documentation of each module's purpose and implementation
- **System Configuration**: See [Corporation Configuration](#6.1) for the special `corp` module's configuration class
- **Entry Point Integration**: See [Application Entry Points](#2) for how modules may integrate with `index.php` and `home.php`
- **Static Resources**: See [Static Data Resources](#6.2) for information about application-wide static data

**Sources:** Documentation structure

---

---

## 7.1 Anexos Module

## Purpose and Scope

The **Anexos Module** (Spanish: "anexos" = attachments/annexes) is part of the modular plugin architecture in the `repo/` directory system. It is designed to handle attachment file management and storage for the GESFINANCIERO application. This module follows the system's standard pattern of maintaining a version-controlled entry point while keeping runtime data (uploaded files, attachments) outside of source control.

This document covers the anexos module's architecture, file structure, version control strategy, and integration points with the main application. For information about other repository modules, see [Module System](#7). For details on file upload operations in the business logic layer, see [OperacionesCtrl - Core Operations](#4.1).

**Sources:** [.gitignore:16-24](), [repo/anexos/index.php:1-2]()

---

## Module Overview

The anexos module serves as a dedicated storage and management subsystem for file attachments throughout the GESFINANCIERO application. Based on the architectural pattern established in the `repo/` directory system, this module maintains:

- A **tracked entry point** (`index.php`) for version-controlled logic
- An **ignored data directory** for runtime-generated attachment files
- **Isolated storage** separate from the main application codebase

The module name "anexos" reflects its purpose in Spanish-speaking contexts where "anexos" commonly refers to attachments, appendices, or supplementary documents attached to primary records.

| Property | Value |
|----------|-------|
| Module Name | anexos |
| Primary Purpose | Attachment file storage and management |
| Entry Point | `repo/anexos/index.php` |
| Storage Location | `repo/anexos/*` (excluding index.php) |
| Version Control | Entry point tracked, data files ignored |
| Integration Layer | IndexCtrl, OperacionesCtrl |

**Sources:** [.gitignore:16-24](), [repo/anexos/index.php:1-2]()

---

## File Structure and Version Control Strategy

The anexos module implements a deliberate separation between code and data through `.gitignore` configuration:

```mermaid
graph TB
    subgraph "repo/anexos/ Directory"
        INDEX["index.php<br/>(TRACKED)"]
        RUNTIME["Runtime Attachment Files<br/>(IGNORED)"]
        
        subgraph "Typical File Types (Ignored)"
            PDF["*.pdf"]
            DOCX["*.docx"]
            XLSX["*.xlsx"]
            IMG["*.jpg, *.png"]
            OTHER["Other attachments"]
        end
    end
    
    subgraph ".gitignore Configuration"
        IGNORE_RULE["repo/anexos/*<br/>Line 16"]
        EXCEPT_RULE["!repo/anexos/index.php<br/>Line 24"]
    end
    
    IGNORE_RULE -->|"Ignores all files"| RUNTIME
    EXCEPT_RULE -->|"Excepts from ignore"| INDEX
    
    RUNTIME --> PDF
    RUNTIME --> DOCX
    RUNTIME --> XLSX
    RUNTIME --> IMG
    RUNTIME --> OTHER
```

### .gitignore Pattern

The version control configuration explicitly manages what gets tracked:

```
# Ignore all files in anexos directory
repo/anexos/*

# Except the entry point
!repo/anexos/index.php
```

This pattern ensures:
- **User-uploaded attachments** never enter version control
- **Module entry point** remains tracked for deployment and updates
- **Sensitive or large files** stay out of the repository
- **Multi-environment deployments** can have different attachment sets

**Sources:** [.gitignore:16-24]()

---

## Module Entry Point

The current entry point is minimal, containing only PHP opening and closing tags:

```php
<?php
?>
```

### Current Implementation Status

The empty implementation at [repo/anexos/index.php:1-2]() indicates one of the following scenarios:

1. **Delegated Routing**: The module relies on main application controllers (IndexCtrl, OperacionesCtrl) for all attachment operations
2. **Direct File Access**: Attachments may be served directly by the web server without PHP processing
3. **Planned Architecture**: The entry point is a placeholder for future direct module access
4. **Legacy Pattern**: The module may have been superseded by centralized file handling in OperacionesCtrl

### Integration Points

```mermaid
graph LR
    subgraph "Main Application"
        INDEXCTRL["IndexCtrl<br/>src/controller/IndexCtrl.php"]
        OPCTRL["OperacionesCtrl<br/>src/controller/OperacionesCtrl.php"]
    end
    
    subgraph "Anexos Module"
        ENTRY["index.php<br/>repo/anexos/index.php"]
        STORAGE["Attachment Storage<br/>repo/anexos/*"]
    end
    
    subgraph "File Operations"
        SUBIR["SubirArchivo()<br/>File Upload Handler"]
        PROCB64["processBase64Images()<br/>Base64 Processing"]
        REDIM["redimensionImg2()<br/>Image Resizing"]
    end
    
    INDEXCTRL -->|"May route to"| ENTRY
    OPCTRL --> SUBIR
    OPCTRL --> PROCB64
    OPCTRL --> REDIM
    
    SUBIR -.->|"Stores files in"| STORAGE
    PROCB64 -.->|"Processes to"| STORAGE
```

While `index.php` is currently empty, the main application likely interacts with the anexos directory through:

- **File upload operations** in `OperacionesCtrl::SubirArchivo()`
- **Image processing** methods that may target this storage location
- **Direct file system operations** from controllers
- **Database references** linking records to attachment file paths

**Sources:** [repo/anexos/index.php:1-2]()

---

## Attachment Storage Pattern

### Typical Storage Structure

Based on the module architecture pattern, the anexos directory likely organizes attachments using a structure similar to:

```
repo/anexos/
├── index.php (tracked)
├── 2024/
│   ├── 01/
│   │   ├── documento_123.pdf
│   │   └── factura_456.xlsx
│   └── 02/
│       └── imagen_789.jpg
├── temp/
│   └── upload_processing/
└── thumbnails/
    └── imagen_789_thumb.jpg
```

### Common Attachment Patterns

```mermaid
graph TB
    subgraph "Attachment Lifecycle"
        UPLOAD["1. Upload Request<br/>POST to IndexCtrl"]
        VALIDATE["2. Validation<br/>File type, size, permissions"]
        PROCESS["3. Processing<br/>Rename, move, resize"]
        STORE["4. Store in anexos/<br/>repo/anexos/[path]"]
        DBREF["5. Database Reference<br/>Store file path"]
    end
    
    subgraph "Database Tables (Likely)"
        ADJUNTOS["adjuntosflujos<br/>(Document attachments)"]
        DOCSESTADOS["docsestados<br/>(Document states)"]
        OTHER["Other attachment references"]
    end
    
    UPLOAD --> VALIDATE
    VALIDATE --> PROCESS
    PROCESS --> STORE
    STORE --> DBREF
    
    DBREF --> ADJUNTOS
    DBREF --> DOCSESTADOS
    DBREF --> OTHER
```

### File Path References

Database records likely store attachment references using patterns such as:

- **Relative paths**: `anexos/2024/01/documento_123.pdf`
- **Absolute paths**: `/var/www/gesfinanciero/repo/anexos/2024/01/documento_123.pdf`
- **URL paths**: `https://domain.com/repo/anexos/2024/01/documento_123.pdf`

The specific pattern depends on implementation details in the business logic layer.

**Sources:** [.gitignore:16-24]()

---

## Integration with Main Application

### Request Flow for Attachment Operations

```mermaid
sequenceDiagram
    actor User
    participant Browser
    participant IndexCtrl as "IndexCtrl<br/>index.php"
    participant OpCtrl as "OperacionesCtrl"
    participant FS as "File System<br/>repo/anexos/"
    participant DB as "Database"
    
    User->>Browser: Upload Attachment
    Browser->>IndexCtrl: POST with file data
    IndexCtrl->>OpCtrl: SubirArchivo()
    
    OpCtrl->>OpCtrl: Validate file
    OpCtrl->>FS: Write file to anexos/
    FS-->>OpCtrl: File path
    
    OpCtrl->>DB: Store file reference
    DB-->>OpCtrl: Record ID
    
    OpCtrl-->>IndexCtrl: Success response
    IndexCtrl-->>Browser: JSON result
    Browser-->>User: Upload confirmation
```

### Access Control

The anexos module's security relies on:

1. **Application-level authentication** in IndexCtrl/HomeCtrl
2. **Database permission checks** before file access
3. **File system permissions** on the anexos directory
4. **Indirect access** through controllers (not direct file URLs)

Since the entry point is empty, direct access to `repo/anexos/index.php` would return no content, forcing all attachment access through the main application's authentication and authorization layers.

**Sources:** [repo/anexos/index.php:1-2]()

---

## Security and Data Isolation

### Version Control Isolation

The `.gitignore` pattern provides several security benefits:

| Benefit | Description |
|---------|-------------|
| **No Sensitive Data Leakage** | User-uploaded files never enter Git history |
| **Smaller Repository** | Large binary files don't bloat the repository |
| **Environment Isolation** | Each deployment can have independent attachments |
| **Access Control** | File system permissions control attachment access |
| **Audit Trail Separation** | File changes don't pollute Git logs |

### Data Privacy Considerations

The anexos module's ignored status means:

- **User privacy**: Uploaded documents remain on the server only
- **Compliance**: Sensitive financial documents aren't distributed via Git
- **Data sovereignty**: Each environment maintains its own attachment set
- **Backup responsibility**: Attachments must be backed up separately from code

**Sources:** [.gitignore:16-24]()

---

## Implementation Status and Future Considerations

### Current State

The module currently exists in a **minimal implementation state**:

- ✅ Directory structure created
- ✅ `.gitignore` configuration in place
- ✅ Entry point file tracked
- ⚠️ Entry point contains no logic
- ❓ Integration via business logic layer (not directly visible)

### Potential Enhancement Paths

If the module were to be expanded, typical enhancements would include:

1. **Direct Module Access**
   - RESTful API in `index.php` for attachment operations
   - Token-based authentication for file downloads
   - Streaming large files efficiently

2. **Enhanced Organization**
   - Automatic directory structure creation by year/month
   - File naming conventions and collision handling
   - Metadata storage (JSON sidecar files)

3. **Processing Capabilities**
   - Virus scanning for uploaded files
   - Format conversion (e.g., Office to PDF)
   - Thumbnail generation for images/videos
   - OCR for searchable PDFs

4. **Performance Optimization**
   - CDN integration for static file serving
   - Caching strategies for frequently accessed files
   - Compression for large files

### Relation to Other Modules

The anexos module follows the same architectural pattern as sibling modules:

- [Avatar Module](#7.2): User profile images
- [Resources Module](#7.5): Static resource files
- [Processing Module](#7.4): Processing/procedure data

Each maintains the same tracked-entry-point + ignored-data pattern.

**Sources:** [repo/anexos/index.php:1-2](), [.gitignore:16-24]()

---

## Module Architecture Pattern

### Standard Module Template

```mermaid
graph TB
    subgraph "Standard Module Pattern"
        ENTRY["index.php<br/>(Entry Point)<br/>TRACKED"]
        DATA["Runtime Data<br/>(User Content)<br/>IGNORED"]
    end
    
    subgraph "Applied to Anexos"
        ANEXOS_ENTRY["repo/anexos/index.php<br/>Currently: Empty"]
        ANEXOS_DATA["repo/anexos/*<br/>Uploaded Attachments"]
    end
    
    subgraph "Applied to Other Modules"
        AVATAR_ENTRY["repo/avatar/index.php"]
        AVATAR_DATA["repo/avatar/*<br/>Profile Images"]
        
        RECURSOS_ENTRY["repo/recursos/index.php"]
        RECURSOS_DATA["repo/recursos/*<br/>Resource Files"]
    end
    
    ENTRY -.->|"Pattern Template"| ANEXOS_ENTRY
    DATA -.->|"Pattern Template"| ANEXOS_DATA
    
    ENTRY -.->|"Pattern Template"| AVATAR_ENTRY
    DATA -.->|"Pattern Template"| AVATAR_DATA
    
    ENTRY -.->|"Pattern Template"| RECURSOS_ENTRY
    DATA -.->|"Pattern Template"| RECURSOS_DATA
```

This architectural pattern enables:

- **Horizontal scalability**: New modules can be added without core changes
- **Deployment flexibility**: Code and data deploy independently
- **Clear boundaries**: Each module owns its data namespace
- **Security isolation**: Module data access is controlled by the application layer

**Sources:** [.gitignore:16-24](), [repo/anexos/index.php:1-2]()

---

## Summary

The Anexos Module represents a fundamental component of GESFINANCIERO's modular architecture:

- **Purpose**: Attachment file storage and management
- **Pattern**: Tracked entry point + ignored runtime data
- **Status**: Minimal implementation (empty entry point)
- **Integration**: Via main application controllers (IndexCtrl, OperacionesCtrl)
- **Security**: Isolation through `.gitignore` and application-layer access control

While the current implementation is minimal with an empty `index.php`, the module's structure and version control configuration establish the foundation for scalable attachment management. The deliberate separation between version-controlled code and ignored user data ensures that sensitive attachments remain isolated while maintaining deployable module structure.

For details on file upload operations that likely target this module, see [OperacionesCtrl - Core Operations](#4.1). For information about the broader module system architecture, see [Module System](#7).

**Sources:** [.gitignore:16-24](), [repo/anexos/index.php:1-2]()

---

---

## 7.2 Avatar Module

## Purpose and Scope

The Avatar Module (`repo/avatar/`) is a component of the repository module system responsible for managing user profile images (avatars). This module follows the standardized "entry point only" architectural pattern where only the module's entry point ([repo/avatar/index.php]()) is tracked in version control, while all runtime-generated avatar image files are excluded from Git tracking.

This document covers the Avatar Module's architecture, storage patterns, and integration points. For information about other modules in the repository system, see [Module System](#7). For user management operations that may interact with avatars, see [User Management APIs](#9.3).

**Sources:** [.gitignore:17](), [.gitignore:25](), [repo/avatar/index.php:1-2]()

---

## Module Architecture Overview

The Avatar Module implements the repository module system's standardized plugin architecture pattern, consisting of a tracked entry point and ignored runtime data storage.

### Module Structure

```mermaid
graph TB
    subgraph "Avatar Module - repo/avatar/"
        ENTRY["index.php<br/>(Tracked in Git)<br/>Entry Point"]
        STORAGE["Avatar Images<br/>(Ignored by Git)<br/>Runtime Data"]
    end
    
    subgraph "Version Control"
        GIT[".gitignore<br/>Configuration"]
    end
    
    subgraph "Expected Avatar Files"
        USER_IMGS["User Avatar Images<br/>*.jpg, *.png, *.gif"]
        THUMBS["Thumbnail Images<br/>Resized Versions"]
        TEMP["Temporary Uploads<br/>Processing Files"]
    end
    
    ENTRY -.->|"generates/manages"| STORAGE
    STORAGE --> USER_IMGS
    STORAGE --> THUMBS
    STORAGE --> TEMP
    
    GIT -->|"tracks"| ENTRY
    GIT -->|"ignores"| STORAGE
```

**Diagram: Avatar Module Structure and Version Control Pattern**

The `.gitignore` configuration explicitly defines this separation:

| Rule | Effect | Purpose |
|------|--------|---------|
| `repo/avatar/*` | Ignore all files in directory | Exclude user-generated avatar images |
| `!repo/avatar/index.php` | Exception: track this file | Version control the entry point |

**Sources:** [.gitignore:17](), [.gitignore:25]()

---

## Entry Point Implementation

The Avatar Module's entry point is currently in a minimal implementation state, containing only the basic PHP opening and closing tags without functional code.

### Current Implementation

[repo/avatar/index.php:1-2]()

```php
<?php
?>
```

### Implementation Status

The empty entry point indicates one of the following architectural states:

1. **Delegated Routing:** Avatar operations are handled directly by core controllers ([IndexCtrl](#3.1), [OperacionesCtrl](#4.1)) rather than through module-specific routing
2. **Direct File Access:** Avatar images may be served directly by the web server without PHP processing
3. **Incomplete Migration:** The module structure is in place but functionality has not yet been migrated from the core system
4. **Future Extension Point:** Reserved for future implementation of avatar-specific operations

**Sources:** [repo/avatar/index.php:1-2]()

---

## Expected Storage Patterns

Based on the module architecture and common avatar management practices, the Avatar Module is expected to follow these storage patterns:

### Directory Structure

```mermaid
graph LR
    ROOT["repo/avatar/"]
    
    subgraph "User Avatars"
        ORIGINAL["original/<br/>user_{id}.{ext}<br/>Full-size uploads"]
        THUMB["thumbs/<br/>user_{id}_thumb.{ext}<br/>Resized thumbnails"]
        TEMP["temp/<br/>upload_{token}.{ext}<br/>Pending uploads"]
    end
    
    subgraph "System Files"
        DEFAULT["default.png<br/>Fallback avatar"]
        INDEX["index.php<br/>Entry point"]
    end
    
    ROOT --> ORIGINAL
    ROOT --> THUMB
    ROOT --> TEMP
    ROOT --> DEFAULT
    ROOT --> INDEX
```

**Diagram: Expected Avatar Directory Organization**

### File Naming Conventions

| File Type | Pattern | Example | Purpose |
|-----------|---------|---------|---------|
| Original Avatar | `user_{userid}.{ext}` | `user_1234.jpg` | Full-resolution profile image |
| Thumbnail | `user_{userid}_thumb.{ext}` | `user_1234_thumb.jpg` | Resized for display (e.g., 150x150px) |
| Temporary Upload | `upload_{token}.{ext}` | `upload_a7f3e9.jpg` | Pre-validation uploads |
| Default Avatar | `default.png` | `default.png` | Fallback when user has no avatar |

**Sources:** [.gitignore:17]()

---

## Integration with Core System

The Avatar Module integrates with the core application through several system components that handle avatar upload, processing, and retrieval operations.

### File Upload Integration

```mermaid
sequenceDiagram
    participant User
    participant IndexCtrl
    participant OpCtrl as "OperacionesCtrl"
    participant FileOps as "File Operations<br/>(OpCtrl methods)"
    participant AvatarDir as "repo/avatar/<br/>Storage"
    
    User->>IndexCtrl: "POST avatar upload"
    IndexCtrl->>OpCtrl: "Delegate file operation"
    OpCtrl->>FileOps: "SubirArchivo()"
    FileOps->>FileOps: "Validate file type"
    FileOps->>FileOps: "redimensionImg2()<br/>Generate thumbnail"
    FileOps->>AvatarDir: "Save original image"
    FileOps->>AvatarDir: "Save thumbnail"
    FileOps-->>OpCtrl: "File path/URL"
    OpCtrl-->>IndexCtrl: "Success response"
    IndexCtrl-->>User: "JSON response"
```

**Diagram: Avatar Upload Processing Flow**

### Core System Integration Points

The Avatar Module relies on operations defined in [OperacionesCtrl](#4.1):

| Operation | Method | Purpose |
|-----------|--------|---------|
| File Upload | `SubirArchivo()` | Handle multipart file uploads, validation |
| Image Resize | `redimensionImg2()` | Generate thumbnails at specified dimensions |
| Base64 Processing | `processBase64Images()` | Handle Base64-encoded image data |
| File Validation | (within upload methods) | Check file types, sizes, dimensions |

**Sources:** Based on high-level architecture Diagram 3

---

## Avatar Access and Retrieval

Avatar images stored in the `repo/avatar/` directory can be accessed through multiple mechanisms depending on server configuration.

### Direct File Access Pattern

```mermaid
graph LR
    USER["User Browser"]
    WEB["Web Server<br/>(Apache/Nginx)"]
    AVATAR_DIR["repo/avatar/<br/>Image Files"]
    INDEX_PHP["index.php<br/>PHP Handler"]
    
    USER -->|"GET /repo/avatar/user_123.jpg"| WEB
    WEB -->|"Route 1: Direct"| AVATAR_DIR
    WEB -->|"Route 2: PHP"| INDEX_PHP
    INDEX_PHP -->|"Permission check"| AVATAR_DIR
    AVATAR_DIR -->|"Image data"| WEB
    WEB -->|"HTTP Response"| USER
```

**Diagram: Avatar Access Routing Options**

### Access Control Considerations

| Access Method | Security Level | Use Case |
|---------------|----------------|----------|
| Direct Web Server | Public access | Public profile avatars |
| PHP-controlled | Permission-checked | Private/restricted avatars |
| Authenticated API | Token-required | API-based avatar retrieval |

**Sources:** Based on module architecture pattern from Diagram 5

---

## Security Considerations

Avatar management involves several security concerns that must be addressed in implementation:

### Upload Security Requirements

```mermaid
graph TB
    UPLOAD["Avatar Upload Request"]
    
    subgraph "Validation Pipeline"
        AUTH["Authentication Check<br/>User must be logged in"]
        OWNER["Ownership Verification<br/>User can only update own avatar"]
        TYPE["File Type Validation<br/>Allow: jpg, png, gif"]
        SIZE["File Size Limit<br/>Max: 2-5 MB typical"]
        CONTENT["Content Validation<br/>Verify actual image data"]
        DIMS["Dimension Limits<br/>Max resolution check"]
    end
    
    SUCCESS["Process & Store Avatar"]
    REJECT["Reject Upload<br/>Return error"]
    
    UPLOAD --> AUTH
    AUTH -->|"Valid"| OWNER
    AUTH -->|"Invalid"| REJECT
    OWNER -->|"Valid"| TYPE
    OWNER -->|"Invalid"| REJECT
    TYPE -->|"Valid"| SIZE
    TYPE -->|"Invalid"| REJECT
    SIZE -->|"Valid"| CONTENT
    SIZE -->|"Invalid"| REJECT
    CONTENT -->|"Valid"| DIMS
    CONTENT -->|"Invalid"| REJECT
    DIMS -->|"Valid"| SUCCESS
    DIMS -->|"Invalid"| REJECT
```

**Diagram: Avatar Upload Security Pipeline**

### Security Checklist

| Security Aspect | Implementation Requirement |
|-----------------|---------------------------|
| **Authentication** | Verify user session before accepting uploads |
| **Authorization** | Users can only modify their own avatars (except admins) |
| **File Type Filtering** | Whitelist allowed extensions: `.jpg`, `.jpeg`, `.png`, `.gif` |
| **MIME Type Verification** | Check actual file content, not just extension |
| **Size Limits** | Enforce maximum file size (recommended: 2MB) |
| **Dimension Limits** | Limit maximum resolution to prevent DoS attacks |
| **File Name Sanitization** | Use controlled naming pattern (e.g., `user_{id}.ext`) |
| **Storage Isolation** | Keep avatars separate from executable code |
| **Directory Permissions** | Write-only for uploads, read-only for retrieval |
| **XSS Prevention** | Set proper Content-Type headers when serving images |

**Sources:** Based on security best practices and module architecture

---

## API Integration Points

While the Avatar Module's `index.php` is currently empty, avatar functionality is likely exposed through the main application's API endpoints.

### Expected API Endpoints

Based on the system's API architecture (see [AJAX API Endpoints](#9.2)), avatar operations would typically be accessed through:

| Operation | Endpoint Pattern | Method | Purpose |
|-----------|-----------------|--------|---------|
| Upload Avatar | `/index.php` (POST) | `UsuarioAvatarAdd` | Upload new avatar image |
| Update Avatar | `/index.php` (POST) | `UsuarioAvatarMod` | Replace existing avatar |
| Delete Avatar | `/index.php` (POST) | `UsuarioAvatarRm` | Remove avatar, revert to default |
| Get Avatar URL | `/index.php` (GET/POST) | `UsuarioAvatarGet` | Retrieve avatar URL or path |

### REST API Integration

For REST API access (see [REST API Endpoints](#9.1)), avatar operations would use Bearer token authentication:

```
POST /index.php/api/avatar/upload
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Sources:** Based on high-level architecture Diagrams 2 and 3

---

## File Processing Workflow

The expected avatar processing workflow involves multiple stages from upload to storage:

### Complete Processing Pipeline

```mermaid
graph TB
    START["User Uploads Avatar"]
    
    subgraph "Validation Stage"
        V1["Authenticate User"]
        V2["Validate File Type"]
        V3["Check File Size"]
        V4["Verify Image Content"]
    end
    
    subgraph "Processing Stage"
        P1["Generate Unique Filename<br/>user_{id}.{ext}"]
        P2["Create Thumbnail<br/>redimensionImg2()"]
        P3["Optimize Original<br/>Optional compression"]
    end
    
    subgraph "Storage Stage"
        S1["Save to repo/avatar/<br/>original/"]
        S2["Save to repo/avatar/<br/>thumbs/"]
        S3["Update Database Record<br/>avatar_url field"]
    end
    
    subgraph "Cleanup Stage"
        C1["Remove Old Avatar<br/>If exists"]
        C2["Clear Temp Files"]
    end
    
    SUCCESS["Return Success<br/>+ Avatar URL"]
    
    START --> V1
    V1 --> V2
    V2 --> V3
    V3 --> V4
    V4 --> P1
    P1 --> P2
    P2 --> P3
    P3 --> S1
    S1 --> S2
    S2 --> S3
    S3 --> C1
    C1 --> C2
    C2 --> SUCCESS
```

**Diagram: Avatar Upload and Processing Pipeline**

**Sources:** Based on file operations described in Diagram 3

---

## Database Integration

Avatar file paths are typically stored in the database alongside user records, establishing the link between users and their avatar images.

### Expected Database Schema

While the Avatar Module handles file storage, user avatar URLs are likely stored in user-related tables:

| Table | Field | Type | Purpose |
|-------|-------|------|---------|
| `userselecto` | `avatar_url` | VARCHAR(255) | Path to user's avatar image |
| `userselecto` | `avatar_thumb` | VARCHAR(255) | Path to thumbnail version |
| `userselecto` | `avatar_updated` | DATETIME | Last modification timestamp |

### Database Update Pattern

```mermaid
sequenceDiagram
    participant FileOps as "File Operations"
    participant AvatarDir as "repo/avatar/"
    participant Singleton
    participant DB as "Database"
    
    FileOps->>AvatarDir: "Save image files"
    AvatarDir-->>FileOps: "File paths"
    FileOps->>Singleton: "_safeUpdate()<br/>Update user record"
    Singleton->>DB: "UPDATE userselecto<br/>SET avatar_url = ?"
    DB-->>Singleton: "Success"
    Singleton-->>FileOps: "Database updated"
```

**Diagram: Database Update After Avatar Upload**

**Sources:** Based on data layer architecture from Diagram 4

---

## Implementation Recommendations

Given the current minimal implementation, the following recommendations apply for full Avatar Module functionality:

### Option 1: Centralized Approach (Current Pattern)

Keep avatar operations in [OperacionesCtrl](#4.1) and use the `repo/avatar/` directory purely for storage:

**Advantages:**
- Consistent with existing architecture
- Centralized security and validation
- Reuses existing file operation methods

**Implementation:**
- Add avatar-specific methods to `OperacionesCtrl`
- Use `SubirArchivo()` and `redimensionImg2()` for processing
- Store files in `repo/avatar/` directory structure

### Option 2: Module-Based Approach

Implement routing and operations within [repo/avatar/index.php]():

**Advantages:**
- Module isolation and independence
- Clearer separation of concerns
- Easier to maintain and test

**Implementation:**
```
repo/avatar/index.php:
- Route requests based on action parameter
- Implement upload, delete, retrieve operations
- Handle authentication and authorization
- Return JSON responses
```

### Option 3: Hybrid Approach

Use `index.php` for direct file serving with permission checks, while keeping upload/modification in core controllers:

**Advantages:**
- Fine-grained access control
- Efficient file serving
- Security at the file level

**Implementation:**
```
repo/avatar/index.php:
- Check user permissions
- Validate requested file exists
- Serve file with proper headers
- Log access for auditing
```

**Sources:** Based on module architecture pattern from Diagram 5

---

## Configuration and Maintenance

### Directory Permissions

Proper filesystem permissions are critical for secure avatar management:

| Directory/File | Recommended Permission | Owner | Purpose |
|----------------|----------------------|-------|---------|
| `repo/avatar/` | `755` (drwxr-xr-x) | www-data | Read/execute for serving |
| `repo/avatar/original/` | `755` | www-data | Write access for uploads |
| `repo/avatar/thumbs/` | `755` | www-data | Write access for thumbnails |
| `repo/avatar/*.jpg` | `644` (-rw-r--r--) | www-data | Read access for serving |

### Storage Management

Consider implementing the following maintenance operations:

| Operation | Frequency | Purpose |
|-----------|-----------|---------|
| Orphan Cleanup | Weekly | Remove avatars for deleted users |
| Size Monitoring | Daily | Alert on excessive storage growth |
| Backup | Daily | Include in database backup routine |
| Temp Cleanup | Hourly | Remove abandoned upload attempts |

**Sources:** Based on security best practices

---

## Related Components

The Avatar Module interacts with or is related to the following system components:

| Component | Relationship | Reference |
|-----------|--------------|-----------|
| **OperacionesCtrl** | Delegates file operations | [Section 4.1](#4.1) |
| **Users Module** | User-specific data storage | [Section 7.6](#7.6) |
| **User Management APIs** | Profile update operations | [Section 9.3](#9.3) |
| **Singleton** | Database operations | [Section 5.1](#5.1) |
| **Security System** | Authentication/authorization | [Section 10](#10) |

**Sources:** Based on system architecture overview

---

## Summary

The Avatar Module (`repo/avatar/`) is a storage-focused component of the repository module system designed to manage user profile images. Currently implemented as a minimal entry point with Git-ignored runtime data storage, the module follows the standardized plugin architecture pattern used throughout the `repo/` directory structure.

Key characteristics:
- **Entry Point:** [repo/avatar/index.php]() (currently empty)
- **Storage Pattern:** Git-ignored runtime data for uploaded images
- **Integration:** File operations delegated to [OperacionesCtrl](#4.1)
- **Security:** Requires authentication, authorization, and file validation
- **Access:** Direct web server or PHP-controlled retrieval

The minimal current implementation suggests avatar functionality is either handled by core controllers, pending future development, or accessed through direct file serving by the web server.

**Sources:** [.gitignore:17](), [.gitignore:25](), [repo/avatar/index.php:1-2]()

---

---

## 7.3 Communication Module (com)

## Purpose and Scope

This document describes the Communication Module (`com`), located at `repo/com/`. This module is part of the repository module system and follows the standard plugin-like architecture pattern where only the entry point is tracked in version control while runtime data is ignored. The module appears to be designed for communication-related operations or common utilities, though its implementation is currently minimal.

For information about other modules in the system, see:
- Anexos Module [7.1](#7.1)
- Avatar Module [7.2](#7.2)
- Processing Module [7.4](#7.4)
- Resources Module [7.5](#7.5)
- Users Module [7.6](#7.6)

For general module system architecture, see Module System [7](#7).

---

## Module Architecture

### File Structure and Version Control Pattern

The `com` module follows the standard repository module pattern with strict separation between tracked code and runtime data:

```mermaid
graph TB
    subgraph "repo/com/ Directory"
        ENTRY["index.php<br/>(TRACKED)"]
        DATA["Runtime Data<br/>(IGNORED)"]
    end
    
    subgraph "Version Control"
        GIT[".gitignore"]
    end
    
    subgraph "Ignored Patterns"
        IGNORE_ALL["repo/com/*<br/>Ignore all files"]
        EXCEPT["!repo/com/index.php<br/>Exception: Track entry point"]
    end
    
    GIT --> IGNORE_ALL
    GIT --> EXCEPT
    
    IGNORE_ALL -.->|"blocks"| DATA
    EXCEPT -.->|"allows"| ENTRY
    
    ENTRY -.->|"may generate"| DATA
```

**Diagram: Version Control Architecture for com Module**

The `.gitignore` configuration explicitly defines this pattern:
- Line 19: `repo/com/*` - Ignores all files in the com directory
- Line 27: `!repo/com/index.php` - Exception to track the entry point

This architecture ensures:
1. **Code/Data Separation**: Application logic is versioned while runtime data is not
2. **Security**: Prevents accidental commits of generated files or sensitive data
3. **Module Isolation**: Each module operates independently in its own directory
4. **Multi-Environment Support**: Same codebase can work across different environments with different runtime data

**Sources:** [.gitignore:16-29]()

---

## Current Implementation Status

### Entry Point Analysis

The module's entry point is currently minimal:

```mermaid
graph LR
    REQUEST["HTTP Request"] --> ENTRY["repo/com/index.php"]
    ENTRY --> EMPTY["Empty PHP Block<br/><?php ?>"]
    EMPTY --> RESPONSE["No Output"]
```

**Diagram: Current Request Flow**

The [repo/com/index.php:1-3]() file contains only an empty PHP block with no implementation:

| Line | Content |
|------|---------|
| 1 | `<?php` |
| 2 | `?>` |
| 3 | (empty) |

This empty implementation suggests one of several scenarios:

1. **Planned Module**: Reserved for future communication features
2. **Delegated Routing**: Relies on parent application routing rather than direct access
3. **Incomplete Migration**: Part of an unfinished refactoring effort
4. **Runtime-Only Module**: All functionality may be in ignored runtime files

**Sources:** [repo/com/index.php:1-3]()

---

## Integration with Application Architecture

### Module Access Patterns

```mermaid
graph TB
    subgraph "Application Entry Points"
        INDEX["index.php<br/>Main Application"]
        HOME["home.php<br/>Home Application"]
    end
    
    subgraph "Module System"
        REPO_ROOT["repo/<br/>Module Root"]
        COM_MODULE["repo/com/<br/>Communication Module"]
        COM_INDEX["repo/com/index.php<br/>Entry Point"]
    end
    
    subgraph "Possible Access Routes"
        DIRECT["Direct HTTP Request<br/>repo/com/index.php"]
        ROUTED["Routed by Controllers<br/>include/require"]
        API["API Endpoint<br/>via IndexCtrl"]
    end
    
    INDEX -.->|"may include"| REPO_ROOT
    HOME -.->|"may include"| REPO_ROOT
    REPO_ROOT --> COM_MODULE
    COM_MODULE --> COM_INDEX
    
    DIRECT -.->|"direct access"| COM_INDEX
    ROUTED -.->|"programmatic"| COM_INDEX
    API -.->|"via API"| COM_INDEX
    
    style COM_INDEX fill:#ccffcc
```

**Diagram: Module Integration Points**

The `com` module can potentially be accessed through multiple routes:

1. **Direct HTTP Access**: Web server routing directly to `repo/com/index.php`
2. **Controller Routing**: Main controllers (`IndexCtrl`, `HomeCtrl`) may route requests to the module
3. **Programmatic Inclusion**: Other modules or components may `include` or `require` the entry point
4. **API Endpoints**: Could be exposed through REST or AJAX API endpoints

**Sources:** [.gitignore:19](), [.gitignore:27]()

---

## Potential Use Cases

### Communication Module Interpretations

Based on the module name "com", this module could serve several purposes:

| Interpretation | Potential Functionality | Related System Components |
|----------------|------------------------|---------------------------|
| **Communication** | Email, SMS, or notification handling | `OperacionesCtrl::enviar_Notificacion()`<br/>PHPMailer library |
| **Common Utilities** | Shared helper functions or utilities | Utility classes in `src/utiles/` |
| **Component Library** | Reusable UI components | HTML partials in `src/html/` |
| **Communication Protocols** | API endpoints for external integrations | `Rest` handler, API endpoints |
| **Comment System** | User comments or feedback functionality | Database tables for comments |

The most likely interpretations given the system's architecture:

1. **Communication Hub**: Centralized messaging/notification coordination
2. **Common Module**: Shared utilities used across other modules
3. **Component Storage**: Runtime data for communication features

**Sources:** [.gitignore:19](), [.gitignore:27]()

---

## Module File System Expectations

### Expected Directory Structure

Based on the module pattern observed in other repo modules, the `com` module likely contains or will contain:

```mermaid
graph TB
    subgraph "repo/com/ Structure"
        INDEX["index.php<br/>(Tracked Entry Point)"]
        
        subgraph "Runtime Data (Ignored)"
            UPLOADS["uploads/<br/>User Uploaded Files"]
            CACHE["cache/<br/>Temporary Cache"]
            LOGS["logs/<br/>Operation Logs"]
            GENERATED["generated/<br/>Generated Files"]
            CONFIG["config/<br/>Runtime Config"]
        end
    end
    
    INDEX -.->|"may create"| UPLOADS
    INDEX -.->|"may create"| CACHE
    INDEX -.->|"may create"| LOGS
    INDEX -.->|"may create"| GENERATED
    INDEX -.->|"may read/write"| CONFIG
    
    style INDEX fill:#ccffcc
    style UPLOADS fill:#ffcccc
    style CACHE fill:#ffcccc
    style LOGS fill:#ffcccc
    style GENERATED fill:#ffcccc
    style CONFIG fill:#ffcccc
```

**Diagram: Expected File System Structure**

Common subdirectories that may exist (all ignored by Git):

| Directory | Purpose | Typical Contents |
|-----------|---------|------------------|
| `uploads/` | User uploaded communication files | Attachments, documents, media |
| `cache/` | Temporary processing cache | Rendered templates, API responses |
| `logs/` | Communication operation logs | Email logs, API calls, errors |
| `generated/` | Generated communication content | Rendered emails, PDFs, reports |
| `config/` | Runtime configuration | User preferences, feature flags |
| `temp/` | Temporary working files | Processing intermediates |

**Sources:** [.gitignore:19](), [.gitignore:27]()

---

## Comparison with Other Modules

### Module Pattern Consistency

```mermaid
graph TB
    subgraph "Tracked Entry Points"
        COM["repo/com/index.php"]
        ANEXOS["repo/anexos/index.php"]
        AVATAR["repo/avatar/index.php"]
        PROC["repo/proc/index.php"]
        RECURSOS["repo/recursos/index.php"]
        USUARIOS["repo/usuarios/index.php"]
    end
    
    subgraph "Ignored Runtime Data"
        COM_DATA["repo/com/*"]
        ANEXOS_DATA["repo/anexos/*"]
        AVATAR_DATA["repo/avatar/*"]
        PROC_DATA["repo/proc/*"]
        RECURSOS_DATA["repo/recursos/*"]
        USUARIOS_DATA["repo/usuarios/*"]
    end
    
    COM --> COM_DATA
    ANEXOS --> ANEXOS_DATA
    AVATAR --> AVATAR_DATA
    PROC --> PROC_DATA
    RECURSOS --> RECURSOS_DATA
    USUARIOS --> USUARIOS_DATA
    
    style COM fill:#ccffcc
    style ANEXOS fill:#ccffcc
    style AVATAR fill:#ccffcc
    style PROC fill:#ccffcc
    style RECURSOS fill:#ccffcc
    style USUARIOS fill:#ccffcc
    
    style COM_DATA fill:#ffcccc
    style ANEXOS_DATA fill:#ffcccc
    style AVATAR_DATA fill:#ffcccc
    style PROC_DATA fill:#ffcccc
    style RECURSOS_DATA fill:#ffcccc
    style USUARIOS_DATA fill:#ffcccc
```

**Diagram: Module Pattern Across Repository System**

The `com` module follows the exact same architectural pattern as all other repository modules:

| Module | Entry Point Status | Implementation Status | Known Purpose |
|--------|-------------------|----------------------|---------------|
| `anexos` | Tracked (empty) | Minimal | Attachment management |
| `avatar` | Tracked (empty) | Minimal | User profile images |
| `proc` | Tracked (empty) | Minimal | Processing operations |
| **`com`** | **Tracked (empty)** | **Minimal** | **Communication/common** |
| `recursos` | Tracked (empty) | Minimal | Resource file management |
| `usuarios` | Tracked (empty) | Minimal | User-specific data |

All modules share:
- Empty or minimal `index.php` entry points
- Complete `.gitignore` coverage for runtime data
- Independent directory isolation
- Plugin-like extensibility

**Sources:** [.gitignore:16-29]()

---

## Implementation Considerations

### For Future Development

When implementing functionality in the `com` module, developers should consider:

#### 1. Entry Point Implementation Options

```mermaid
graph TB
    ENTRY["repo/com/index.php"]
    
    subgraph "Implementation Patterns"
        BOOTSTRAP["Bootstrap Pattern<br/>Load dependencies<br/>Route to handlers"]
        DIRECT["Direct Processing<br/>Execute operations<br/>Output response"]
        DELEGATE["Delegation Pattern<br/>Forward to controllers<br/>Return control"]
    end
    
    ENTRY --> BOOTSTRAP
    ENTRY --> DIRECT
    ENTRY --> DELEGATE
    
    BOOTSTRAP --> DEPS["Load Dependencies"]
    BOOTSTRAP --> ROUTE["Route Request"]
    BOOTSTRAP --> AUTH["Authenticate"]
    
    DIRECT --> PROCESS["Process Request"]
    DIRECT --> RESPOND["Generate Response"]
    
    DELEGATE --> LOAD["Include Core"]
    DELEGATE --> FORWARD["Call Controllers"]
    DELEGATE --> EXIT["Return/Exit"]
```

**Diagram: Possible Implementation Patterns**

#### 2. Runtime Data Management

| Concern | Recommendation |
|---------|---------------|
| **File Organization** | Create subdirectories for different data types |
| **Permissions** | Ensure web server has write access to runtime directories |
| **Cleanup** | Implement periodic cleanup of temporary files |
| **Security** | Validate all file paths, prevent directory traversal |
| **Backup** | Runtime data is not backed up by Git; implement separate backup strategy |

#### 3. Integration Points

Potential integration with existing system components:

```mermaid
graph TB
    COM["com Module"]
    
    subgraph "Data Layer"
        SINGLETON["Singleton<br/>Database Access"]
        MODELS["Data Models<br/>src/modelo/*"]
    end
    
    subgraph "Business Logic"
        OPCTRL["OperacionesCtrl<br/>Core Operations"]
        OPHOMECTRL["OperacionesHomeCtrl<br/>Home Operations"]
    end
    
    subgraph "Libraries"
        PHPMAILER["PHPMailer<br/>Email Sending"]
        APIBOX["ApiboxLib<br/>API Keys"]
        MAGIC["MagicPagesLib<br/>Temp Pages"]
    end
    
    COM --> SINGLETON
    COM --> MODELS
    COM --> OPCTRL
    COM --> OPHOMECTRL
    COM --> PHPMAILER
    COM --> APIBOX
    COM --> MAGIC
```

**Diagram: Potential Integration Points**

**Sources:** [.gitignore:19](), [.gitignore:27]()

---

## Security Considerations

### Module Security Pattern

```mermaid
graph TB
    REQUEST["HTTP Request"] --> ENTRY["repo/com/index.php"]
    
    subgraph "Security Checks"
        AUTH["Authentication<br/>Verify user session"]
        AUTHZ["Authorization<br/>Check permissions"]
        INPUT["Input Validation<br/>Sanitize data"]
        PATH["Path Validation<br/>Prevent traversal"]
    end
    
    subgraph "Protected Operations"
        READ["Read Runtime Data"]
        WRITE["Write Runtime Data"]
        EXEC["Execute Operations"]
    end
    
    ENTRY --> AUTH
    AUTH --> AUTHZ
    AUTHZ --> INPUT
    INPUT --> PATH
    
    PATH --> READ
    PATH --> WRITE
    PATH --> EXEC
    
    AUTH -.->|"failed"| REJECT["Reject Request"]
    AUTHZ -.->|"failed"| REJECT
    INPUT -.->|"invalid"| REJECT
    PATH -.->|"invalid"| REJECT
```

**Diagram: Security Check Flow**

Key security considerations for the `com` module:

| Security Aspect | Recommendation |
|----------------|----------------|
| **Authentication** | Verify user session before processing requests |
| **Authorization** | Check user permissions for specific operations |
| **Input Validation** | Sanitize and validate all input parameters |
| **File Access** | Restrict access to module directory only |
| **Path Traversal** | Validate file paths, prevent `../` attacks |
| **File Upload** | Validate file types, scan for malware |
| **Output Encoding** | Encode output to prevent XSS attacks |
| **Error Handling** | Don't expose sensitive information in errors |

**Sources:** [.gitignore:19](), [.gitignore:27]()

---

## Module Metadata

### Basic Information

| Property | Value |
|----------|-------|
| **Module Path** | `repo/com/` |
| **Entry Point** | `repo/com/index.php` |
| **Entry Point Status** | Empty (lines 1-3) |
| **Version Control** | Entry point tracked, all other files ignored |
| **Module Type** | Repository module (plugin-like) |
| **Current State** | Minimal/Placeholder |
| **Dependencies** | Unknown (not implemented) |

### Git Configuration

| Configuration | Source | Line Reference |
|--------------|--------|----------------|
| Ignore all files | `.gitignore` | [.gitignore:19]() |
| Track entry point | `.gitignore` | [.gitignore:27]() |

**Sources:** [.gitignore:19](), [.gitignore:27](), [repo/com/index.php:1-3]()

---

## Development Roadmap

### Next Steps for Implementation

For developers looking to implement functionality in the `com` module:

1. **Define Module Purpose**
   - Determine specific communication features needed
   - Or define common utilities to be shared
   - Document intended use cases

2. **Implement Entry Point**
   - Add authentication checks
   - Implement request routing
   - Add error handling
   - Document API/interface

3. **Create Runtime Structure**
   - Define subdirectory organization
   - Set appropriate permissions
   - Implement data management logic

4. **Integrate with System**
   - Connect to database via `Singleton`
   - Use business logic from `OperacionesCtrl`
   - Integrate with existing libraries
   - Add API endpoints if needed

5. **Document Implementation**
   - Update this wiki page with actual implementation
   - Document API endpoints
   - Provide usage examples
   - Add troubleshooting guide

**Sources:** [repo/com/index.php:1-3]()

---

## Conclusion

The Communication Module (`com`) follows the standard repository module architecture pattern with a tracked entry point and ignored runtime data. Currently, the module contains only an empty PHP entry point, indicating it is either a placeholder for future development or relies entirely on runtime-generated content. 

The module's architecture provides a clean separation between versioned code and runtime data, supporting secure multi-environment deployments while maintaining module isolation. Once implemented, this module could serve various communication-related functions or provide common utilities shared across the application.

For implementation guidance, developers should reference the module system architecture [7](#7) and follow established patterns from other implemented modules.

**Sources:** [.gitignore:16-29](), [repo/com/index.php:1-3]()

---

---

## 7.4 Processing Module (proc)

## Purpose and Scope

The Processing Module (`proc`) is part of GESFINANCIERO's repository module system (`repo/`), designed to handle processing operations and store procedure-related runtime data. This module follows the standard repository pattern where only the entry point is version-controlled, while all runtime data, processing outputs, and temporary files are excluded from version control.

For information about other repository modules, see:
- **Anexos Module** for attachment management [7.1](#7.1)
- **Avatar Module** for user profile images [7.2](#7.2)
- **Communication Module** for communications utilities [7.3](#7.3)

For general information about the repository module architecture, see **Module System** [7](#7).

**Sources:** [.gitignore:1-30](), Overall architecture context

---

## Module Architecture

The `proc` module follows GESFINANCIERO's standard repository module pattern, implementing a clear separation between tracked code and ignored runtime data.

### Directory Structure

```
repo/proc/
├── index.php          (tracked in version control)
└── [runtime data]     (ignored in version control)
```

### Version Control Strategy

The module's version control configuration is defined in `.gitignore`:

| Pattern | Rule | Purpose |
|---------|------|---------|
| `repo/proc/*` | Ignore all files | Exclude runtime processing data, outputs, temporary files, and user-generated content |
| `!repo/proc/index.php` | Track exception | Explicitly version-control the module entry point |

This pattern ensures that:
- **Code separation:** Application logic remains version-controlled
- **Data isolation:** Processing artifacts and runtime data stay local to each environment
- **Security:** Sensitive processing data isn't accidentally committed to the repository
- **Deployment flexibility:** Different environments can maintain independent processing data

**Sources:** [.gitignore:18,26]()

---

## Module Entry Point Structure

```mermaid
graph TB
    subgraph "Version Control Boundary"
        ENTRY["repo/proc/index.php<br/>(Tracked)"]
    end
    
    subgraph "Runtime Data Boundary"
        PROC_DATA["Processing Files<br/>(Ignored)"]
        TEMP_FILES["Temporary Files<br/>(Ignored)"]
        OUTPUT_DATA["Output Data<br/>(Ignored)"]
        CACHE_DATA["Cache Data<br/>(Ignored)"]
    end
    
    subgraph "Application Layer"
        CONTROLLERS["Controllers<br/>IndexCtrl, OperacionesCtrl"]
        MAIN_ENTRY["index.php<br/>Main Entry Point"]
    end
    
    MAIN_ENTRY -.->|"May route to"| ENTRY
    CONTROLLERS -.->|"May access"| ENTRY
    
    ENTRY -->|"Generates/manages"| PROC_DATA
    ENTRY -->|"Creates"| TEMP_FILES
    ENTRY -->|"Produces"| OUTPUT_DATA
    ENTRY -->|"Maintains"| CACHE_DATA
    
    style ENTRY fill:#ccffcc
    style PROC_DATA fill:#ffcccc
    style TEMP_FILES fill:#ffcccc
    style OUTPUT_DATA fill:#ffcccc
    style CACHE_DATA fill:#ffcccc
```

**Diagram: Processing Module Architecture and Data Flow**

**Sources:** [.gitignore:18,26](), [repo/proc/index.php:1-2]()

---

## Entry Point Implementation

### Current State

The `proc` module's entry point is currently minimal:

[repo/proc/index.php:1-2]()

The file contains only an empty PHP block, indicating that:
1. The module structure has been established
2. Implementation details are either pending or handled dynamically
3. The module may be accessed through indirect routing rather than direct execution

### Standard Module Entry Point Pattern

Based on the repository module architecture, the typical entry point pattern would include:

| Component | Purpose |
|-----------|---------|
| **Environment bootstrapping** | Load core application dependencies and configuration |
| **Authentication check** | Verify user permissions for processing operations |
| **Request routing** | Dispatch to specific processing handlers based on parameters |
| **Error handling** | Catch and log processing errors |
| **Response formatting** | Return processing results in appropriate format (JSON, files, etc.) |

**Sources:** [repo/proc/index.php:1-2]()

---

## Runtime Data Management

### Data Storage Patterns

The `.gitignore` configuration excludes all files except `index.php`, indicating that the module manages various types of runtime data:

```mermaid
graph LR
    subgraph "Processing Module Storage"
        INPUT["Input Files"]
        PROCESSING["In-Progress Data"]
        OUTPUT["Output Files"]
        TEMP["Temporary Files"]
        LOGS["Processing Logs"]
        CACHE["Cached Results"]
    end
    
    subgraph "External Systems"
        CONTROLLERS["Application Controllers"]
        DATABASE["Database<br/>nuevapp_apps"]
        FILEUPLOAD["User Uploads"]
    end
    
    CONTROLLERS -->|"Submit jobs"| INPUT
    FILEUPLOAD -->|"Raw data"| INPUT
    
    INPUT -->|"Begin processing"| PROCESSING
    PROCESSING -->|"Store intermediate"| TEMP
    PROCESSING -->|"Record events"| LOGS
    PROCESSING -->|"Complete"| OUTPUT
    
    OUTPUT -->|"Reference metadata"| DATABASE
    PROCESSING -->|"Store results"| CACHE
    
    CONTROLLERS -->|"Retrieve"| OUTPUT
    CONTROLLERS -->|"Check"| CACHE
```

**Diagram: Processing Module Data Flow and Storage**

### Typical Data Categories

| Data Type | Description | Lifecycle | Security Consideration |
|-----------|-------------|-----------|------------------------|
| **Input files** | Raw data submitted for processing | Temporary, deleted after processing | May contain sensitive information |
| **Processing artifacts** | Intermediate files during operations | Temporary, cleaned up on completion | Should be isolated per user/session |
| **Output files** | Completed processing results | Persistent until retrieved/expired | Access should be authenticated |
| **Temporary files** | Scratch space for algorithms | Very short-lived, cleaned up immediately | Should not persist sensitive data |
| **Processing logs** | Operation tracking and debugging | Persistent for auditing | Should not log sensitive payloads |
| **Cache data** | Optimization for repeated operations | Time-limited, refreshed as needed | Should implement expiration |

**Sources:** [.gitignore:18,26]()

---

## Integration with Core Application

### Access Patterns

```mermaid
graph TB
    subgraph "Entry Points"
        MAIN["index.php"]
        HOME["home.php"]
    end
    
    subgraph "Controllers"
        INDEXCTRL["IndexCtrl"]
        OPCTRL["OperacionesCtrl"]
        REST["Rest API Handler"]
    end
    
    subgraph "Processing Module"
        PROC_ENTRY["repo/proc/index.php"]
        
        subgraph "Potential Processing Operations"
            PROC_BATCH["Batch Processing"]
            PROC_ASYNC["Async Jobs"]
            PROC_IMPORT["Data Import/Export"]
            PROC_TRANSFORM["Data Transformation"]
            PROC_VALIDATION["Data Validation"]
        end
    end
    
    subgraph "Data Layer"
        SINGLETON["Singleton<br/>DB Connection"]
        DATABASE["Database<br/>nuevapp_apps"]
    end
    
    MAIN --> INDEXCTRL
    HOME --> INDEXCTRL
    
    INDEXCTRL -->|"Direct routing"| PROC_ENTRY
    INDEXCTRL -->|"Delegates to"| OPCTRL
    OPCTRL -->|"May invoke"| PROC_ENTRY
    REST -->|"API calls"| OPCTRL
    
    PROC_ENTRY --> PROC_BATCH
    PROC_ENTRY --> PROC_ASYNC
    PROC_ENTRY --> PROC_IMPORT
    PROC_ENTRY --> PROC_TRANSFORM
    PROC_ENTRY --> PROC_VALIDATION
    
    PROC_BATCH --> SINGLETON
    PROC_ASYNC --> SINGLETON
    PROC_IMPORT --> SINGLETON
    PROC_TRANSFORM --> SINGLETON
    PROC_VALIDATION --> SINGLETON
    
    SINGLETON --> DATABASE
```

**Diagram: Processing Module Integration with Core Application**

### Potential Use Cases

Based on the module's name and position in the architecture, likely processing operations include:

1. **Batch Operations**
   - Bulk user imports/exports
   - Mass data updates
   - Report generation for large datasets

2. **Asynchronous Processing**
   - Long-running operations that don't block the UI
   - Background job execution
   - Scheduled task processing

3. **Data Transformation**
   - Format conversions (CSV to JSON, Excel to database)
   - Image processing and optimization
   - Document parsing and extraction

4. **Import/Export Operations**
   - Database backup/restore procedures
   - Data migration between systems
   - External system integration

5. **Validation and Analysis**
   - Data quality checks
   - Duplicate detection
   - Referential integrity validation

**Sources:** [repo/proc/index.php:1-2](), Overall architecture context

---

## Implementation Status and Patterns

### Current Implementation

The processing module is currently in a minimal state:

```php
<?php
?>
```

[repo/proc/index.php:1-2]()

This empty implementation suggests one of the following scenarios:

| Scenario | Implications |
|----------|--------------|
| **Placeholder** | Module structure created but functionality not yet implemented |
| **Dynamic routing** | Processing operations accessed indirectly through `IndexCtrl` or `OperacionesCtrl` |
| **Future extension point** | Reserved for planned features not yet developed |
| **Legacy remnant** | Previously used but functionality migrated to core controllers |

### Common Module Implementation Pattern

Based on other GESFINANCIERO modules, a typical implementation would follow this pattern:

```mermaid
graph TB
    REQUEST["HTTP Request"]
    
    subgraph "Module Entry Point"
        BOOTSTRAP["1. Bootstrap Environment<br/>Load dependencies"]
        AUTH["2. Authentication<br/>Verify access"]
        VALIDATE["3. Validate Parameters<br/>Check inputs"]
        ROUTE["4. Route Request<br/>Determine operation"]
        EXECUTE["5. Execute Operation<br/>Process request"]
        RESPOND["6. Format Response<br/>Return result"]
    end
    
    subgraph "Module Operations"
        OP_A["Operation A"]
        OP_B["Operation B"]
        OP_C["Operation C"]
    end
    
    ERROR["Error Handler"]
    LOGGER["Logging System"]
    
    REQUEST --> BOOTSTRAP
    BOOTSTRAP --> AUTH
    AUTH -->|"Authorized"| VALIDATE
    AUTH -->|"Unauthorized"| ERROR
    VALIDATE -->|"Valid"| ROUTE
    VALIDATE -->|"Invalid"| ERROR
    ROUTE --> OP_A
    ROUTE --> OP_B
    ROUTE --> OP_C
    OP_A --> EXECUTE
    OP_B --> EXECUTE
    OP_C --> EXECUTE
    EXECUTE --> RESPOND
    
    BOOTSTRAP -.-> LOGGER
    AUTH -.-> LOGGER
    EXECUTE -.-> LOGGER
    ERROR -.-> LOGGER
    
    RESPOND --> REQUEST
    ERROR --> REQUEST
```

**Diagram: Standard Module Implementation Pattern**

### File System Organization

If the module were fully implemented, the typical file system structure would be:

```
repo/proc/
├── index.php                  (Entry point - tracked)
├── uploads/                   (Uploaded files for processing)
├── processing/                (Files currently being processed)
├── completed/                 (Successfully processed files)
├── failed/                    (Failed processing attempts)
├── temp/                      (Temporary working directory)
├── cache/                     (Cached processing results)
└── logs/                      (Processing operation logs)
    ├── YYYY-MM-DD.log         (Daily log files)
    └── errors.log             (Error-specific logging)
```

All directories except `index.php` would be ignored by version control as specified in [.gitignore:18,26]().

**Sources:** [.gitignore:18,26](), [repo/proc/index.php:1-2]()

---

## Security Considerations

### Access Control

Since the module handles processing operations that may affect system data:

| Security Measure | Implementation Requirement |
|------------------|---------------------------|
| **Authentication** | All processing operations should verify user identity |
| **Authorization** | Check user permissions before allowing processing operations |
| **Input validation** | Sanitize all parameters before processing |
| **File type restrictions** | Limit allowed file types for uploads |
| **Size limits** | Enforce maximum file size constraints |
| **Path traversal prevention** | Validate file paths to prevent directory traversal attacks |

### Data Isolation

Processing data should be isolated by user or session:

```mermaid
graph TB
    subgraph "User Session A"
        USER_A["User A"]
        SESSION_A["Session: abc123"]
        DATA_A["repo/proc/abc123/"]
        FILES_A["Processing Files"]
    end
    
    subgraph "User Session B"
        USER_B["User B"]
        SESSION_B["Session: xyz789"]
        DATA_B["repo/proc/xyz789/"]
        FILES_B["Processing Files"]
    end
    
    subgraph "Access Control"
        AUTH_CHECK["Authentication Check"]
        PERMISSION_CHECK["Permission Verification"]
    end
    
    USER_A --> SESSION_A
    USER_B --> SESSION_B
    
    SESSION_A --> AUTH_CHECK
    SESSION_B --> AUTH_CHECK
    
    AUTH_CHECK --> PERMISSION_CHECK
    
    PERMISSION_CHECK -->|"Authorized"| DATA_A
    PERMISSION_CHECK -->|"Authorized"| DATA_B
    
    DATA_A --> FILES_A
    DATA_B --> FILES_B
    
    DATA_A -.->|"Cannot access"| DATA_B
    DATA_B -.->|"Cannot access"| DATA_A
```

**Diagram: User Data Isolation in Processing Module**

### File System Security

The ignored data pattern provides inherent security benefits:

1. **No credential leakage:** Processing data never committed to version control
2. **Environment isolation:** Each deployment maintains separate processing data
3. **Sensitive data protection:** User uploads and processing results stay local
4. **Audit capability:** Processing logs can track operations without exposing data

**Sources:** [.gitignore:18,26]()

---

## Relationship to Other Modules

The `proc` module exists within a family of repository modules with complementary purposes:

| Module | Directory | Purpose | Relationship to `proc` |
|--------|-----------|---------|------------------------|
| **Anexos** | `repo/anexos/` | Attachment management | May process attachments before storage |
| **Avatar** | `repo/avatar/` | User profile images | May process/resize images |
| **Communication** | `repo/com/` | Communication utilities | May process message data |
| **Resources** | `repo/recursos/` | Static resource files | May generate or transform resources |
| **Users** | `repo/usuarios/` | User-specific data | May process user data operations |
| **Corporate** | `repo/corp/` | Corporate configuration | May process corporate data |

### Module Interaction Pattern

```mermaid
graph LR
    subgraph "Input Modules"
        ANEXOS["Anexos<br/>Attachments"]
        AVATAR["Avatar<br/>Images"]
        USUARIOS["Usuarios<br/>User Data"]
    end
    
    PROC["Processing<br/>proc"]
    
    subgraph "Output Modules"
        RECURSOS["Recursos<br/>Resources"]
        COM["Com<br/>Communications"]
    end
    
    CONTROLLERS["Core Controllers<br/>IndexCtrl, OperacionesCtrl"]
    
    ANEXOS -->|"Raw files"| PROC
    AVATAR -->|"Images"| PROC
    USUARIOS -->|"User data"| PROC
    
    PROC -->|"Processed output"| RECURSOS
    PROC -->|"Results"| COM
    
    CONTROLLERS -->|"Orchestrates"| PROC
```

**Diagram: Processing Module in Repository Module Ecosystem**

**Sources:** [.gitignore:16-29](), Overall module system context

---

## Development and Extension

### Implementing Processing Operations

To extend the processing module with actual functionality, developers should:

1. **Maintain entry point simplicity:** Keep `index.php` focused on routing
2. **Create operation handlers:** Implement specific processing logic in separate classes
3. **Follow data isolation:** Organize processed files by user/session
4. **Implement cleanup:** Add routines to remove expired temporary files
5. **Add logging:** Track processing operations for debugging and auditing
6. **Handle errors gracefully:** Provide meaningful error messages and recovery

### Best Practices

| Practice | Rationale |
|----------|-----------|
| **Session-based directories** | Isolate processing data by user context |
| **Temporary file cleanup** | Prevent disk space exhaustion |
| **Progress tracking** | Enable long-running operation monitoring |
| **Atomic operations** | Use temporary names and rename on completion |
| **Error preservation** | Keep failed processing artifacts for debugging |
| **Audit logging** | Track all processing operations with timestamps |

### Integration Points

Developers extending this module should integrate with:

- **Controllers:** [3.1](#3.1) for request routing
- **Business Logic:** [4.1](#4.1) for operation orchestration  
- **Data Layer:** [5.1](#5.1) for database persistence
- **File Operations:** Reference file handling patterns in `OperacionesCtrl`

**Sources:** [repo/proc/index.php:1-2](), Overall architecture context

---

## Summary

The Processing Module (`proc`) is a structurally defined but minimally implemented component of GESFINANCIERO's repository module system. It follows the standard pattern where only the entry point is version-controlled, while all processing data, outputs, and temporary files are excluded from version control.

**Key Characteristics:**
- **Minimal implementation:** Currently contains only an empty PHP entry point
- **Data isolation:** All runtime processing data ignored in version control
- **Extensibility ready:** Structure supports future processing operation implementations
- **Security by design:** Separation of code and data prevents accidental data commits

**Current Status:**
The module's empty `index.php` indicates that processing operations are either pending implementation, handled dynamically through core controllers, or accessed through alternative routing mechanisms.

**Sources:** [.gitignore:18,26](), [repo/proc/index.php:1-2]()

---

---

## 7.5 Resources Module (recursos)

## Purpose and Scope

The Resources Module (`recursos`) is one of the modular components in the `repo/` directory structure, designed to handle resource file management and storage. This module follows the standard repository plugin architecture pattern where only the entry point is tracked in version control while runtime-generated files are ignored.

This document covers the module's architecture, current implementation state, integration patterns, and intended usage. For information about other repository modules, see [Module System](#7). For general file handling operations, see [OperacionesCtrl - Core Operations](#4.1).

---

## Current Implementation State

The Resources Module currently has a minimal implementation. The entry point file is an empty PHP file with no operational code.

**Entry Point:**
- Location: [repo/recursos/index.php:1-3]()
- Current state: Empty (contains only PHP opening and closing tags)
- Status: Placeholder implementation

This empty state indicates the module is either:
1. Reserved for future implementation
2. Used purely for runtime file storage without active code execution
3. Awaiting migration from legacy systems

**Sources:** [repo/recursos/index.php:1-3]()

---

## Module Architecture

### Directory Structure and Version Control Pattern

The Resources Module follows the standardized repository module pattern where version control explicitly separates code from data:

```mermaid
graph TB
    subgraph "recursos Module Structure"
        ROOT["repo/recursos/"]
        ENTRY["index.php<br/>(Tracked in Git)"]
        RUNTIME["Runtime Files<br/>(Ignored in Git)"]
        
        ROOT --> ENTRY
        ROOT --> RUNTIME
        
        subgraph "Potential Runtime Contents"
            STATIC["Static Assets"]
            UPLOADS["Uploaded Resources"]
            CACHE["Cached Files"]
            TEMP["Temporary Files"]
        end
        
        RUNTIME -.-> STATIC
        RUNTIME -.-> UPLOADS
        RUNTIME -.-> CACHE
        RUNTIME -.-> TEMP
    end
    
    subgraph "Git Configuration"
        GITIGNORE[".gitignore"]
        IGNORE_RULE["repo/recursos/*"]
        TRACK_RULE["!repo/recursos/index.php"]
    end
    
    GITIGNORE --> IGNORE_RULE
    GITIGNORE --> TRACK_RULE
    
    IGNORE_RULE -.->|"applies to"| RUNTIME
    TRACK_RULE -.->|"applies to"| ENTRY
```

**Git Ignore Configuration:**

The `.gitignore` file defines the tracking pattern:

| Pattern | Line | Effect |
|---------|------|--------|
| `repo/recursos/*` | [.gitignore:20]() | Ignore all files in recursos directory |
| `!repo/recursos/index.php` | [.gitignore:28]() | Exception: Track the entry point |

This pattern ensures:
- **Code versioning**: The entry point logic is tracked
- **Data isolation**: User-generated or runtime files are not committed
- **Environment separation**: Different environments can have different resource files
- **Security**: Prevents accidental commits of sensitive uploaded files

**Sources:** [.gitignore:16-30]()

---

## Integration with Application Architecture

### Module Placement in System

```mermaid
graph TB
    subgraph "Application Layer"
        INDEXPHP["index.php<br/>Main Entry"]
        HOMEPHP["home.php<br/>Home Entry"]
        INDEXCTRL["IndexCtrl"]
        HOMECTRL["HomeCtrl"]
    end
    
    subgraph "Repository Modules"
        REPO_ROOT["repo/"]
        
        ANEXOS["repo/anexos/<br/>Attachments"]
        AVATAR["repo/avatar/<br/>User Images"]
        PROC["repo/proc/<br/>Processing"]
        COM["repo/com/<br/>Communication"]
        RECURSOS["repo/recursos/<br/>Resources"]
        USUARIOS["repo/usuarios/<br/>User Data"]
        CORP["repo/corp/<br/>Corporate Config"]
    end
    
    subgraph "Business Logic"
        OPCTRL["OperacionesCtrl"]
        OPHOMECTRL["OperacionesHomeCtrl"]
    end
    
    INDEXPHP --> INDEXCTRL
    HOMEPHP --> HOMECTRL
    
    INDEXCTRL -.->|"may route to"| REPO_ROOT
    HOMECTRL -.->|"may route to"| REPO_ROOT
    
    INDEXCTRL --> OPCTRL
    HOMECTRL --> OPHOMECTRL
    
    REPO_ROOT --> ANEXOS
    REPO_ROOT --> AVATAR
    REPO_ROOT --> PROC
    REPO_ROOT --> COM
    REPO_ROOT --> RECURSOS
    REPO_ROOT --> USUARIOS
    REPO_ROOT --> CORP
    
    OPCTRL -.->|"file operations"| RECURSOS
```

The Resources Module sits within the broader repository module ecosystem, potentially serving as a storage location for various types of resource files managed by the business logic layer.

**Sources:** [.gitignore:16-30](), [repo/recursos/index.php:1-3]()

---

## Potential Use Cases and Functionality

Based on the module's name ("recursos" = resources in Spanish) and its position in the module architecture, the intended purposes likely include:

### Resource File Types

| Resource Type | Description | Common Operations |
|---------------|-------------|-------------------|
| Static Assets | CSS, JavaScript, fonts, icons | Serving via HTTP |
| Document Templates | Report templates, forms | Template retrieval |
| Generated Reports | PDFs, spreadsheets | Storage and download |
| Media Files | Images, videos, audio | Upload and streaming |
| Configuration Files | JSON, XML configs | Read/write operations |
| Export Data | Data exports, backups | Generation and download |

### Typical Access Pattern

If the module were fully implemented, the expected interaction pattern would be:

```mermaid
sequenceDiagram
    participant Client
    participant IndexCtrl
    participant OperacionesCtrl
    participant RecursosModule as "repo/recursos/"
    participant FileSystem
    
    Client->>IndexCtrl: "Request Resource"
    IndexCtrl->>IndexCtrl: "Authenticate User"
    IndexCtrl->>OperacionesCtrl: "Call File Operation"
    
    alt Upload Resource
        OperacionesCtrl->>RecursosModule: "SubirArchivo()"
        RecursosModule->>FileSystem: "Write File"
        FileSystem-->>RecursosModule: "File Path"
        RecursosModule-->>OperacionesCtrl: "Success + Path"
    else Retrieve Resource
        OperacionesCtrl->>RecursosModule: "Get File"
        RecursosModule->>FileSystem: "Read File"
        FileSystem-->>RecursosModule: "File Content"
        RecursosModule-->>OperacionesCtrl: "File Data"
    else Delete Resource
        OperacionesCtrl->>RecursosModule: "Delete File"
        RecursosModule->>FileSystem: "Remove File"
        FileSystem-->>RecursosModule: "Confirmation"
        RecursosModule-->>OperacionesCtrl: "Success"
    end
    
    OperacionesCtrl-->>IndexCtrl: "Operation Result"
    IndexCtrl-->>Client: "Response"
```

**Sources:** [repo/recursos/index.php:1-3]()

---

## File Operations Integration

### Current File Handling in Core System

While the Resources Module itself is not implemented, the core application has file operation capabilities that could be integrated with this module:

```mermaid
graph TB
    subgraph "File Operation Methods"
        OPCTRL["OperacionesCtrl"]
        
        UPLOAD["SubirArchivo()<br/>File Upload Handler"]
        BASE64["processBase64Images()<br/>Base64 Processor"]
        RESIZE["redimensionImg2()<br/>Image Resizing"]
        DOWNLOAD["File Download Logic<br/>in IndexCtrl"]
    end
    
    subgraph "Potential Target Locations"
        RECURSOS["repo/recursos/<br/>Resource Storage"]
        ANEXOS["repo/anexos/<br/>Attachments"]
        AVATAR["repo/avatar/<br/>User Images"]
    end
    
    OPCTRL --> UPLOAD
    OPCTRL --> BASE64
    OPCTRL --> RESIZE
    
    UPLOAD -.->|"could write to"| RECURSOS
    BASE64 -.->|"could write to"| RECURSOS
    RESIZE -.->|"could write to"| RECURSOS
    DOWNLOAD -.->|"could read from"| RECURSOS
    
    UPLOAD -.->|"currently writes to"| ANEXOS
    RESIZE -.->|"currently writes to"| AVATAR
```

The existing file operation methods in `OperacionesCtrl` could be configured to use the Resources Module as a storage target, providing centralized resource management.

**Sources:** [repo/recursos/index.php:1-3]()

---

## Implementation Patterns from Similar Modules

### Comparison with Other Repository Modules

| Module | Purpose | Implementation Status | Entry Point |
|--------|---------|----------------------|-------------|
| `anexos` | Attachment storage | Active (inferred) | [repo/anexos/index.php]() |
| `avatar` | User profile images | Active (inferred) | [repo/avatar/index.php]() |
| `proc` | Processing operations | Unknown | [repo/proc/index.php]() |
| `com` | Communication data | Unknown | [repo/com/index.php]() |
| **`recursos`** | **Resource files** | **Empty placeholder** | [repo/recursos/index.php:1-3]() |
| `usuarios` | User-specific data | Unknown | [repo/usuarios/index.php]() |

All modules follow the same architectural pattern with empty or minimal entry points, suggesting:
1. These modules primarily serve as data storage locations
2. Business logic resides in the core controllers (`OperacionesCtrl`)
3. The entry points could serve as direct access endpoints if needed

**Sources:** [.gitignore:16-30](), [repo/recursos/index.php:1-3]()

---

## Access and Routing Mechanisms

### Potential Direct Access Pattern

If the module were to be accessed directly via URL, the expected routing would be:

```mermaid
graph LR
    HTTP["HTTP Request:<br/>https://domain/repo/recursos/"]
    WEBSERVER["Web Server<br/>(Apache/Nginx)"]
    ENTRYPOINT["repo/recursos/index.php"]
    
    HTTP --> WEBSERVER
    WEBSERVER --> ENTRYPOINT
    
    subgraph "Current Behavior"
        EMPTY["Empty PHP File<br/>No Output"]
    end
    
    subgraph "Expected Behavior (if implemented)"
        AUTH["Authenticate Request"]
        VALIDATE["Validate Permissions"]
        SERVE["Serve Resource File"]
    end
    
    ENTRYPOINT --> EMPTY
    ENTRYPOINT -.->|"should do"| AUTH
    AUTH -.-> VALIDATE
    VALIDATE -.-> SERVE
```

**Current State:** Direct access to `repo/recursos/` would execute the empty `index.php` file, producing no output.

**Expected State:** The entry point should implement authentication, permission validation, and resource serving logic.

**Sources:** [repo/recursos/index.php:1-3]()

### Indirect Access via Controllers

The more common access pattern would be through the main application controllers:

```mermaid
graph TB
    CLIENT["Client Request"]
    
    subgraph "Main Controllers"
        INDEXCTRL["IndexCtrl<br/>API Endpoint Handler"]
    end
    
    subgraph "Business Logic"
        OPCTRL["OperacionesCtrl<br/>File Operations"]
    end
    
    subgraph "File System Layer"
        RECURSOS["repo/recursos/<br/>Storage Directory"]
        FILESYSTEM["File System<br/>read/write operations"]
    end
    
    CLIENT -->|"API Call"| INDEXCTRL
    INDEXCTRL -->|"Delegate to"| OPCTRL
    OPCTRL -->|"File I/O"| FILESYSTEM
    FILESYSTEM -->|"Access"| RECURSOS
```

This pattern keeps business logic in the controllers while using the module directory as a storage location.

**Sources:** [repo/recursos/index.php:1-3]()

---

## Security Considerations

### File Storage Security

When implementing resource file handling, the following security measures should be considered:

| Security Concern | Mitigation Strategy |
|-----------------|---------------------|
| **Unauthorized Access** | Authentication check before file operations |
| **Path Traversal** | Validate file paths, prevent `../` sequences |
| **File Type Validation** | Whitelist allowed MIME types and extensions |
| **File Size Limits** | Enforce maximum upload sizes |
| **Malicious Files** | Scan uploads for malware |
| **Direct Web Access** | Use `.htaccess` or web server config to restrict access |

### Git Ignore Security Benefits

The current Git ignore pattern provides security benefits:

```
repo/recursos/*          # Prevents accidental commits of:
                        # - User uploaded files
                        # - Sensitive documents
                        # - Personal data
                        # - Generated reports

!repo/recursos/index.php # Only version-controlled file
```

This ensures that even if sensitive files are uploaded to the module, they will not be committed to version control.

**Sources:** [.gitignore:20](), [.gitignore:28]()

---

## Future Implementation Considerations

### Recommended Implementation Pattern

If implementing functionality in this module, consider the following structure:

```mermaid
graph TB
    subgraph "Resources Module Implementation"
        ENTRY["index.php<br/>Entry Point"]
        
        subgraph "Potential Components"
            AUTH_CHECK["Authentication Check"]
            PERM_CHECK["Permission Validation"]
            FILE_HANDLER["File Handler"]
            MIME_DETECT["MIME Type Detection"]
            RESPONSE["Response Generator"]
        end
        
        subgraph "Storage Structure"
            PUBLIC["public/<br/>Publicly accessible"]
            PRIVATE["private/<br/>Authenticated only"]
            TEMP["temp/<br/>Temporary files"]
            CACHE["cache/<br/>Cached resources"]
        end
    end
    
    ENTRY --> AUTH_CHECK
    AUTH_CHECK --> PERM_CHECK
    PERM_CHECK --> FILE_HANDLER
    FILE_HANDLER --> MIME_DETECT
    MIME_DETECT --> RESPONSE
    
    FILE_HANDLER --> PUBLIC
    FILE_HANDLER --> PRIVATE
    FILE_HANDLER --> TEMP
    FILE_HANDLER --> CACHE
```

### Integration with Existing Components

The module should integrate with existing system components:

| Component | Integration Point | Purpose |
|-----------|------------------|---------|
| `Singleton` | Database queries | Logging access, storing metadata |
| `OperacionesCtrl` | File operations | Reuse existing upload/download logic |
| `IndexCtrl` | API endpoints | Expose resource management endpoints |
| Authentication system | Session validation | Secure access control |

**Sources:** [repo/recursos/index.php:1-3]()

---

## Relationship to Other Modules

### Module Ecosystem Context

```mermaid
graph TB
    subgraph "User-Facing Modules"
        AVATAR["avatar<br/>User Profile Images"]
        USUARIOS["usuarios<br/>User Data"]
    end
    
    subgraph "Document Modules"
        ANEXOS["anexos<br/>Document Attachments"]
        RECURSOS["recursos<br/>General Resources"]
    end
    
    subgraph "System Modules"
        PROC["proc<br/>Processing"]
        COM["com<br/>Communication"]
        CORP["corp<br/>Corporate Config"]
    end
    
    subgraph "Business Logic Layer"
        OPCTRL["OperacionesCtrl"]
    end
    
    AVATAR -.->|"specific to"| USUARIOS
    RECURSOS -.->|"general storage"| ANEXOS
    
    OPCTRL -->|"manages"| AVATAR
    OPCTRL -->|"manages"| USUARIOS
    OPCTRL -->|"manages"| ANEXOS
    OPCTRL -->|"manages"| RECURSOS
    OPCTRL -->|"manages"| PROC
    OPCTRL -->|"manages"| COM
```

The Resources Module would serve as a general-purpose storage location, distinct from specialized modules:
- **`avatar`**: Specifically for user profile images
- **`anexos`**: Specifically for document attachments
- **`recursos`**: General resources not fitting other categories

**Sources:** [.gitignore:16-30]()

---

## Development Roadmap

### Recommended Steps for Implementation

If implementing this module, follow these steps:

1. **Define Resource Types**
   - Identify what resources will be stored
   - Define directory structure for organization
   - Establish naming conventions

2. **Implement Entry Point Logic** in [repo/recursos/index.php:1-3]()
   - Add authentication checks
   - Implement file serving logic
   - Add error handling

3. **Create API Endpoints** in `IndexCtrl`
   - Resource upload endpoint
   - Resource retrieval endpoint
   - Resource deletion endpoint
   - Resource listing endpoint

4. **Add Business Logic** in `OperacionesCtrl`
   - File validation methods
   - Storage path generation
   - Permission checking methods

5. **Configure Web Server**
   - Add `.htaccess` for Apache or nginx config
   - Set up proper MIME type handling
   - Configure access restrictions

6. **Add Database Support**
   - Create resource metadata table
   - Track uploads, access logs
   - Store file relationships

**Sources:** [repo/recursos/index.php:1-3]()

---

## Summary

The Resources Module (`repo/recursos/`) is currently a placeholder implementation within the repository module architecture. While the entry point exists and follows the standard Git ignore pattern, it contains no functional code.

**Key Characteristics:**

| Aspect | Current State |
|--------|--------------|
| Entry Point | Empty PHP file at [repo/recursos/index.php:1-3]() |
| Version Control | Only `index.php` tracked, all other files ignored |
| Implementation | Not yet implemented |
| Purpose | Intended for general resource file management |
| Access Pattern | Would be accessed via controllers or direct URL |

**Integration Points:**

The module is positioned to integrate with:
- File operation methods in `OperacionesCtrl`
- API endpoints in `IndexCtrl`
- Database layer via `Singleton`
- Existing file handling infrastructure

**Next Steps:**

For activation, the module requires:
1. Implementation of entry point logic
2. Integration with existing file operations
3. API endpoint creation
4. Security measures implementation

The module follows best practices by separating version-controlled code from runtime-generated data, maintaining a clean repository while supporting multi-environment deployments.

**Sources:** [.gitignore:16-30](), [repo/recursos/index.php:1-3]()

---

---

## 7.6 Users Module (usuarios)

## Purpose and Scope

The **usuarios module** is a repository-based storage module designed to house user-specific runtime data and files within the GESFINANCIERO system. Located at `repo/usuarios/`, this module follows the standard repository pattern where only the entry point (`index.php`) is tracked in version control, while all other contents are ignored as runtime-generated user data.

This module is distinct from other user-related components:
- For user management operations and business logic, see [OperacionesCtrl - Core Operations](#4.1)
- For user management API endpoints, see [User Management APIs](#9.3)
- For user data models and database operations, see [Data Models](#5.3)
- For authentication and session management, see [Authentication System](#10.1)

The usuarios module specifically handles **user-specific file storage and data isolation**, not user CRUD operations or authentication.

**Sources:** [.gitignore:16-29](), [repo/usuarios/index.php:1-2]()

---

## Module Architecture

### Entry Point and Data Separation Pattern

The usuarios module implements the repository module architecture pattern, which separates version-controlled code from runtime-generated data.

```mermaid
graph TB
    subgraph "Version Control - Tracked Files"
        ENTRY["repo/usuarios/index.php<br/>Empty Entry Point<br/>Tracked in Git"]
    end
    
    subgraph "Runtime Storage - Ignored Files"
        USER_DATA["User-Specific Data<br/>*.pdf, *.jpg, *.png, etc.<br/>Ignored in Git"]
        USER_DIRS["User Subdirectories<br/>Organized by user ID<br/>Ignored in Git"]
        TEMP_FILES["Temporary Files<br/>Processing artifacts<br/>Ignored in Git"]
    end
    
    subgraph "Access Layer"
        OPCTRL["OperacionesCtrl<br/>File operations"]
        INDEXCTRL["IndexCtrl<br/>File downloads"]
        FILE_OPS["File Upload/Download<br/>Processing"]
    end
    
    subgraph "User Context"
        USERS["Application Users<br/>Authenticated sessions"]
    end
    
    ENTRY -.->|"defines module boundary"| USER_DATA
    ENTRY -.->|"defines module boundary"| USER_DIRS
    ENTRY -.->|"defines module boundary"| TEMP_FILES
    
    OPCTRL -->|"writes to"| USER_DATA
    INDEXCTRL -->|"reads from"| USER_DATA
    FILE_OPS -->|"manages"| USER_DIRS
    
    USERS -->|"trigger operations"| FILE_OPS
    FILE_OPS -->|"stores files for"| USER_DATA
```

**Diagram: usuarios Module Architecture and Data Flow**

The module consists of:

| Component | Purpose | Version Control Status |
|-----------|---------|----------------------|
| `index.php` | Entry point (currently empty) | Tracked in Git |
| User data files | Runtime user-generated content | Ignored in Git |
| User directories | Per-user storage organization | Ignored in Git |
| Temporary files | Processing artifacts | Ignored in Git |

**Sources:** [.gitignore:21-29](), [repo/usuarios/index.php:1-2]()

---

## Current Implementation Status

### Empty Entry Point

The usuarios module currently has an empty entry point:

```php
<?php
?>
```

This indicates that the module is operating in **passive storage mode** rather than active processing mode. Unlike other modules that may have processing logic in their entry points, usuarios serves as a pure data repository.

**Sources:** [repo/usuarios/index.php:1-2]()

### Implications of Empty Entry Point

```mermaid
graph LR
    subgraph "Active Processing Modules"
        PROC_MOD["proc/index.php<br/>Processing logic"]
        COM_MOD["com/index.php<br/>Communication logic"]
    end
    
    subgraph "Passive Storage Modules"
        USUARIOS_MOD["usuarios/index.php<br/>Empty - storage only"]
        AVATAR_MOD["avatar/index.php<br/>Empty - storage only"]
        RECURSOS_MOD["recursos/index.php<br/>Empty - storage only"]
    end
    
    subgraph "Access Pattern"
        DIRECT["Direct file system access<br/>from controllers"]
    end
    
    ACTIVE_PROC["Active Processing<br/>Route to module<br/>Execute logic"]
    PASSIVE_STORE["Passive Storage<br/>Direct file access<br/>No routing"]
    
    PROC_MOD --> ACTIVE_PROC
    COM_MOD --> ACTIVE_PROC
    
    USUARIOS_MOD --> PASSIVE_STORE
    AVATAR_MOD --> PASSIVE_STORE
    RECURSOS_MOD --> PASSIVE_STORE
    
    PASSIVE_STORE --> DIRECT
```

**Diagram: Active vs Passive Module Patterns**

The empty entry point suggests:
1. **No web-accessible routing**: The module is not designed to handle HTTP requests directly
2. **File system operations only**: Controllers access the directory through file system operations
3. **Storage boundary marker**: The `index.php` serves primarily to mark the module boundary in version control
4. **Future extensibility**: The entry point can be populated later if processing logic is needed

**Sources:** [repo/usuarios/index.php:1-2](), [.gitignore:21-29]()

---

## Integration with Core System

### File Operation Integration

The usuarios module integrates with the core system through file operations defined in controllers.

```mermaid
graph TB
    subgraph "User Actions"
        USER["Authenticated User"]
    end
    
    subgraph "Controller Layer"
        INDEXCTRL["IndexCtrl<br/>API Endpoints"]
        OPCTRL["OperacionesCtrl<br/>Business Logic"]
    end
    
    subgraph "File Operations"
        UPLOAD["SubirArchivo()<br/>File upload processing"]
        PROCESS["processBase64Images()<br/>Base64 decoding"]
        RESIZE["redimensionImg2()<br/>Image resizing"]
    end
    
    subgraph "Storage Modules"
        USUARIOS["repo/usuarios/<br/>User-specific files"]
        AVATAR["repo/avatar/<br/>User profile images"]
        ANEXOS["repo/anexos/<br/>Document attachments"]
    end
    
    USER -->|"upload request"| INDEXCTRL
    INDEXCTRL -->|"delegates to"| OPCTRL
    
    OPCTRL --> UPLOAD
    OPCTRL --> PROCESS
    OPCTRL --> RESIZE
    
    UPLOAD -->|"stores to"| USUARIOS
    PROCESS -->|"stores to"| USUARIOS
    RESIZE -->|"stores to"| AVATAR
    
    INDEXCTRL -->|"download request"| USUARIOS
    INDEXCTRL -->|"stream file"| USER
```

**Diagram: File Operation Integration with usuarios Module**

**Sources:** High-level architecture diagrams, [.gitignore:21-29]()

---

## Storage Patterns and Use Cases

### Typical Storage Organization

While the specific structure is runtime-generated and not tracked in Git, typical patterns for user-specific storage include:

```mermaid
graph TB
    subgraph "repo/usuarios/ Directory Structure"
        ROOT["usuarios/"]
        
        subgraph "User-Specific Directories"
            USER1["user_123/<br/>User ID-based folder"]
            USER2["user_456/<br/>User ID-based folder"]
            USER3["user_789/<br/>User ID-based folder"]
        end
        
        subgraph "File Types per User"
            DOCS["documents/<br/>PDF, DOCX files"]
            IMAGES["images/<br/>Uploaded images"]
            TEMP["temp/<br/>Processing artifacts"]
            EXPORT["exports/<br/>Generated reports"]
        end
        
        ROOT --> USER1
        ROOT --> USER2
        ROOT --> USER3
        
        USER1 --> DOCS
        USER1 --> IMAGES
        USER1 --> TEMP
        USER1 --> EXPORT
    end
```

**Diagram: Typical Storage Organization Pattern**

### Common Use Cases

| Use Case | Description | Typical File Types |
|----------|-------------|-------------------|
| Document uploads | User-uploaded documents for processing | PDF, DOCX, XLSX |
| Generated reports | System-generated reports for user | PDF, CSV, XLSX |
| Temporary processing | Intermediate files during operations | Various |
| User exports | Data exports requested by user | JSON, CSV, XML |
| Custom attachments | User-specific attachments | PDF, images, archives |

**Sources:** Based on module naming conventions and system patterns

---

## Security Considerations

### Access Control

```mermaid
graph TB
    subgraph "Request Flow"
        REQUEST["User Request<br/>File access/upload"]
    end
    
    subgraph "Authentication Layer"
        SESSION["Session Validation<br/>Is user authenticated?"]
        AUTHZ["Authorization Check<br/>Does user own file?"]
    end
    
    subgraph "File Access Layer"
        VALIDATE["Path Validation<br/>Prevent directory traversal"]
        ACCESS["File System Access<br/>Read/Write operations"]
    end
    
    subgraph "Storage"
        USUARIOS["repo/usuarios/<br/>User files"]
    end
    
    REQUEST --> SESSION
    SESSION -->|"authenticated"| AUTHZ
    SESSION -->|"not authenticated"| REJECT1["Reject: 401"]
    
    AUTHZ -->|"authorized"| VALIDATE
    AUTHZ -->|"not authorized"| REJECT2["Reject: 403"]
    
    VALIDATE -->|"valid path"| ACCESS
    VALIDATE -->|"invalid path"| REJECT3["Reject: Path traversal"]
    
    ACCESS --> USUARIOS
```

**Diagram: Security Flow for usuarios Module Access**

### Security Requirements

The usuarios module must enforce:

1. **Authentication**: Only authenticated users can access the module
2. **Authorization**: Users can only access their own files
3. **Path Validation**: Prevent directory traversal attacks (e.g., `../../../etc/passwd`)
4. **File Type Validation**: Restrict allowed file types and extensions
5. **Size Limits**: Enforce upload size restrictions
6. **Sanitization**: Clean filenames and content before storage

### Implementation Checklist

| Security Measure | Responsibility | Implementation Location |
|-----------------|----------------|-------------------------|
| Authentication | Session validation | `IndexCtrl`, `OperacionesCtrl` |
| Authorization | User ownership check | Controller layer |
| Path validation | Input sanitization | File operation methods |
| Type validation | MIME type checking | Upload handlers |
| Size limits | PHP/Application config | `php.ini`, application logic |

**Sources:** Security best practices, system architecture

---

## File Access Patterns

### Upload Pattern

```mermaid
sequenceDiagram
    actor User
    participant IndexCtrl
    participant OpCtrl as OperacionesCtrl
    participant FS as File System
    participant DB as Database
    
    User->>IndexCtrl: POST /api/upload
    IndexCtrl->>IndexCtrl: Validate session
    IndexCtrl->>OpCtrl: SubirArchivo()
    
    OpCtrl->>OpCtrl: Validate file type
    OpCtrl->>OpCtrl: Sanitize filename
    OpCtrl->>OpCtrl: Generate unique name
    
    OpCtrl->>FS: Write to repo/usuarios/
    FS-->>OpCtrl: File path
    
    OpCtrl->>DB: Store metadata<br/>(path, user_id, timestamp)
    DB-->>OpCtrl: Success
    
    OpCtrl-->>IndexCtrl: File info
    IndexCtrl-->>User: JSON response
```

**Diagram: File Upload Sequence**

### Download Pattern

```mermaid
sequenceDiagram
    actor User
    participant IndexCtrl
    participant FS as File System
    participant DB as Database
    
    User->>IndexCtrl: GET /api/download?file_id=123
    IndexCtrl->>IndexCtrl: Validate session
    
    IndexCtrl->>DB: Query file metadata
    DB-->>IndexCtrl: File path, owner_id
    
    IndexCtrl->>IndexCtrl: Check authorization<br/>(user_id == owner_id)
    
    alt Authorized
        IndexCtrl->>FS: Read repo/usuarios/file.pdf
        FS-->>IndexCtrl: File content
        IndexCtrl-->>User: Stream file with headers
    else Not Authorized
        IndexCtrl-->>User: 403 Forbidden
    end
```

**Diagram: File Download Sequence**

**Sources:** Based on standard file operation patterns in web applications

---

## Relationship to Other Modules

### Module Comparison

```mermaid
graph TB
    subgraph "Storage Modules"
        USUARIOS["usuarios/<br/>User-specific data<br/>Personal files"]
        AVATAR["avatar/<br/>Profile images<br/>User avatars"]
        RECURSOS["recursos/<br/>Resource files<br/>Shared resources"]
        ANEXOS["anexos/<br/>Attachments<br/>Document annexes"]
    end
    
    subgraph "User Context"
        USER_FILES["User Files"]
        USER_PROFILE["User Profile"]
        SHARED_RES["Shared Resources"]
        DOC_ATTACH["Document Attachments"]
    end
    
    USUARIOS --> USER_FILES
    AVATAR --> USER_PROFILE
    RECURSOS --> SHARED_RES
    ANEXOS --> DOC_ATTACH
    
    USER_FILES -.->|"specific to one user"| SCOPE1["Private Scope"]
    USER_PROFILE -.->|"one per user"| SCOPE1
    SHARED_RES -.->|"multiple users"| SCOPE2["Shared Scope"]
    DOC_ATTACH -.->|"document-linked"| SCOPE2
```

**Diagram: Storage Module Comparison**

| Module | Primary Purpose | Scope | Typical Contents |
|--------|----------------|-------|------------------|
| `usuarios/` | User-specific data and files | Per-user private | Documents, exports, personal files |
| `avatar/` | User profile images | Per-user public | Profile pictures, thumbnails |
| `recursos/` | Shared resource files | System-wide | Templates, shared documents |
| `anexos/` | Document attachments | Document-linked | Workflow attachments, document annexes |
| `proc/` | Processing artifacts | Temporary | Processing intermediates |
| `com/` | Communication data | Communication-linked | Email attachments, messages |

**Sources:** [.gitignore:16-29](), module naming conventions

---

## Data Lifecycle

### File Lifecycle Management

```mermaid
stateDiagram-v2
    [*] --> Uploaded: User uploads file
    
    Uploaded --> Stored: Save to repo/usuarios/
    Stored --> Metadata: Store DB metadata
    
    Metadata --> Active: File available
    
    Active --> Downloaded: User downloads
    Active --> Processed: System processes
    Active --> Expired: Retention policy
    
    Downloaded --> Active: Continue availability
    Processed --> Active: Continue availability
    
    Expired --> Archived: Move to archive
    Archived --> Deleted: Cleanup job
    
    Deleted --> [*]
    
    Active --> Deleted: User deletes
```

**Diagram: File Lifecycle in usuarios Module**

### Lifecycle Stages

| Stage | Description | Storage Location | Database State |
|-------|-------------|-----------------|----------------|
| Uploaded | File received from user | Temporary location | Not yet recorded |
| Stored | File saved to usuarios/ | `repo/usuarios/user_id/` | Metadata created |
| Active | Available for access | `repo/usuarios/user_id/` | Active status |
| Processed | Underwent processing | `repo/usuarios/user_id/` | Processing complete |
| Expired | Past retention period | `repo/usuarios/user_id/` | Expired flag set |
| Archived | Moved for long-term storage | Archive location | Archived status |
| Deleted | Removed from system | N/A | Deleted/soft delete |

**Sources:** Standard file lifecycle patterns

---

## Configuration and Maintenance

### Directory Permissions

The usuarios module requires appropriate file system permissions:

| Directory | Required Permission | Owner | Purpose |
|-----------|-------------------|-------|---------|
| `repo/usuarios/` | `rwxr-xr-x` (755) | Web server user | Base directory |
| User subdirectories | `rwxr-xr-x` (755) | Web server user | Per-user storage |
| Uploaded files | `rw-r--r--` (644) | Web server user | File access |

### Cleanup and Maintenance Tasks

Recommended maintenance tasks for the usuarios module:

1. **Orphaned File Cleanup**
   - Identify files without database metadata
   - Remove files for deleted users
   - Clean up failed upload artifacts

2. **Storage Monitoring**
   - Track per-user storage usage
   - Enforce storage quotas
   - Alert on unusual growth patterns

3. **Backup Procedures**
   - Regular backup of active user files
   - Archive old files per retention policy
   - Verify backup integrity

4. **Security Audits**
   - Review file access logs
   - Verify permission settings
   - Check for suspicious file types

**Sources:** System administration best practices

---

## Extension Points

### Future Enhancements

The empty entry point at [repo/usuarios/index.php:1-2]() provides an extension point for future functionality:

```mermaid
graph TB
    subgraph "Current State"
        EMPTY["index.php<br/>Empty entry point"]
        PASSIVE["Passive storage<br/>File system access only"]
    end
    
    subgraph "Potential Extensions"
        WEB_UI["Web Interface<br/>File browser UI"]
        API["REST API<br/>File operations"]
        QUOTA["Quota Management<br/>Usage tracking"]
        SHARING["File Sharing<br/>User-to-user sharing"]
        PREVIEW["Preview Generation<br/>Thumbnails, previews"]
    end
    
    EMPTY -.->|"can be extended to"| WEB_UI
    EMPTY -.->|"can be extended to"| API
    EMPTY -.->|"can be extended to"| QUOTA
    EMPTY -.->|"can be extended to"| SHARING
    EMPTY -.->|"can be extended to"| PREVIEW
    
    PASSIVE -.->|"remains available"| FS_ACCESS["Direct file system access"]
```

**Diagram: Potential Extension Points**

### Implementation Considerations

If extending the usuarios module with active processing:

1. **Maintain Backwards Compatibility**: Existing file system access patterns must continue to work
2. **Add Routing Logic**: Implement request routing in `index.php`
3. **Authentication Integration**: Leverage existing session management
4. **API Consistency**: Follow patterns established in other modules
5. **Performance**: Consider caching and optimization for file operations

**Sources:** [repo/usuarios/index.php:1-2](), system architecture patterns

---

## Best Practices

### Development Guidelines

When working with the usuarios module:

1. **Always Validate User Context**
   - Verify user authentication before file operations
   - Check user ownership before allowing access
   - Use session data to determine file paths

2. **Sanitize File Paths**
   - Never trust user-supplied paths directly
   - Use `basename()` to prevent directory traversal
   - Validate against allowed patterns

3. **Use Unique Filenames**
   - Generate unique filenames (UUID, hash, timestamp)
   - Prevent filename collisions
   - Avoid user-controlled filenames directly

4. **Implement Error Handling**
   - Handle file system errors gracefully
   - Log failures for debugging
   - Provide meaningful error messages

5. **Consider Storage Limits**
   - Check available disk space before writes
   - Implement per-user quotas
   - Clean up temporary files

### Code Example Pattern

While not currently implemented, typical usage would follow this pattern:

```php
// Typical pattern for accessing usuarios module
function saveUserFile($userId, $fileData, $filename) {
    // 1. Validate user
    if (!isAuthenticated()) {
        throw new Exception("User not authenticated");
    }
    
    // 2. Sanitize inputs
    $safeUserId = (int)$userId;
    $safeFilename = basename($filename);
    
    // 3. Construct safe path
    $userDir = "repo/usuarios/" . $safeUserId;
    if (!is_dir($userDir)) {
        mkdir($userDir, 0755, true);
    }
    
    // 4. Generate unique filename
    $uniqueName = uniqid() . '_' . $safeFilename;
    $fullPath = $userDir . '/' . $uniqueName;
    
    // 5. Save file
    file_put_contents($fullPath, $fileData);
    
    // 6. Store metadata in database
    storeFileMetadata($safeUserId, $fullPath, $safeFilename);
    
    return $fullPath;
}
```

**Sources:** Security best practices, PHP file handling patterns

---

## Summary

The **usuarios module** serves as a passive storage repository for user-specific data within the GESFINANCIERO system. Key characteristics:

- **Purpose**: User-specific file storage and data isolation
- **Pattern**: Entry point tracked, all data ignored in version control
- **Current State**: Empty entry point indicates passive storage mode
- **Integration**: Accessed via controller file operations
- **Security**: Requires authentication, authorization, and path validation
- **Extensibility**: Can be extended with active processing logic in future

The module is part of the larger repository architecture that separates code from data, enabling clean version control while supporting runtime data generation and storage.

**Sources:** [.gitignore:16-29](), [repo/usuarios/index.php:1-2](), system architecture diagrams

---

---

## 7.7 Corporate Module (corp)

## Purpose and Scope

The Corporate Module (`corp`) is a specialized module within the repository system that serves two primary functions: it houses the `Corporation` class containing system-wide configuration constants, and it provides a storage location for corporate/company-specific runtime data. Unlike other modules which primarily handle user-generated content, the `corp` module plays a critical infrastructure role by centralizing all database credentials, SMTP settings, and application constants used throughout GESFINANCIERO.

For general information about the module system architecture, see [Module System](#7). For database connection management that consumes these credentials, see [Singleton - Database Connection Manager](#5.1). For email functionality that uses the SMTP configuration, see [Email System (PHPMailer)](#8.3).

**Sources:** [repo/corp/Corporation.php:1-23](), [.gitignore:1-30]()

---

## Module Structure

The `corp` module follows the standard repository module pattern but with a unique characteristic: it contains tracked source code (the `Corporation.php` configuration class) in addition to the standard entry point.

### Directory Organization

```
repo/corp/
├── index.php              # Module entry point (tracked, empty)
├── Corporation.php        # Configuration constants class (tracked)
└── [runtime data]*        # Corporate data files (ignored by Git)
```

The `.gitignore` file does not explicitly list `repo/corp/*` in the ignore patterns, which distinguishes this module from others. This allows the `Corporation.php` file to be tracked in version control, making the configuration part of the codebase itself.

### Tracked vs Ignored Content

| Content Type | Status | Purpose |
|--------------|--------|---------|
| `index.php` | Tracked | Module entry point (currently empty) |
| `Corporation.php` | Tracked | System-wide configuration constants |
| Other files | Ignored (implicit) | Corporate-specific runtime data |

**Sources:** [.gitignore:16-29](), [repo/corp/index.php:1-2](), [repo/corp/Corporation.php:1-23]()

---

## Corporation Configuration Class

The `Corporation` class is the central configuration hub for GESFINANCIERO, defining system-wide constants for database connectivity and email services. It is implemented as a static constant container without instance methods.

### Class Structure Diagram

```mermaid
classDiagram
    class Corporation {
        +const CONFIG = false
        +const MAIL_SMTPAUTHE = true
        +const MAIL_PORT = 25
        +const MAIL_HOST
        +const MAIL_USERNAME
        +const MAIL_PASSWORD
        +const MAIL_SMTPSECURE
        +const MAIL_REMITENTE
        +const MAIL_LABEL_REMITENTE
        +const MAIL_SUBJECT
        +const HOST
        +const DBUSER
        +const DBPASS
        +const DBNAME
    }
    
    class Singleton {
        -conexion
        +getInstance()
    }
    
    class PHPMailer {
        +Host
        +Username
        +Password
    }
    
    Singleton ..|> Corporation : "reads DB constants"
    PHPMailer ..|> Corporation : "reads SMTP constants"
```

**Sources:** [repo/corp/Corporation.php:2-22]()

---

## Database Configuration Constants

The database configuration constants define connectivity parameters for the MySQL database used by GESFINANCIERO.

### Database Constants

| Constant | Value | Description |
|----------|-------|-------------|
| `HOST` | `'db'` | Database host (Docker service name) |
| `DBUSER` | `'rootapps'` | Database username |
| `DBPASS` | `'rootapps'` | Database password (plaintext) |
| `DBNAME` | `'nuevapp_apps'` | Database name |

```php
// Database configuration from Corporation.php
const HOST      = 'db';
const DBUSER    = 'rootapps';
const DBPASS    = 'rootapps';
const DBNAME    = 'nuevapp_apps';
```

### Database Connection Flow

```mermaid
sequenceDiagram
    participant App as "Application Code"
    participant Corp as "Corporation Class"
    participant Sing as "Singleton"
    participant MySQL as "MySQL Database"
    
    App->>Sing: "getInstance()"
    Sing->>Corp: "Read Corporation::HOST"
    Sing->>Corp: "Read Corporation::DBUSER"
    Sing->>Corp: "Read Corporation::DBPASS"
    Sing->>Corp: "Read Corporation::DBNAME"
    Corp-->>Sing: "Return constant values"
    Sing->>MySQL: "mysqli_connect(host, user, pass, dbname)"
    MySQL-->>Sing: "Database connection"
    Sing-->>App: "Return Singleton instance"
```

The `Singleton` class reads these constants during initialization to establish the database connection. The host value `'db'` suggests a Docker Compose environment where the database service is named `db`.

**Sources:** [repo/corp/Corporation.php:17-20]()

---

## SMTP Email Configuration Constants

The email configuration constants define parameters for sending system notifications and emails through an external SMTP server.

### SMTP Constants

| Constant | Value | Description |
|----------|-------|-------------|
| `MAIL_SMTPAUTHE` | `true` | Enable SMTP authentication |
| `MAIL_PORT` | `25` | SMTP server port |
| `MAIL_HOST` | `"smtp.ipage.com"` | SMTP server hostname |
| `MAIL_USERNAME` | `"admin@nuevapp.com"` | SMTP authentication username |
| `MAIL_PASSWORD` | `"73cn0l0g1@Info."` | SMTP authentication password (plaintext) |
| `MAIL_SMTPSECURE` | `""` | SMTP encryption method (empty = no encryption) |
| `MAIL_REMITENTE` | `"admin@nuevapp.com"` | Default sender email address |
| `MAIL_LABEL_REMITENTE` | `"Nuevapp Notify"` | Default sender display name |
| `MAIL_SUBJECT` | `""` | Default email subject (empty) |

### Email Configuration Security Concerns

```mermaid
graph TB
    Corp["Corporation Class<br/>(repo/corp/Corporation.php)"]
    Const["SMTP Constants<br/>PLAINTEXT CREDENTIALS"]
    Git["Git Repository<br/>PUBLIC ACCESS RISK"]
    OpCtrl["OperacionesCtrl<br/>Email Operations"]
    PHPMailer["PHPMailer Library<br/>SMTP Connection"]
    SMTP["SMTP Server<br/>smtp.ipage.com:25"]
    
    Corp --> Const
    Const --> Git
    Git -.->|"Security Risk"| Const
    
    OpCtrl --> Const
    OpCtrl --> PHPMailer
    PHPMailer --> Const
    PHPMailer --> SMTP
    
    style Git fill:#f99
    style Const fill:#f99
```

⚠️ **Critical Security Issue:** SMTP credentials are stored in plaintext in the `Corporation.php` file, which is tracked in version control. This presents a significant security vulnerability if the repository is publicly accessible or if unauthorized users gain access to the codebase.

**Sources:** [repo/corp/Corporation.php:6-15]()

---

## Configuration Flag

The `Corporation` class includes a configuration flag constant:

```php
const CONFIG = false;
```

This boolean constant appears at the top of the class [repo/corp/Corporation.php:4](). Its purpose is not immediately clear from the code, but it may serve as a feature flag or environment indicator. The value `false` suggests that certain configuration-dependent features may be disabled by default.

**Sources:** [repo/corp/Corporation.php:4]()

---

## System Integration and Usage

The `Corporation` class constants are consumed by multiple components throughout the GESFINANCIERO system.

### Integration Points Diagram

```mermaid
graph TB
    Corp["Corporation Class<br/>repo/corp/Corporation.php"]
    
    subgraph "Database Layer"
        Sing["Singleton<br/>src/utiles/Singleton.php"]
        ClsD["Clsdatos<br/>src/datos/Clsdatos.php"]
    end
    
    subgraph "Business Logic Layer"
        OpCtrl["OperacionesCtrl<br/>src/controlador/OperacionesCtrl.php"]
        OpHome["OperacionesHomeCtrl<br/>src/controlador/OperacionesHomeCtrl.php"]
    end
    
    subgraph "External Libraries"
        Mail["PHPMailer<br/>src/libs/PHPMailer-61/"]
    end
    
    Corp -->|"HOST, DBUSER<br/>DBPASS, DBNAME"| Sing
    Sing --> ClsD
    
    Corp -->|"MAIL_* constants"| OpCtrl
    Corp -->|"MAIL_* constants"| OpHome
    
    OpCtrl --> Mail
    OpHome --> Mail
    Mail -.->|"reads constants"| Corp
```

### Primary Consumers

| Component | Constants Used | Purpose |
|-----------|---------------|---------|
| `Singleton` | `HOST`, `DBUSER`, `DBPASS`, `DBNAME` | Database connection initialization |
| `OperacionesCtrl` | `MAIL_*` | System email notifications |
| `OperacionesHomeCtrl` | `MAIL_*` | Account activation emails |
| PHPMailer instances | `MAIL_*` | SMTP configuration |

### Code References

Database connection in `Singleton`:
```php
// Reads Corporation::HOST, DBUSER, DBPASS, DBNAME
$this->conexion = mysqli_connect(
    Corporation::HOST,
    Corporation::DBUSER,
    Corporation::DBPASS,
    Corporation::DBNAME
);
```

Email configuration in business logic:
```php
// PHPMailer setup reading Corporation constants
$mail->Host       = Corporation::MAIL_HOST;
$mail->SMTPAuth   = Corporation::MAIL_SMTPAUTHE;
$mail->Username   = Corporation::MAIL_USERNAME;
$mail->Password   = Corporation::MAIL_PASSWORD;
$mail->Port       = Corporation::MAIL_PORT;
$mail->SMTPSecure = Corporation::MAIL_SMTPSECURE;
```

**Sources:** [repo/corp/Corporation.php:1-23]()

---

## Module Entry Point

The `corp` module includes an entry point file that follows the standard module pattern:

[repo/corp/index.php:1-2]()

The file is currently empty (contains only the opening PHP tag), which is consistent with other module entry points in the repository system. This suggests that:

1. The entry point exists to satisfy the module pattern convention
2. The module's primary function is configuration, not request handling
3. Runtime operations may be planned but not yet implemented

If the module were to handle HTTP requests directly (e.g., for corporate data management), this entry point would contain routing logic similar to other modules.

**Sources:** [repo/corp/index.php:1-2]()

---

## Runtime Data Storage

While not explicitly listed in `.gitignore`, the `corp` module directory follows the implicit pattern of storing runtime corporate data that should not be tracked in version control.

### Expected Runtime Data Types

Based on the module name and system architecture, the `corp` module directory may contain:

- **Corporate logos and branding assets** - Company-specific images and graphics
- **Institution-specific configuration files** - Per-tenant or per-institution settings
- **Corporate document templates** - Letter heads, report templates
- **Cached corporate data** - Precomputed or cached organizational information

### Storage Pattern

```mermaid
graph LR
    App["Application Logic"]
    CorpIdx["corp/index.php<br/>(Entry Point)"]
    CorpClass["corp/Corporation.php<br/>(Config Class)"]
    RuntimeData["corp/[runtime files]<br/>(Ignored)"]
    
    App -.->|"may route to"| CorpIdx
    App -->|"reads constants"| CorpClass
    App -->|"writes/reads data"| RuntimeData
    
    Git["Git Version Control"]
    
    Git -->|"tracks"| CorpIdx
    Git -->|"tracks"| CorpClass
    Git -.->|"ignores"| RuntimeData
    
    style RuntimeData fill:#eee
    style Git fill:#cfc
```

Unlike other modules which are explicitly listed in `.gitignore`, the `corp` module's runtime data is implicitly ignored. This means any files created in the directory (other than the tracked PHP files) will not be committed to version control unless explicitly added.

**Sources:** [.gitignore:16-29]()

---

## Security Considerations

The `Corporation` class presents several security concerns that should be addressed in production deployments.

### Critical Security Issues

| Issue | Severity | Description | Recommendation |
|-------|----------|-------------|----------------|
| Hardcoded database credentials | 🔴 Critical | Database username and password in source code | Externalize to environment variables |
| Hardcoded SMTP credentials | 🔴 Critical | Email server password in plaintext | Use environment variables or secrets manager |
| No encryption for SMTP | 🟡 Medium | `MAIL_SMTPSECURE` is empty | Consider TLS/SSL encryption |
| Tracked in Git | 🔴 Critical | Credentials visible in version history | Rotate credentials, use `.env` files |
| Port 25 usage | 🟡 Medium | Unencrypted SMTP port | Consider port 587 (TLS) or 465 (SSL) |

### Security Risk Flow

```mermaid
graph TB
    VCS["Version Control System<br/>Git Repository"]
    Corp["Corporation.php<br/>WITH PLAINTEXT CREDENTIALS"]
    
    subgraph "Risk Vectors"
        PubRepo["Public Repository<br/>GitHub/GitLab"]
        TeamAccess["Team Member Access<br/>Former Employees"]
        DevEnv["Development Environments<br/>Local Machines"]
        GitHist["Git History<br/>All Commits"]
    end
    
    subgraph "Compromised Systems"
        DB["Database Access<br/>nuevapp_apps"]
        SMTP["Email Server Access<br/>smtp.ipage.com"]
        DataBreach["Potential Data Breach"]
    end
    
    VCS --> Corp
    Corp --> PubRepo
    Corp --> TeamAccess
    Corp --> DevEnv
    Corp --> GitHist
    
    PubRepo -.->|"credentials exposed"| DB
    TeamAccess -.->|"credentials exposed"| DB
    DevEnv -.->|"credentials exposed"| DB
    GitHist -.->|"credentials exposed"| DB
    
    PubRepo -.->|"credentials exposed"| SMTP
    TeamAccess -.->|"credentials exposed"| SMTP
    
    DB --> DataBreach
    SMTP --> DataBreach
```

### Recommended Mitigation Strategy

1. **Externalize Configuration:** Move all credentials to environment variables or a `.env` file that is not tracked in Git.

2. **Use Environment Variables:**
   ```php
   const HOST     = getenv('DB_HOST') ?: 'db';
   const DBUSER   = getenv('DB_USER') ?: 'rootapps';
   const DBPASS   = getenv('DB_PASS');
   const DBNAME   = getenv('DB_NAME') ?: 'nuevapp_apps';
   ```

3. **Rotate Credentials:** Change all database and SMTP passwords immediately after externalizing configuration.

4. **Implement Secrets Management:** For production deployments, use a secrets management system like HashiCorp Vault, AWS Secrets Manager, or Azure Key Vault.

5. **Enable SMTP Encryption:** Update `MAIL_SMTPSECURE` to `'tls'` and `MAIL_PORT` to `587` for secure email transmission.

6. **Remove from Git History:** Use `git filter-branch` or BFG Repo-Cleaner to remove credential history from the repository (if applicable).

For detailed security hardening recommendations, see [Security Hardening](#11.2).

**Sources:** [repo/corp/Corporation.php:6-20]()

---

## Comparison with Other Modules

The `corp` module differs significantly from other repository modules in both structure and purpose:

### Module Comparison Table

| Aspect | corp Module | Other Modules (anexos, avatar, etc.) |
|--------|-------------|-------------------------------------|
| **Primary Purpose** | Configuration storage | User-generated content handling |
| **Tracked Files** | `index.php` + `Corporation.php` | Only `index.php` |
| **Runtime Data** | Corporate assets (implicit ignore) | Attachments, images (explicit ignore) |
| **Git Ignore Pattern** | Not explicitly listed | Explicitly listed in `.gitignore` |
| **Infrastructure Role** | Critical system configuration | Feature-specific functionality |
| **Entry Point Status** | Empty (configuration-only) | Empty (routing to be implemented) |
| **System Dependencies** | Database, SMTP, all system components | Specific features only |

The `corp` module's unique role as a configuration provider makes it foundational to the entire system, unlike feature-specific modules that handle discrete functionality.

**Sources:** [.gitignore:16-29](), [repo/corp/Corporation.php:1-23](), [repo/corp/index.php:1-2]()

---

## Best Practices for Configuration Management

Given the current implementation, here are recommended practices for working with the `Corporation` class:

### Development Environment

1. **Local Overrides:** Create a `Corporation.local.php` that extends the base class (add to `.gitignore`)
2. **Docker Integration:** Use environment variables in Docker Compose files
3. **Documentation:** Maintain a `Corporation.example.php` with placeholder values

### Deployment Pipeline

1. **Build-Time Injection:** Inject credentials during CI/CD pipeline execution
2. **Environment-Specific Configs:** Maintain separate configuration for dev/staging/production
3. **Credential Rotation:** Implement automated credential rotation procedures

### Code Changes

When modifying the `Corporation` class:
- Never commit actual credentials
- Update example files when adding new constants
- Document the purpose and expected values of new constants
- Consider backward compatibility for existing consumers

**Sources:** [repo/corp/Corporation.php:1-23]()

---

## Summary

The Corporate Module (`corp`) serves a dual role in the GESFINANCIERO system:

1. **Configuration Provider:** Houses the `Corporation` class with system-wide constants for database and email connectivity
2. **Data Storage:** Provides a location for corporate-specific runtime data (implicitly ignored by Git)

**Key Characteristics:**
- Contains tracked configuration code (`Corporation.php`) unlike other modules
- Centralizes all infrastructure credentials (database, SMTP)
- Currently presents critical security vulnerabilities with hardcoded plaintext credentials
- Has an empty entry point following the standard module pattern
- Is consumed by core system components including `Singleton`, `OperacionesCtrl`, and email services

**Critical Action Items:**
- ⚠️ Externalize credentials from `Corporation.php` to environment variables
- ⚠️ Rotate all exposed credentials (database and SMTP passwords)
- ⚠️ Implement proper secrets management for production deployments
- ⚠️ Enable SMTP encryption for secure email transmission

For deployment-specific configuration guidance, see [Environment Configuration](#11.1).

**Sources:** [repo/corp/Corporation.php:1-23](), [repo/corp/index.php:1-2](), [.gitignore:1-30]()

---

---

## 8. Libraries and Utilities

## Purpose and Scope

This document provides technical documentation for the reusable library components in the GESFINANCIERO system. These libraries are located in [src/libs/]() and provide specialized functionality for API token management, temporary secure page generation, email notifications, and QR code generation.

The libraries documented here are utility components that are consumed by the controller and business logic layers. For information about how these libraries are integrated into the overall application flow, see [Controller Layer](#3) and [Business Logic Layer](#4). For database interaction utilities, see [Data Layer](#5).

---

## Library Architecture Overview

The system includes four primary library components organized under [src/libs/](). Each library is encapsulated in its own namespace and provides a specific set of capabilities.

```mermaid
graph TB
    subgraph "Controller and Business Logic Layer"
        OPCTRL["OperacionesCtrl"]
        OPHOMECTRL["OperacionesHomeCtrl"]
        INDEXCTRL["IndexCtrl"]
        REST["Rest"]
    end
    
    subgraph "Library Components - src/libs/"
        APIBOX["ApiboxLib<br/>src/libs/Apibox/"]
        MAGIC["MagicPagesLib<br/>src/libs/MagicPages/"]
        PHPMAILER["PHPMailer<br/>src/libs/PHPMailer-61/"]
        QRCODE["phpqrcode<br/>src/libs/phpqrcode/"]
    end
    
    subgraph "Supporting Components"
        UTILES["Utiles<br/>src/sistema/Utiles.php"]
        CLSDATOS["Clsdatos<br/>src/datos/Clsdatos.php"]
        SINGLETON["Singleton<br/>src/datos/Singleton.php"]
    end
    
    subgraph "Data Models"
        APIBOX_MODEL["Apibox Model<br/>src/modelo/Apibox.php"]
        MAGIC_MODEL["Magicpages Model<br/>src/modelo/Magicpages.php"]
    end
    
    subgraph "Database Tables"
        DB_APIBOX[("apibox table")]
        DB_MAGIC[("magicpages table")]
    end
    
    OPCTRL --> APIBOX
    OPCTRL --> MAGIC
    OPCTRL --> PHPMAILER
    OPHOMECTRL --> MAGIC
    OPHOMECTRL --> PHPMAILER
    REST --> APIBOX
    INDEXCTRL --> MAGIC
    
    APIBOX --> APIBOX_MODEL
    APIBOX --> SINGLETON
    MAGIC --> MAGIC_MODEL
    MAGIC --> SINGLETON
    MAGIC --> UTILES
    
    APIBOX_MODEL --> CLSDATOS
    MAGIC_MODEL --> CLSDATOS
    
    CLSDATOS --> SINGLETON
    
    SINGLETON --> DB_APIBOX
    SINGLETON --> DB_MAGIC
```

**Sources:** [src/libs/Apibox/ApiboxLib.php:1-132](), [src/libs/MagicPages/MagicPagesLib.php:1-254](), [src/libs/PHPMailer-61/composer.json:1-6]()

---

## ApiboxLib - API Key Management

### Overview

`ApiboxLib` manages API authentication tokens for the REST API system. It handles RSA key pair storage, retrieval, and validation for user-specific API access. The library operates on the `apibox` database table and provides CRUD operations for managing API keys.

**Namespace:** `src\libs\Apibox`

**Key Responsibilities:**
- Store RSA public/private key pairs per user
- Retrieve API keys for authentication validation
- Compare public keys for token verification
- Manage key lifecycle (create, update, delete)

### Core Operations

The library provides seven static methods for API key management:

| Method | Purpose | Returns |
|--------|---------|---------|
| `Crear()` | Create new API key entry | Public key string |
| `Actualizar()` | Update existing key (delete + recreate) | New public key |
| `Obtener()` | Retrieve keys by user ID | Array of key records |
| `Comparar()` | Find user by public key | Array of matching records |
| `Eliminar()` | Delete keys for specific user | Boolean |
| `EliminarTodo()` | Delete all API keys | Boolean |

### Data Flow Diagram

```mermaid
sequenceDiagram
    participant REST as "Rest Handler"
    participant APIBOX as "ApiboxLib"
    participant MODEL as "Apibox Model"
    participant SINGLETON as "Singleton"
    participant DB as "apibox Table"
    
    Note over REST,DB: Token Generation Flow
    REST->>APIBOX: Crear(id, key)
    APIBOX->>APIBOX: Set timezone America/Bogota
    APIBOX->>MODEL: new Apibox()
    APIBOX->>MODEL: setUsuarios_id(id)
    APIBOX->>MODEL: setPublica(pub_key)
    APIBOX->>MODEL: setPrivada(priv_key)
    APIBOX->>MODEL: setActivo(1)
    APIBOX->>MODEL: saveData()
    MODEL->>SINGLETON: INSERT query
    SINGLETON->>DB: Execute INSERT
    DB-->>SINGLETON: Success/Error
    SINGLETON-->>MODEL: Result
    MODEL-->>APIBOX: ID or Error
    APIBOX-->>REST: Public Key
    
    Note over REST,DB: Token Validation Flow
    REST->>APIBOX: Comparar(pkey)
    APIBOX->>SINGLETON: _readInfo("apibox", fields, where)
    SINGLETON->>DB: SELECT query
    DB-->>SINGLETON: Key record
    SINGLETON-->>APIBOX: User data
    APIBOX-->>REST: Usuario_id + metadata
```

**Sources:** [src/libs/Apibox/ApiboxLib.php:9-41](), [src/libs/Apibox/ApiboxLib.php:61-82](), [src/libs/Apibox/ApiboxLib.php:84-99]()

### Method Details

#### Crear - Create API Key

[src/libs/Apibox/ApiboxLib.php:9-41]()

Creates a new API key entry for a user. Stores RSA public and private keys in the database.

**Parameters:**
- `$d['id']` - User ID (`usuarios_id`)
- `$d['key']['pub']` - RSA public key (full PEM format)
- `$d['key']['pri']` - RSA private key (full PEM format)
- `$d['key']['fecha']` - Timestamp

**Process:**
1. Sets timezone to `America/Bogota`
2. Includes dependencies: `Clsdatos`, `Apibox` model
3. Creates new `Apibox` model instance
4. Sets user ID, public key, private key, active status (1), and date
5. Calls `saveData()` to persist to database
6. Throws exception if error occurs
7. Returns public key string

#### Obtener - Retrieve API Key

[src/libs/Apibox/ApiboxLib.php:61-82]()

Retrieves API key information for a specific user. Optionally includes the private key in results.

**Parameters:**
- `$d['id']` - User ID
- `$d['privada']` - Boolean, include private key if true

**Query Construction:**
```
SELECT id, usuarios_id, publica, activo, fecha [, privada]
FROM apibox
WHERE usuarios_id = {id}
```

**Returns:** Array of matching records or error with HTTP status `601`

#### Comparar - Find User by Key

[src/libs/Apibox/ApiboxLib.php:84-99]()

Searches for a user by their public key. Used during token validation to identify the authenticated user.

**Parameters:**
- `$d['pkey']` - Public key string to search for

**Query Construction:**
```
SELECT id, usuarios_id, publica, activo, fecha
FROM apibox
WHERE publica = '{pkey}'
```

**Returns:** Array of matching records (typically one or empty)

#### Actualizar - Update API Key

[src/libs/Apibox/ApiboxLib.php:43-59]()

Updates an API key by deleting the existing entry and creating a new one. This implements a replace pattern rather than an in-place update.

**Process:**
1. Calls `Eliminar()` with user ID
2. If deletion succeeds, calls `Crear()` with new key data
3. Throws exception if either operation fails

#### Eliminar - Delete User's Keys

[src/libs/Apibox/ApiboxLib.php:101-115]()

Deletes all API keys for a specific user.

**Query:** `DELETE FROM apibox WHERE usuarios_id = {id}`

**Returns:** `true` on success, throws exception on error

#### EliminarTodo - Delete All Keys

[src/libs/Apibox/ApiboxLib.php:117-130]()

Deletes all API keys from the system. Used for maintenance or reset operations.

**Query:** `DELETE FROM apibox WHERE id > 0`

**Returns:** `true` on success, throws exception on error

### Error Handling

The library defines two error constants:

| Constant | Value | Description |
|----------|-------|-------------|
| `ERR_COD_ABL_SQLERRADO` | 601 | SQL execution error |
| `ERR_COD_ABL_RESPUESTA_VACIA` | 602 | Empty response error |

[src/libs/Apibox/ApiboxLib.php:6-7]()

Errors are thrown as exceptions with descriptive messages. The `Obtener()` method also sets HTTP response code 601 for SQL errors.

### Database Schema

The `apibox` table structure (inferred from usage):

| Column | Type | Purpose |
|--------|------|---------|
| `id` | INT | Primary key |
| `usuarios_id` | INT | Foreign key to user |
| `publica` | TEXT | RSA public key (PEM format) |
| `privada` | TEXT | RSA private key (PEM format) |
| `activo` | TINYINT | Active status flag |
| `fecha` | DATETIME | Creation timestamp |

**Sources:** [src/libs/Apibox/ApiboxLib.php:1-132]()

---

## MagicPagesLib - Temporary Page System

### Overview

`MagicPagesLib` manages temporary secure pages that expire after a set duration. It generates unique codes that grant one-time or time-limited access to specific URLs, commonly used for email verification links, password resets, and secure document sharing.

**Namespace:** `src\libs\MagicPages`

**Key Features:**
- UUID-based unique code generation
- 10-minute default expiration
- URL parameter passing
- Email validation
- Automatic expiration checking
- Template-based view rendering

### Core Operations

| Method | Purpose | Returns |
|--------|---------|---------|
| `Crear()` | Create temporary page entry | Array with ID and code |
| `Actualizar()` | Refresh expiration (delete + recreate) | New code data |
| `ObtenerPorCodigo()` | Retrieve page by code | Array of page data |
| `EliminarPorId()` | Delete by database ID | Boolean |
| `EliminarPorCodigo()` | Delete by unique code | Boolean |
| `EliminarTodo()` | Delete all temporary pages | Boolean |
| `ObtenerVista()` | Load success template | void (includes file) |
| `ObtenerVistaError()` | Load error template | void (includes file) |

### Temporary Page Lifecycle

```mermaid
stateDiagram-v2
    [*] --> Created: Crear(url, email, params)
    Created --> Active: UUID generated<br/>10 min expiration set
    Active --> Accessed: User follows link<br/>ObtenerPorCodigo()
    Active --> Expired: 10 minutes elapsed<br/>NOW > expira
    Accessed --> Validated: Email matches<br/>Code exists
    Validated --> Refreshed: Actualizar()<br/>New 10 min window
    Validated --> Deleted: EliminarPorCodigo()<br/>One-time use
    Expired --> Deleted: Cleanup
    Refreshed --> Active
    Deleted --> [*]
    
    note right of Created
        Initial state:
        - codigo: UUID
        - url: Target page
        - params: Query string
        - email: Owner
        - expira: NOW + 10 min
    end note
    
    note right of Expired
        Query includes:
        (NOW() > expira) as expirado
        to check expiration status
    end note
```

**Sources:** [src/libs/MagicPages/MagicPagesLib.php:22-60](), [src/libs/MagicPages/MagicPagesLib.php:70-104](), [src/libs/MagicPages/MagicPagesLib.php:141-149]()

### Method Details

#### Crear - Create Temporary Page

[src/libs/MagicPages/MagicPagesLib.php:22-60]()

Creates a new temporary page entry with a unique code and expiration time.

**Parameters:**
- `$d['url']` - Target URL to display
- `$d['email']` - Email address of owner
- `$d['params']` - Optional query parameters (default: "")

**Process:**
1. Sets timezone to `America/Bogota`
2. Generates UUID using `Utiles::create_uuid()`
3. Checks if UUID already exists (loops until unique)
4. Creates `Magicpages` model instance
5. Sets code, URL, expiration (`NuevaFecha()`), params, email
6. Calls `saveData()` to persist
7. Returns array: `['id' => new_id, 'codigo' => uuid]`

**Expiration Calculation:** [src/libs/MagicPages/MagicPagesLib.php:10-13]()

```
private static function NuevaFecha() {
    $horaReg = strtotime("+10 minutes", strtotime(date('Y-m-d H:i:s')));
    return date("Y-m-d H:i:s", $horaReg);
}
```

Default expiration is 10 minutes from creation time.

#### ObtenerPorCodigo - Retrieve by Code

[src/libs/MagicPages/MagicPagesLib.php:141-149]()

Retrieves page data using its unique code. This is the primary lookup method for accessing temporary pages.

**Parameters:**
- `$d['codigo']` - UUID code to search for

**Internal Query:** [src/libs/MagicPages/MagicPagesLib.php:114-132]()

```
SELECT id, codigo, url, params, expira, email, 
       (NOW() > expira) as expirado
FROM magicpages
WHERE codigo = '{codigo}'
```

The query includes an `expirado` computed column that indicates whether the page has expired.

**Returns:** Array of matching records (0 or 1 element)

#### Actualizar - Refresh Expiration

[src/libs/MagicPages/MagicPagesLib.php:70-104]()

Refreshes a temporary page by deleting it and recreating with a new expiration time. Validates that the requesting email matches the owner.

**Parameters:**
- `$d['id']` - Code to update
- `$d['email']` - Email for validation

**Process:**
1. Retrieves existing page by code
2. Validates email matches owner: `$obTmp['email'] == $email`
3. Calls `EliminarPorCodigo()` to delete
4. Calls `Crear()` with original URL, email, and params
5. Returns new code data with refreshed expiration

**Security:** Throws exception if email doesn't match owner

#### Eliminar Methods

Three deletion methods provide different access patterns:

**EliminarPorId** [src/libs/MagicPages/MagicPagesLib.php:181-189]()
- Deletes by database ID
- Query: `DELETE FROM magicpages WHERE id = {id}`

**EliminarPorCodigo** [src/libs/MagicPages/MagicPagesLib.php:200-208]()
- Deletes by unique code (most common)
- Query: `DELETE FROM magicpages WHERE codigo = "{code}"`

**EliminarTodo** [src/libs/MagicPages/MagicPagesLib.php:218-230]()
- Deletes all temporary pages
- Query: `DELETE FROM magicpages WHERE id > 0`

All use `Singleton::_classicDelete()` for execution.

#### View Rendering

**ObtenerVista** [src/libs/MagicPages/MagicPagesLib.php:238-241]()
- Includes [src/libs/MagicPages/Magicpages.phtml]() template
- Passes `$raw` data to template
- Used for successful page access

**ObtenerVistaError** [src/libs/MagicPages/MagicPagesLib.php:249-252]()
- Includes [src/libs/MagicPages/MagicpagesNoCode.phtml]() template
- Used for invalid or expired codes

### Database Schema

The `magicpages` table structure (inferred from usage):

| Column | Type | Purpose |
|--------|------|---------|
| `id` | INT | Primary key |
| `codigo` | VARCHAR(36) | UUID unique code |
| `url` | TEXT | Target URL path |
| `params` | TEXT | Query string parameters |
| `expira` | DATETIME | Expiration timestamp |
| `email` | VARCHAR(255) | Owner email address |

### Dependencies

The library includes three dependencies at initialization:

[src/libs/MagicPages/MagicPagesLib.php:4-6]()

1. `Clsdatos` - Base ORM class
2. `Magicpages` model - Database entity
3. `Utiles` - UUID generation utility

**Sources:** [src/libs/MagicPages/MagicPagesLib.php:1-254]()

---

## PHPMailer Integration

### Overview

The system uses PHPMailer 6.1+ for email functionality, managed through Composer. PHPMailer is integrated into the business logic layer ([OperacionesCtrl](#4.1) and [OperacionesHomeCtrl](#4.2)) for sending notifications, account activations, and system alerts.

### Composer Configuration

[src/libs/PHPMailer-61/composer.json:1-6]()

```json
{
    "require": {
        "phpmailer/phpmailer": "^6.1"
    }
}
```

The library requires PHPMailer version 6.1 or higher, installed via Composer.

### Installation

Installation occurs in the [src/libs/PHPMailer-61/]() directory:

```
cd src/libs/PHPMailer-61/
composer install
```

This creates the `vendor/` directory with PHPMailer and its dependencies.

### Integration Points

PHPMailer is not called directly from a library wrapper class. Instead, it's instantiated and configured directly in business logic methods:

**Primary Users:**
- `OperacionesCtrl::enviar_Notificacion()` - Template-based email sending
- `OperacionesCtrl::enviarCustomEmail()` - Custom email composition
- `OperacionesHomeCtrl::actviarSendMail()` - Account activation emails

### SMTP Configuration

SMTP settings are stored in [Corporation.php](#6.1) constants (see Configuration documentation):

| Constant | Purpose | Example Value |
|----------|---------|---------------|
| `Corporation::SMTP_HOST` | SMTP server address | `smtp.ipage.com` |
| `Corporation::SMTP_PORT` | SMTP port | `25` |
| `Corporation::SMTP_USER` | Authentication username | Email address |
| `Corporation::SMTP_PASS` | Authentication password | Password |
| `Corporation::FROM_EMAIL` | Sender email | System email |
| `Corporation::FROM_NAME` | Sender name | System name |

### Usage Pattern

Typical PHPMailer initialization in business logic:

```
1. require_once 'src/libs/PHPMailer-61/vendor/autoload.php'
2. $mail = new PHPMailer\PHPMailer\PHPMailer(true)
3. Configure SMTP from Corporation constants
4. Set recipients, subject, body (HTML/text)
5. Send with error handling
```

**Sources:** [src/libs/PHPMailer-61/composer.json:1-6]()

---

## Additional Libraries

### phpqrcode Library

Located in [src/libs/phpqrcode/](), this library provides QR code generation functionality. It's a third-party library for creating QR codes that can encode URLs, text, or other data for mobile scanning.

**Typical Use Cases:**
- Document verification codes
- Mobile-friendly access links
- Two-factor authentication displays

**Integration:** Included directly in code that needs QR generation functionality.

### Utiles Utility Class

[src/sistema/Utiles.php]() provides system-wide utility functions including UUID generation used by `MagicPagesLib`.

**Key Method:**
- `Utiles::create_uuid()` - Generates RFC 4122 compliant UUIDs for unique code generation

**Sources:** [src/libs/MagicPages/MagicPagesLib.php:6](), [src/libs/MagicPages/MagicPagesLib.php:35]()

---

## Library Usage Patterns

### Dependency Injection Pattern

Libraries use explicit path-based includes rather than autoloading:

```mermaid
graph LR
    LIB["Library Class<br/>ApiboxLib/MagicPagesLib"]
    DEP1["Clsdatos<br/>dirname(__FILE__) + /datos/"]
    DEP2["Model<br/>dirname(__FILE__) + /modelo/"]
    DEP3["Singleton<br/>dirname(__FILE__) + /datos/"]
    
    LIB -->|"include_once"| DEP1
    LIB -->|"include_once"| DEP2
    LIB -->|"include_once"| DEP3
```

**Pattern:** [src/libs/Apibox/ApiboxLib.php:11-12](), [src/libs/MagicPages/MagicPagesLib.php:4-6]()

Each library includes its dependencies using relative paths from `__FILE__`, ensuring proper resolution regardless of calling context.

### Static Method Pattern

Both `ApiboxLib` and `MagicPagesLib` use exclusively static methods. This provides:

**Advantages:**
- No instantiation required
- Simple calling syntax: `ApiboxLib::Crear($data)`
- Stateless operation (no instance variables)
- Easy integration into existing procedural code

**Disadvantages:**
- Harder to mock for testing
- No polymorphism or inheritance
- All state must be passed as parameters or stored in database

### Error Handling Pattern

All library methods use exception-based error handling:

```
try {
    $result = LibraryClass::Method($params);
} catch (\Exception $e) {
    // Handle error: log, return JSON error, etc.
}
```

Internal errors from database operations or model saves are caught and re-thrown with descriptive context.

### Database Access Pattern

Libraries interact with the database through two mechanisms:

**1. Model-Based (ORM):**
```
$model = new ModelClass();
$model->setField($value);
$model->saveData();
```
Used in `Crear()` methods for creating new records.

**2. Direct Queries (Singleton):**
```
$result = \Singleton::_readInfo($table, $fields, $where);
\Singleton::_classicDelete($table, $where);
```
Used in retrieval and deletion methods for direct SQL access.

**Sources:** [src/libs/Apibox/ApiboxLib.php:28-38](), [src/libs/Apibox/ApiboxLib.php:74](), [src/libs/MagicPages/MagicPagesLib.php:47-54](), [src/libs/MagicPages/MagicPagesLib.php:125]()

---

## Security Considerations

### API Key Storage

**Issue:** Private keys stored in plaintext in database ([src/libs/Apibox/ApiboxLib.php:26-31]())

**Risk:** If database is compromised, private keys are exposed

**Mitigation:** Consider encrypting private keys at rest or using key management service

### SQL Injection Risk

Both libraries use `Singleton::_classicDelete()` and string concatenation for WHERE clauses:

[src/libs/Apibox/ApiboxLib.php:106]()
```
$xt = "where usuarios_id = " . $id . " ";
```

[src/libs/MagicPages/MagicPagesLib.php:73]()
```
$xt = "where " . $campo . " = " . $id . " ";
```

**Risk:** No prepared statements, potential SQL injection if input not sanitized

**Recommendation:** Use `Singleton::_safeDelete()` with parameter binding instead

### Temporary Page Security

`MagicPagesLib` implements several security measures:

**Expiration Enforcement:** [src/libs/MagicPages/MagicPagesLib.php:123]()
- Query includes `(NOW() > expira) as expirado`
- Application must check this flag

**Email Validation:** [src/libs/MagicPages/MagicPagesLib.php:81-83]()
- `Actualizar()` verifies requesting email matches owner
- Prevents unauthorized expiration refreshes

**UUID Uniqueness:** [src/libs/MagicPages/MagicPagesLib.php:34-45]()
- Loops until unique code generated
- Prevents code prediction attacks

**Recommendations:**
- Implement rate limiting on code generation
- Add attempt tracking to detect brute force
- Consider shorter expiration for sensitive operations

---

## Summary

The GESFINANCIERO library system provides three specialized components:

1. **ApiboxLib** - RSA key pair management for REST API authentication
2. **MagicPagesLib** - Time-limited temporary page generation for secure one-time access
3. **PHPMailer** - SMTP email sending with template support

All libraries follow a static method pattern with exception-based error handling. They integrate with the data layer through `Singleton` and model classes, maintaining consistency with the overall application architecture.

**Key Integration Points:**
- Business logic layer consumes all three libraries
- REST API uses `ApiboxLib` for token validation
- Account activation and password recovery use `MagicPagesLib`
- Notification system uses PHPMailer for all email communication

**Technical Debt:**
- Migrate from `_classicDelete()` to prepared statements
- Encrypt private keys in `apibox` table
- Add automated cleanup for expired `magicpages` entries
- Implement comprehensive logging for security auditing

For detailed usage examples and integration patterns, see [Business Logic Layer](#4), [REST API Handler](#3.3), and [Authentication System](#10.1).

---

---

## 8.1 ApiboxLib - API Key Management

**Purpose:** This document describes the `ApiboxLib` library, which manages RSA-based API authentication tokens for authorized users in the GESFINANCIERO system. This library handles the complete lifecycle of API tokens including generation, storage, retrieval, validation, and deletion.

**Scope:** This page covers the token management library itself and its integration with the authentication system. For information about REST API endpoint authentication, see [Rest - REST API Handler](#3.3). For broader authentication mechanisms including session management, see [Authentication System](#10.1). For token usage in API requests, see [Token Management](#10.2).

---

## Overview

The `ApiboxLib` provides API key management capabilities using RSA public/private key pairs. It enables authorized users to generate authentication tokens that can be used for REST API access without requiring session-based authentication. The library stores token data in the `apibox` database table and integrates tightly with `OperacionesCtrl` for token generation and validation operations.

**Key Characteristics:**
- RSA 2048-bit encryption
- SHA512 digest algorithm
- Per-user token storage
- Profile-based authorization (profiles 1, 2, 7 only)
- Passphrase-protected private keys

**Primary Use Cases:**
- Generate API tokens for authorized users
- Validate Bearer tokens in REST API requests
- Manage token lifecycle (create, retrieve, update, delete)
- Support machine-to-machine authentication

Sources: [src/libs/Apibox/ApiboxLib.php:1-132](), [src/ctrls/OperacionesCtrl.php:2-3](), [src/ctrls/OperacionesCtrl.php:621-643]()

---

## System Architecture

```mermaid
graph TB
    subgraph "Authentication Layer"
        AUTH["OperacionesCtrl::AutenticaUsuarioSisAjax"]
        GENTOK["OperacionesCtrl::GenerarToken"]
        COMPTOK["OperacionesCtrl::CompararToken"]
        OBTTOK["OperacionesCtrl::ObtenerToken"]
    end
    
    subgraph "Token Generation"
        GENKEY["OperacionesCtrl::GenerarLlavePublica"]
        RSA["OpenSSL RSA Key Generation<br/>2048-bit, SHA512"]
    end
    
    subgraph "ApiboxLib Core"
        CREAR["ApiboxLib::Crear"]
        ACTUALIZAR["ApiboxLib::Actualizar"]
        OBTENER["ApiboxLib::Obtener"]
        COMPARAR["ApiboxLib::Comparar"]
        ELIMINAR["ApiboxLib::Eliminar"]
        ELIMTODO["ApiboxLib::EliminarTodo"]
    end
    
    subgraph "Data Layer"
        MODEL["Apibox Model<br/>src/modelo/Apibox.php"]
        SINGLETON["Singleton::_readInfo<br/>Singleton::_classicDelete"]
        DB[("apibox table<br/>MySQL")]
    end
    
    AUTH -->|"validates credentials"| GENTOK
    GENTOK -->|"generates keys"| GENKEY
    GENKEY --> RSA
    GENTOK -->|"creates token"| CREAR
    GENTOK -->|"updates token"| ACTUALIZAR
    GENTOK -->|"checks existing"| OBTENER
    
    COMPTOK --> COMPARAR
    OBTTOK --> OBTENER
    
    CREAR --> MODEL
    ACTUALIZAR --> ELIMINAR
    ACTUALIZAR --> CREAR
    OBTENER --> SINGLETON
    COMPARAR --> SINGLETON
    ELIMINAR --> SINGLETON
    ELIMTODO --> SINGLETON
    
    MODEL --> DB
    SINGLETON --> DB
```

**Diagram: ApiboxLib Architecture and Component Relationships**

The architecture demonstrates a three-tier approach:
1. **Authentication Layer** - Validates users and orchestrates token operations
2. **ApiboxLib Core** - Provides CRUD operations for token management
3. **Data Layer** - Persists tokens to database via ORM and direct queries

Sources: [src/libs/Apibox/ApiboxLib.php:1-132](), [src/ctrls/OperacionesCtrl.php:621-787]()

---

## RSA Key Generation

The system uses OpenSSL to generate RSA key pairs for API authentication. Each key pair consists of a public key (returned to users) and a private key (stored securely in the database).

### Key Generation Configuration

```mermaid
graph LR
    CONFIG["RSA Configuration"]
    CONFIG --> ALG["digest_alg: sha512"]
    CONFIG --> BITS["private_key_bits: 2048"]
    CONFIG --> TYPE["private_key_type: OPENSSL_KEYTYPE_RSA"]
    
    PASS["Passphrase"]
    PASS --> EMAIL["user_email"]
    PASS --> TS["YmdHis timestamp"]
    PASS --> CONCAT["email + timestamp"]
```

**Diagram: RSA Key Configuration Parameters**

Sources: [src/ctrls/OperacionesCtrl.php:621-643]()

### Generation Process

The `GenerarLlavePublica()` method in `OperacionesCtrl` creates RSA key pairs:

| Parameter | Value | Purpose |
|-----------|-------|---------|
| `digest_alg` | `sha512` | Hash algorithm for signatures |
| `private_key_bits` | `2048` | Key strength in bits |
| `private_key_type` | `OPENSSL_KEYTYPE_RSA` | RSA encryption type |
| Passphrase | `{email}{YmdHis}` | Private key protection |

The method returns an array containing:
- `pub` - Public key in PEM format
- `pri` - Private key in PEM format (passphrase-protected)
- `fecha` - Timestamp of generation (Y-m-d H:i:s)

**Key Security Features:**
- Private keys are encrypted with user-specific passphrases
- Passphrase combines user email and timestamp
- Keys use industry-standard 2048-bit RSA encryption
- SHA512 provides strong cryptographic hashing

Sources: [src/ctrls/OperacionesCtrl.php:621-643]()

---

## Token Generation Workflow

```mermaid
sequenceDiagram
    participant Client
    participant GenerarToken
    participant AutenticaUsuarioSisAjax
    participant ApiboxLib
    participant GenerarLlavePublica
    participant Database
    
    Client->>GenerarToken: Request token<br/>{u, c, md5?, forcenew?}
    GenerarToken->>AutenticaUsuarioSisAjax: Validate credentials
    
    alt Authentication Failed
        AutenticaUsuarioSisAjax-->>GenerarToken: HTTP 401
        GenerarToken-->>Client: Exception
    end
    
    AutenticaUsuarioSisAjax-->>GenerarToken: User data
    
    alt Unauthorized Profile
        GenerarToken-->>Client: HTTP 401<br/>Profile not authorized
    end
    
    alt User Disabled
        GenerarToken-->>Client: HTTP 500<br/>User disabled
    end
    
    GenerarToken->>ApiboxLib: Obtener({id})
    ApiboxLib->>Database: SELECT from apibox
    Database-->>ApiboxLib: Existing tokens
    
    alt Token Exists & !forcenew
        ApiboxLib-->>GenerarToken: Return publica
        GenerarToken-->>Client: HTTP 200<br/>Public key
    else No Token or forcenew
        GenerarToken->>GenerarLlavePublica: Generate RSA keys<br/>{mail}
        GenerarLlavePublica-->>GenerarToken: {pub, pri, fecha}
        
        alt Update Existing
            GenerarToken->>ApiboxLib: Actualizar({id, key})
            ApiboxLib->>Database: DELETE + INSERT
        else Create New
            GenerarToken->>ApiboxLib: Crear({id, key})
            ApiboxLib->>Database: INSERT
        end
        
        Database-->>ApiboxLib: Success
        ApiboxLib-->>GenerarToken: Public key
        GenerarToken-->>Client: HTTP 200<br/>Public key
    end
```

**Diagram: Token Generation Sequence Flow**

Sources: [src/ctrls/OperacionesCtrl.php:674-787](), [src/libs/Apibox/ApiboxLib.php:9-41]()

### Authorization Requirements

Token generation is restricted to specific user profiles:

| Profile ID | Description | Token Access |
|------------|-------------|--------------|
| 1 | Administrator | ✓ Authorized |
| 2 | Manager | ✓ Authorized |
| 7 | API User | ✓ Authorized |
| Others | Standard Users | ✗ Denied |

Additionally, users must have `estado_id = 1` (active status).

Sources: [src/ctrls/OperacionesCtrl.php:696-784]()

---

## ApiboxLib Operations

### `Crear()` - Create Token

Creates a new API token record in the database.

**Input Parameters:**
```
{
    'id': int,           // usuarios_id
    'key': {
        'pub': string,   // Public key (PEM format)
        'pri': string,   // Private key (PEM format)
        'fecha': string  // Timestamp (Y-m-d H:i:s)
    }
}
```

**Return Value:** `string` - The public key

**Process:**
1. Extracts public and private keys from input
2. Creates new `Apibox` model instance
3. Sets `usuarios_id`, `publica`, `privada`, `activo=1`, `fecha`
4. Calls `saveData()` to persist to database
5. Returns public key on success

**Error Handling:**
- Throws exception if `saveData()` encounters errors
- Model validation errors propagated to caller

Sources: [src/libs/Apibox/ApiboxLib.php:9-41]()

---

### `Actualizar()` - Update Token

Updates an existing token by deleting the old one and creating a new one.

**Input Parameters:**
```
{
    'id': int,     // usuarios_id
    'key': object  // New key object (same format as Crear)
}
```

**Return Value:** `string` - The new public key

**Process:**
1. Calls `Eliminar()` to delete existing token
2. If deletion successful, calls `Crear()` with new key
3. Returns result from `Crear()`

**Note:** This is a delete-then-insert operation, not an in-place update.

Sources: [src/libs/Apibox/ApiboxLib.php:43-59]()

---

### `Obtener()` - Retrieve Token

Retrieves API token information for a specific user.

**Input Parameters:**
```
{
    'id': int,           // usuarios_id
    'privada': bool      // Optional: include private key
}
```

**Return Value:** `array` - Token records from database

**Default Fields Retrieved:**
- `id` - Token record ID
- `usuarios_id` - User ID
- `publica` - Public key
- `activo` - Active status
- `fecha` - Creation timestamp

**Optional Field:**
- `privada` - Private key (only if `privada=true`)

**SQL Query:**
```sql
SELECT id, usuarios_id, publica, activo, fecha [, privada]
FROM apibox
WHERE usuarios_id = {id}
```

**Error Codes:**
- `ERR_COD_ABL_SQLERRADO (601)` - SQL execution error

Sources: [src/libs/Apibox/ApiboxLib.php:61-82]()

---

### `Comparar()` - Validate Token

Validates a provided public key against stored tokens.

**Input Parameters:**
```
{
    'pkey': string  // Public key to validate
}
```

**Return Value:** `array` - Matching token record(s)

**SQL Query:**
```sql
SELECT id, usuarios_id, publica, activo, fecha
FROM apibox
WHERE publica = '{pkey}'
```

**Use Case:** Called by `OperacionesCtrl::CompararToken()` to validate Bearer tokens in REST API requests.

**Error Handling:**
- Throws exception if SQL error occurs
- Returns empty array if no match found

Sources: [src/libs/Apibox/ApiboxLib.php:84-99](), [src/ctrls/OperacionesCtrl.php:804-818]()

---

### `Eliminar()` - Delete Token

Deletes all API tokens for a specific user.

**Input Parameters:**
```
{
    'id': int  // usuarios_id
}
```

**Return Value:** `bool` - `true` on success

**SQL Query:**
```sql
DELETE FROM apibox WHERE usuarios_id = {id}
```

**Note:** Deletes all tokens associated with the user ID, not individual tokens.

Sources: [src/libs/Apibox/ApiboxLib.php:101-115]()

---

### `EliminarTodo()` - Delete All Tokens

Deletes all API tokens from the system.

**Input Parameters:** None

**Return Value:** `bool` - `true` on success

**SQL Query:**
```sql
DELETE FROM apibox WHERE id > 0
```

**Warning:** This is a destructive operation that removes all tokens system-wide.

Sources: [src/libs/Apibox/ApiboxLib.php:117-130]()

---

## Database Schema

The `apibox` table stores API token data:

| Column | Type | Description |
|--------|------|-------------|
| `id` | INT | Primary key, auto-increment |
| `usuarios_id` | INT | Foreign key to `usuarios.id` |
| `publica` | TEXT | Public RSA key (PEM format) |
| `privada` | TEXT | Private RSA key (PEM format, encrypted) |
| `activo` | TINYINT | Active status (1=active, 0=inactive) |
| `fecha` | DATETIME | Token creation timestamp |

**Indexes:**
- Primary key on `id`
- Index on `usuarios_id` for lookups
- Index on `publica` for validation queries

**Relationships:**
- `usuarios_id` → `usuarios.id` (one-to-many)
- One user can have multiple tokens (historical or active)

Sources: [src/libs/Apibox/ApiboxLib.php:28-33](), [src/libs/Apibox/ApiboxLib.php:66-74]()

---

## Integration Points

### Integration with OperacionesCtrl

The `OperacionesCtrl` class serves as the primary orchestrator for token operations:

```mermaid
graph TB
    subgraph "Public API Methods"
        GENTOK["GenerarToken(d)"]
        COMPTOK["CompararToken(d)"]
        OBTTOK["ObtenerToken(d)"]
    end
    
    subgraph "Private Helper Methods"
        GENKEY["GenerarLlavePublica(d)"]
    end
    
    subgraph "ApiboxLib Calls"
        CREAR["ApiboxLib::Crear"]
        ACTUAL["ApiboxLib::Actualizar"]
        OBTEN["ApiboxLib::Obtener"]
        COMP["ApiboxLib::Comparar"]
    end
    
    GENTOK -->|"check existing"| OBTEN
    GENTOK -->|"generate new"| GENKEY
    GENTOK -->|"first time"| CREAR
    GENTOK -->|"force new"| ACTUAL
    
    COMPTOK --> COMP
    OBTTOK --> OBTEN
    
    GENKEY -.->|"provides keys"| CREAR
    GENKEY -.->|"provides keys"| ACTUAL
```

**Diagram: OperacionesCtrl Integration with ApiboxLib**

Sources: [src/ctrls/OperacionesCtrl.php:674-862]()

### Usage in REST API Authentication

The REST API handler (`Rest` class) uses token comparison for authentication:

1. Extract Bearer token from HTTP Authorization header
2. Call `OperacionesCtrl::CompararToken()` with provided token
3. `CompararToken()` delegates to `ApiboxLib::Comparar()`
4. If match found, retrieve user data for authorization
5. If no match, reject request with HTTP 401

See [Rest - REST API Handler](#3.3) for complete REST authentication flow.

Sources: [src/ctrls/OperacionesCtrl.php:804-818]()

---

## Token Lifecycle

```mermaid
stateDiagram-v2
    [*] --> RequestToken: User authenticates
    
    RequestToken --> ValidateUser: Check credentials
    ValidateUser --> CheckProfile: Credentials valid
    ValidateUser --> [*]: Authentication failed (HTTP 401)
    
    CheckProfile --> CheckStatus: Profile authorized (1,2,7)
    CheckProfile --> [*]: Profile denied (HTTP 401)
    
    CheckStatus --> CheckExisting: User active (estado=1)
    CheckStatus --> [*]: User disabled (HTTP 500)
    
    CheckExisting --> ReturnExisting: Token exists & !forcenew
    CheckExisting --> GenerateNew: No token or forcenew=true
    
    ReturnExisting --> [*]: Return public key (HTTP 200)
    
    GenerateNew --> CreateKeys: Generate RSA key pair
    CreateKeys --> StoreToken: Save to apibox table
    StoreToken --> [*]: Return public key (HTTP 200)
    
    note right of StoreToken
        Uses ApiboxLib::Crear()
        or ApiboxLib::Actualizar()
    end note
```

**Diagram: Token Lifecycle State Machine**

Sources: [src/ctrls/OperacionesCtrl.php:674-787]()

### Token Operations Summary

| Operation | Method | Trigger | Result |
|-----------|--------|---------|--------|
| **Generate** | `GenerarToken()` | User requests API access | New RSA key pair created |
| **Validate** | `CompararToken()` | REST API request | Token matched against DB |
| **Retrieve** | `ObtenerToken()` | Internal operations | Token data fetched |
| **Update** | `Actualizar()` via `GenerarToken()` | forcenew=true | Old token deleted, new created |
| **Delete** | `Eliminar()` | Administrative action | User tokens removed |

Sources: [src/ctrls/OperacionesCtrl.php:674-862](), [src/libs/Apibox/ApiboxLib.php:1-132]()

---

## Error Handling

### ApiboxLib Error Codes

| Code | Constant | HTTP Status | Description |
|------|----------|-------------|-------------|
| 601 | `ERR_COD_ABL_SQLERRADO` | N/A | SQL execution error in ApiboxLib |
| 602 | `ERR_COD_ABL_RESPUESTA_VACIA` | N/A | Empty response from database query |

Sources: [src/libs/Apibox/ApiboxLib.php:6-7]()

### OperacionesCtrl HTTP Error Responses

Token generation and validation methods in `OperacionesCtrl` return specific HTTP status codes:

| HTTP Code | Scenario | Method |
|-----------|----------|--------|
| 200 | Token operation successful | `GenerarToken()` |
| 400 | Error obtaining existing tokens | `GenerarToken()` |
| 401 | Authentication failed | `GenerarToken()`, `CompararToken()`, `ObtenerToken()` |
| 401 | Profile not authorized | `GenerarToken()` |
| 500 | User disabled | `GenerarToken()` |
| 500 | Internal error creating/updating token | `GenerarToken()` |
| ERR_COD_RESPUESTA_SQL_VACIA | No token found (must create) | `ObtenerToken()` |

Sources: [src/ctrls/OperacionesCtrl.php:674-862]()

### Exception Handling Pattern

All ApiboxLib methods follow a consistent exception handling pattern:

```php
try {
    // Database operation
    $result = Singleton::_readInfo(...);
    // or
    $model->saveData();
} catch (Exception $e) {
    http_response_code(ERROR_CODE);
    throw new Exception('[ERROR_CODE] Method: ' . $e->getMessage());
}
```

This ensures:
- HTTP status codes are set before throwing exceptions
- Error context is preserved in exception messages
- Calling code can catch and handle exceptions appropriately

Sources: [src/libs/Apibox/ApiboxLib.php:1-132](), [src/ctrls/OperacionesCtrl.php:704-862]()

---

## Security Considerations

### Key Storage

**Public Keys:**
- Stored in plaintext in `apibox.publica` column
- Safe to transmit to clients
- Used for Bearer token authentication

**Private Keys:**
- Stored in `apibox.privada` column
- Protected with user-specific passphrase
- Passphrase format: `{user_email}{timestamp_YmdHis}`
- Never transmitted to clients

### Authentication Flow

1. **Token Generation:** Requires valid user credentials
2. **Profile Authorization:** Only profiles 1, 2, 7 can generate tokens
3. **Active Status:** Users must have `estado_id = 1`
4. **Token Validation:** Public key must match database record exactly

### Potential Security Issues

⚠️ **Note on Key Validation:**
- The `Comparar()` method uses direct string matching of public keys
- No expiration mechanism for tokens
- No token refresh mechanism implemented
- Tokens remain valid until explicitly deleted

⚠️ **Database Query Security:**
- `Obtener()` and `Comparar()` use direct string interpolation in SQL queries
- Should be migrated to prepared statements (safe methods)
- Current implementation at [src/libs/Apibox/ApiboxLib.php:73]() and [src/libs/Apibox/ApiboxLib.php:91]()

Sources: [src/libs/Apibox/ApiboxLib.php:61-99](), [src/ctrls/OperacionesCtrl.php:621-643]()

---

## Usage Examples

### Generating a Token

**Request Flow:**
1. Client authenticates with username/password
2. System validates credentials
3. If authorized, generates RSA key pair
4. Stores keys in `apibox` table
5. Returns public key to client

**Code Entry Point:** `OperacionesCtrl::GenerarToken()`

**Input:**
```php
$params = [
    'u' => 'username_or_email',
    'c' => 'password',
    'md5' => false,           // Optional: use MD5 auth method
    'forcenew' => false       // Optional: force new token generation
];
```

**Output:**
```php
// On success: string (public key)
"-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA...
-----END PUBLIC KEY-----"

// On error: Exception with HTTP status code
```

Sources: [src/ctrls/OperacionesCtrl.php:674-787]()

### Validating a Token

**Code Entry Point:** `OperacionesCtrl::CompararToken()`

**Input:**
```php
$params = [
    'pkey' => '-----BEGIN PUBLIC KEY-----...'
];
```

**Output:**
```php
// On success: array of matching token record(s)
[
    [
        'id' => 123,
        'usuarios_id' => 45,
        'publica' => '-----BEGIN PUBLIC KEY-----...',
        'activo' => 1,
        'fecha' => '2024-01-15 10:30:00'
    ]
]

// On error: Exception with HTTP 401
```

Sources: [src/ctrls/OperacionesCtrl.php:804-818](), [src/libs/Apibox/ApiboxLib.php:84-99]()

### Retrieving User Tokens

**Code Entry Point:** `OperacionesCtrl::ObtenerToken()`

**Input:**
```php
$params = [
    'id' => 45,              // usuarios_id
    'privada' => true        // Optional: include private key
];
```

**Output:**
```php
// On success: array of token records
[
    [
        'id' => 123,
        'usuarios_id' => 45,
        'publica' => '-----BEGIN PUBLIC KEY-----...',
        'privada' => '-----BEGIN PRIVATE KEY-----...',  // if requested
        'activo' => 1,
        'fecha' => '2024-01-15 10:30:00'
    ]
]

// On error: Exception with HTTP 401 or ERR_COD_RESPUESTA_SQL_VACIA
```

Sources: [src/ctrls/OperacionesCtrl.php:839-862](), [src/libs/Apibox/ApiboxLib.php:61-82]()

---

## Configuration Constants

ApiboxLib defines error code constants used throughout the system:

| Constant | Value | Purpose |
|----------|-------|---------|
| `ERR_COD_ABL_SQLERRADO` | 601 | SQL execution error in ApiboxLib operations |
| `ERR_COD_ABL_RESPUESTA_VACIA` | 602 | Empty response from database query |

These constants are referenced when throwing exceptions in database operations.

Sources: [src/libs/Apibox/ApiboxLib.php:6-7]()

---

---

## 8.2 MagicPagesLib - Temporary Page System

## Purpose and Scope

The **MagicPagesLib** library provides temporary, self-expiring secure page access functionality within the GESFINANCIERO system. It generates unique, time-limited URLs that allow external users to access specific application pages without authentication for a controlled period (10 minutes by default). This is commonly used for email-based document delivery, temporary resource sharing, and secure one-time page access scenarios.

This document covers the temporary page generation system. For persistent API token management, see [ApiboxLib - API Key Management](#8.1). For email notification functionality that often uses temporary pages, see [Email System (PHPMailer)](#8.3).

**Sources:** [src/libs/MagicPages/MagicPagesLib.php:1-254]()

---

## System Architecture

### Component Overview

```mermaid
graph TB
    subgraph "Controllers"
        INDEXCTRL["IndexCtrl<br/>API_GenerarMagicPage"]
        OPCTRL["OperacionesCtrl<br/>Business Logic"]
    end
    
    subgraph "MagicPages Library"
        MAGICLIB["MagicPagesLib"]
        
        subgraph "Core Operations"
            CREAR["Crear()"]
            ACTUALIZAR["Actualizar()"]
            OBTENER["ObtenerPorCodigo()"]
            ELIMINAR["EliminarPorId()<br/>EliminarPorCodigo()"]
        end
        
        subgraph "View Rendering"
            VISTA["ObtenerVista()"]
            VISTAERROR["ObtenerVistaError()"]
        end
    end
    
    subgraph "Data Layer"
        MODEL["Magicpages Model<br/>extends Clsdatos"]
        SINGLETON["Singleton<br/>DB Manager"]
    end
    
    subgraph "Templates"
        PHTML["Magicpages.phtml<br/>Expired Page"]
        NOCODE["MagicpagesNoCode.phtml<br/>Error Page"]
    end
    
    subgraph "Database"
        DBTABLE[("magicpages table<br/>id, codigo, url,<br/>params, expira, email")]
    end
    
    subgraph "Utilities"
        UTILES["Utiles::create_uuid()"]
    end
    
    INDEXCTRL --> MAGICLIB
    OPCTRL --> MAGICLIB
    
    MAGICLIB --> CREAR
    MAGICLIB --> ACTUALIZAR
    MAGICLIB --> OBTENER
    MAGICLIB --> ELIMINAR
    MAGICLIB --> VISTA
    MAGICLIB --> VISTAERROR
    
    CREAR --> MODEL
    ACTUALIZAR --> CREAR
    ACTUALIZAR --> ELIMINAR
    OBTENER --> SINGLETON
    ELIMINAR --> SINGLETON
    
    CREAR --> UTILES
    
    MODEL --> SINGLETON
    SINGLETON --> DBTABLE
    
    VISTA --> PHTML
    VISTAERROR --> NOCODE
```

**Sources:** [src/libs/MagicPages/MagicPagesLib.php:1-254](), [src/libs/MagicPages/Magicpages.phtml:1-206](), [src/libs/MagicPages/MagicpagesNoCode.phtml:1-149]()

---

## Data Model

### Database Schema

The `magicpages` table stores temporary page records:

| Column | Type | Description |
|--------|------|-------------|
| `id` | INT (auto-increment) | Primary key |
| `codigo` | VARCHAR/TEXT | UUID-based unique access code |
| `url` | VARCHAR/TEXT | Target URL to display when code is valid |
| `params` | TEXT | Optional parameters to pass to target URL |
| `expira` | DATETIME | Expiration timestamp |
| `email` | VARCHAR | Email address associated with the temporary page |

### Record Lifecycle

```mermaid
stateDiagram-v2
    [*] --> Created: Crear()
    Created --> Active: codigo generated<br/>expira = NOW + 10 min
    Active --> Expired: NOW > expira
    Active --> Renewed: Actualizar()<br/>Delete + Recreate
    Renewed --> Active: New codigo<br/>New expira
    Expired --> Renewed: User requests<br/>new link
    Active --> Deleted: EliminarPorCodigo()
    Expired --> Deleted: EliminarPorCodigo()
    Deleted --> [*]
```

**Sources:** [src/libs/MagicPages/MagicPagesLib.php:10-13](), [src/libs/MagicPages/MagicPagesLib.php:22-60](), [src/libs/MagicPages/MagicPagesLib.php:114-132]()

---

## Core Operations

### Creating Temporary Pages

The `Crear()` method generates a new temporary page entry with the following process:

```mermaid
sequenceDiagram
    participant Caller
    participant MagicPagesLib
    participant Utiles
    participant Magicpages as Magicpages Model
    participant DB as Database
    
    Caller->>MagicPagesLib: Crear({url, email, params?})
    
    MagicPagesLib->>MagicPagesLib: Set timezone to America/Bogota
    
    loop Until unique code found
        MagicPagesLib->>Utiles: create_uuid()
        Utiles-->>MagicPagesLib: UUID string
        MagicPagesLib->>DB: Check if code exists
        DB-->>MagicPagesLib: Exists/Not exists
    end
    
    MagicPagesLib->>MagicPagesLib: NuevaFecha()<br/>NOW + 10 minutes
    
    MagicPagesLib->>Magicpages: new Magicpages()
    MagicPagesLib->>Magicpages: setCodigo(uuid)
    MagicPagesLib->>Magicpages: setUrl(url)
    MagicPagesLib->>Magicpages: setExpira(expiration)
    MagicPagesLib->>Magicpages: setParams(params)
    MagicPagesLib->>Magicpages: setEmail(email)
    
    MagicPagesLib->>Magicpages: saveData()
    Magicpages->>DB: INSERT record
    DB-->>Magicpages: New ID
    Magicpages-->>MagicPagesLib: ID
    
    MagicPagesLib-->>Caller: {id: newId, codigo: uuid}
```

**Method Signature:**
```php
public static function Crear($d)
```

**Parameters:**
- `$d['url']` (required): Target URL to display
- `$d['email']` (required): Associated email address
- `$d['params']` (optional): Additional parameters

**Returns:**
- `Array['id' => string, 'codigo' => string]`

**Sources:** [src/libs/MagicPages/MagicPagesLib.php:22-60](), [src/libs/MagicPages/MagicPagesLib.php:10-13]()

---

### Renewing Expired Pages

The `Actualizar()` method renews an existing temporary page by deleting the old record and creating a new one with a fresh expiration time:

```mermaid
sequenceDiagram
    participant User
    participant MagicPagesLib
    participant DB as Database
    
    User->>MagicPagesLib: Actualizar({id: codigo, email})
    
    MagicPagesLib->>MagicPagesLib: ObtenerPorCodigo(codigo)
    MagicPagesLib->>DB: SELECT by codigo
    DB-->>MagicPagesLib: Record data
    
    MagicPagesLib->>MagicPagesLib: Verify email matches
    
    alt Email does not match
        MagicPagesLib-->>User: Exception: Email confirmation required
    end
    
    MagicPagesLib->>MagicPagesLib: EliminarPorCodigo(codigo)
    MagicPagesLib->>DB: DELETE old record
    
    MagicPagesLib->>MagicPagesLib: Crear({url, email, params})
    MagicPagesLib->>DB: INSERT new record
    DB-->>MagicPagesLib: New ID and codigo
    
    MagicPagesLib-->>User: {id: newId, codigo: newCodigo}
```

**Method Signature:**
```php
public static function Actualizar($d)
```

**Parameters:**
- `$d['id']`: Existing codigo to renew
- `$d['email']`: Email address for verification

**Email Verification:** The method ensures the provided email matches the stored email for security purposes.

**Sources:** [src/libs/MagicPages/MagicPagesLib.php:70-104]()

---

### Retrieving Temporary Pages

#### ObtenerPorCodigo Method

Retrieves temporary page information by its unique code, including expiration status:

**Method Signature:**
```php
public static function ObtenerPorCodigo($d)
```

**Parameters:**
- `$d['codigo']` (required): The UUID code

**Returns:** Array of matching records with fields:
- `id`: Database ID
- `codigo`: UUID code
- `url`: Target URL
- `params`: Parameters
- `expira`: Expiration timestamp
- `email`: Associated email
- `expirado`: Boolean (calculated as `NOW() > expira`)

**SQL Query Pattern:**
```sql
SELECT id, codigo, url, params, expira, email, 
       (NOW() > expira) as expirado
FROM magicpages
WHERE codigo = '{code}'
```

**Sources:** [src/libs/MagicPages/MagicPagesLib.php:141-149](), [src/libs/MagicPages/MagicPagesLib.php:114-132]()

---

## Expiration Management

### Time Configuration

| Setting | Value | Location |
|---------|-------|----------|
| Timezone | `America/Bogota` | Set in `Crear()` and `Obtener()` |
| Expiration Window | 10 minutes | Hardcoded in `NuevaFecha()` |
| Calculation Method | `strtotime("+10 minutes")` | [MagicPagesLib.php:11]() |

### Expiration Check

```mermaid
flowchart TD
    START["User accesses<br/>magic page URL"]
    RETRIEVE["ObtenerPorCodigo(codigo)"]
    CHECK{"Record exists?"}
    EXPIRED{"expirado == 1?"}
    SHOWPAGE["Load target URL<br/>with params"]
    SHOWEXPIRED["ObtenerVista()<br/>Show expired form"]
    SHOWERROR["ObtenerVistaError()<br/>No code provided"]
    
    START --> RETRIEVE
    RETRIEVE --> CHECK
    CHECK -->|No| SHOWERROR
    CHECK -->|Yes| EXPIRED
    EXPIRED -->|No| SHOWPAGE
    EXPIRED -->|Yes| SHOWEXPIRED
```

**Database-Side Expiration Check:**

The expiration status is calculated at query time using MySQL's `NOW()` function:

```sql
(NOW() > expira) as expirado
```

This ensures accurate expiration checking regardless of PHP timezone configuration inconsistencies.

**Sources:** [src/libs/MagicPages/MagicPagesLib.php:10-13](), [src/libs/MagicPages/MagicPagesLib.php:123]()

---

## Deletion Operations

### Available Deletion Methods

| Method | Criteria | Use Case |
|--------|----------|----------|
| `EliminarPorId($d)` | Database `id` | Internal cleanup by ID |
| `EliminarPorCodigo($d)` | UUID `codigo` | Remove specific temporary page |
| `EliminarTodo()` | All records | Bulk cleanup operation |

### Deletion Implementation

All deletion methods use `Singleton::_classicDelete()`:

**EliminarPorCodigo Example:**
```php
// Deletes WHERE codigo = "uuid-value"
$tb = "magicpages";
$xt = 'where codigo = "' . $codigo . '"';
Singleton::_classicDelete($tb, $xt);
```

**Security Note:** The deletion methods use classic SQL string concatenation (`_classicDelete`) rather than prepared statements, which is a potential SQL injection risk if user input is not properly sanitized upstream.

**Sources:** [src/libs/MagicPages/MagicPagesLib.php:158-172](), [src/libs/MagicPages/MagicPagesLib.php:181-189](), [src/libs/MagicPages/MagicPagesLib.php:200-208](), [src/libs/MagicPages/MagicPagesLib.php:218-230]()

---

## View Templates

### Expired Page Template (Magicpages.phtml)

Displayed when a user accesses an expired temporary page:

**Template Features:**
- Bootstrap 5 responsive layout
- Email input form for renewal request
- AJAX submission to `IndexCtrl::API_GenerarMagicPage`
- Modal feedback for renewal status
- Company branding (JBB logo)

**AJAX Integration:**
```javascript
// Form submission handler
var form_data = new FormData();
form_data.append('ajax', '<?php echo md5(IndexCtrl::API_GenerarMagicPage); ?>');
form_data.append('id', '<?php echo $cod ?>');
form_data.append('email', email);

jQuery.ajax({
    url: '/index.php',
    dataType: 'json',
    data: form_data,
    type: 'post'
});
```

**Sources:** [src/libs/MagicPages/Magicpages.phtml:1-206](), [src/libs/MagicPages/Magicpages.phtml:165-177]()

---

### Error Page Template (MagicpagesNoCode.phtml)

Displayed when no code is provided in the URL:

**Template Features:**
- Simple error message display
- Company logo integration via `OperacionesCtrl::obtener_LogoCompany()`
- Minimal form layout
- Bootstrap 5 styling

**Display Logic:**
```php
<?php 
$logoinst = OperacionesCtrl::obtener_LogoCompany();
?>
<!-- Error alert -->
<div class="alert alert-danger">
    El código es obligatorio.
</div>
```

**Sources:** [src/libs/MagicPages/MagicpagesNoCode.phtml:1-149](), [src/libs/MagicPages/MagicpagesNoCode.phtml:2]()

---

## Integration Points

### Controller Integration

```mermaid
graph LR
    subgraph "Application Flow"
        USER["User clicks<br/>temporary link"]
        INDEXPHP["index.php<br/>Entry Point"]
        INDEXCTRL["IndexCtrl"]
        
        subgraph "API Endpoints"
            API_GEN["API_GenerarMagicPage<br/>Renewal endpoint"]
            API_VIEW["Page rendering<br/>with magiccode param"]
        end
    end
    
    subgraph "MagicPagesLib Operations"
        OBTENER["ObtenerPorCodigo()"]
        ACTUALIZAR["Actualizar()"]
        CREAR["Crear()"]
        VISTA["ObtenerVista()"]
    end
    
    subgraph "Business Logic"
        OPCTRL["OperacionesCtrl<br/>Email notifications"]
    end
    
    USER --> INDEXPHP
    INDEXPHP --> INDEXCTRL
    
    INDEXCTRL --> API_VIEW
    API_VIEW --> OBTENER
    OBTENER -->|Expired| VISTA
    
    INDEXCTRL --> API_GEN
    API_GEN --> ACTUALIZAR
    ACTUALIZAR --> CREAR
    ACTUALIZAR --> OPCTRL
```

**Sources:** [src/libs/MagicPages/Magicpages.phtml:165-166]()

---

### Usage Pattern in Application

**Typical Flow:**

1. **Generation:** Business logic creates temporary page via `MagicPagesLib::Crear()`
2. **Email Delivery:** URL with codigo sent to user's email
3. **User Access:** User clicks link with `?magiccode={uuid}` parameter
4. **Validation:** Application calls `ObtenerPorCodigo()` to check validity
5. **Display:** If valid, show target URL content; if expired, show renewal form
6. **Renewal (Optional):** User requests new link via email verification

**Sources:** [src/libs/MagicPages/MagicPagesLib.php:22-60](), [src/libs/MagicPages/MagicPagesLib.php:141-149]()

---

## Code Generation Method

### UUID Generation

The library uses `Utiles::create_uuid()` for code generation with collision detection:

```php
$mknw = false;
$codigo = null;
do {
    $codigo = \Utiles::create_uuid();
    $rNwCo = self::ObtenerPorCodigo(array('codigo' => $codigo));
    
    if (sizeof($rNwCo) > 0) {
        $mknw = true;  // Code exists, try again
    } else {
        $mknw = false; // Unique code found
    }
} while ($mknw);
```

**Collision Prevention:**
- Loop continues until unique UUID is found
- Checks existing codes via database query
- Low probability of collision with UUID v4

**Sources:** [src/libs/MagicPages/MagicPagesLib.php:32-45]()

---

## Use Cases

### Common Scenarios

| Use Case | Implementation | Expiration Benefit |
|----------|----------------|-------------------|
| **Document Sharing** | Email with temporary link to PDF | Prevents link forwarding after expiration |
| **Email Verification** | One-time access to confirmation page | Ensures timely action |
| **Password Reset** | Temporary page for password entry | Security window for sensitive operations |
| **Report Distribution** | Time-limited access to generated reports | Controls report availability period |
| **Guest Access** | Temporary resource viewing without authentication | Automatic access revocation |

### Security Considerations

1. **Short Expiration Window:** 10-minute limit reduces exposure window
2. **UUID Codes:** Cryptographically random, difficult to guess
3. **Email Association:** Links ownership to specific email address
4. **No Authentication Required:** Trade-off for convenience vs. security
5. **One-Time Renewal:** Email verification required for renewal

**Sources:** [src/libs/MagicPages/MagicPagesLib.php:10-13](), [src/libs/MagicPages/MagicPagesLib.php:80-83]()

---

## API Reference

### MagicPagesLib Static Methods

| Method | Parameters | Returns | Description |
|--------|------------|---------|-------------|
| `Crear()` | `array['url', 'email', 'params'?]` | `array['id', 'codigo']` | Create new temporary page |
| `Actualizar()` | `array['id', 'email']` | `array['id', 'codigo']` | Renew existing page with email verification |
| `ObtenerPorCodigo()` | `array['codigo']` | `array[records]` | Retrieve page by UUID code |
| `EliminarPorId()` | `array['id']` | `bool` | Delete by database ID |
| `EliminarPorCodigo()` | `array['id']` | `bool` | Delete by UUID code |
| `EliminarTodo()` | none | `bool` | Delete all records |
| `ObtenerVista()` | `mixed` | `void` | Load expired page template |
| `ObtenerVistaError()` | `mixed` | `void` | Load error page template |

### Private/Internal Methods

| Method | Purpose |
|--------|---------|
| `NuevaFecha()` | Calculate expiration timestamp (+10 minutes) |
| `Obtener()` | Generic retrieval by field (internal use) |
| `Eliminar()` | Generic deletion by field (internal use) |

**Sources:** [src/libs/MagicPages/MagicPagesLib.php:8-254]()

---

## Configuration and Customization

### Modifying Expiration Time

To change the 10-minute expiration window, modify the `NuevaFecha()` method:

**Current Implementation:**
```php
private static function NuevaFecha() {
    $horaReg = strtotime("+10 minutes", strtotime(date('Y-m-d H:i:s')));
    return date("Y-m-d H:i:s", $horaReg);
}
```

**Example - 30 Minute Expiration:**
```php
$horaReg = strtotime("+30 minutes", strtotime(date('Y-m-d H:i:s')));
```

### Timezone Configuration

The timezone is set to `America/Bogota` in two locations:
- `Crear()` method at [line 23]()
- `Obtener()` method at [line 115]()

**Sources:** [src/libs/MagicPages/MagicPagesLib.php:10-13](), [src/libs/MagicPages/MagicPagesLib.php:23](), [src/libs/MagicPages/MagicPagesLib.php:115]()

---

## Dependencies

### Required Classes

```mermaid
graph TD
    MAGICLIB["MagicPagesLib"]
    
    CLSDATOS["Clsdatos<br/>src/datos/Clsdatos.php"]
    MAGICMODEL["Magicpages Model<br/>src/modelo/Magicpages.php"]
    UTILES["Utiles<br/>src/sistema/Utiles.php"]
    SINGLETON["Singleton<br/>Database queries"]
    INDEXCTRL["IndexCtrl<br/>API endpoint handler"]
    OPCTRL["OperacionesCtrl<br/>Email & logo"]
    
    MAGICLIB --> CLSDATOS
    MAGICLIB --> MAGICMODEL
    MAGICLIB --> UTILES
    MAGICLIB --> SINGLETON
    
    INDEXCTRL -.->|uses| MAGICLIB
    OPCTRL -.->|uses| MAGICLIB
    
    MAGICMODEL -.->|extends| CLSDATOS
    
    style MAGICLIB fill:#f9f9f9
```

**Include Statements:**
- `src/datos/Clsdatos.php` - ORM base class
- `src/modelo/Magicpages.php` - Model for magicpages table
- `src/sistema/Utiles.php` - Utility functions including UUID generation

**Sources:** [src/libs/MagicPages/MagicPagesLib.php:4-6]()

---

## Error Handling

### Exception Patterns

The library throws exceptions with prefixed messages for error tracking:

```php
// Creation error
throw new \Exception('MagicPagesLib: ' . $_o->obtenerError());

// Retrieval error
throw new \Exception('MagicPagesLib: ' . $existe['err_info']);

// Update email verification error
throw new \Exception('MagicPagesLib: Debe confirmar el e-mail...');

// Chained exception with context
throw new \Exception('MagicPagesLib.Actualizar->ObtenerPorCodigo: ' . $e->getMessage());
```

### Common Error Scenarios

| Error | Cause | Exception Message Pattern |
|-------|-------|--------------------------|
| Email mismatch | Email verification fails during renewal | `MagicPagesLib: Debe confirmar el e-mail...` |
| Missing codigo | No code parameter provided | `MagicPagesLib.ObtenerPorCodigo: El codigo es obligatorio.` |
| Database error | SQL execution failure | `MagicPagesLib: {database error}` |
| Save failure | Model save operation error | `MagicPagesLib: {model error}` |

**Sources:** [src/libs/MagicPages/MagicPagesLib.php:55-57](), [src/libs/MagicPages/MagicPagesLib.php:80-83](), [src/libs/MagicPages/MagicPagesLib.php:127-129]()

---

## Security Considerations

### Vulnerability Assessment

| Issue | Severity | Location | Mitigation |
|-------|----------|----------|------------|
| SQL Injection Risk | Medium | `_classicDelete` usage in deletion methods | Use prepared statements (`_safeDelete`) |
| Short Expiration Only | Low | Hardcoded 10-minute window | Acceptable for intended use case |
| No Rate Limiting | Medium | Renewal requests | Implement rate limiting on API endpoint |
| Email-Only Verification | Medium | `Actualizar()` method | Consider additional verification factors |

### Recommended Improvements

1. **Use Prepared Statements:**
   ```php
   // Instead of:
   Singleton::_classicDelete($tb, "where codigo = '" . $codigo . "'");
   
   // Use:
   Singleton::_safeDelete($tb, array('codigo' => $codigo));
   ```

2. **Add Rate Limiting:** Implement request throttling for renewal operations

3. **Add Logging:** Track temporary page creation and access for audit purposes

4. **Consider Configurable Expiration:** Move hardcoded 10-minute value to configuration

**Sources:** [src/libs/MagicPages/MagicPagesLib.php:166](), [src/libs/MagicPages/MagicPagesLib.php:224]()

---

---

## 8.3 Email System (PHPMailer)

## Purpose and Scope

This document describes the email notification system in GESFINANCIERO, which handles all outbound email communications including user notifications, account activation, password recovery, and custom notifications. The system provides a flexible dual-path architecture supporting both local SMTP delivery and external email service providers.

For information about account activation workflows that use this email system, see [Account Activation and Recovery](#10.3). For configuration management details, see [System Configuration (Corporation.php)](#6.1).

---

## Architecture Overview

The email system implements a dual-path architecture that routes emails through either a local SMTP server or an external email service based on configuration flags.

```mermaid
graph TB
    subgraph "Email Request Sources"
        OPCTRL["OperacionesCtrl<br/>Business Logic"]
        OPHOMECTRL["OperacionesHomeCtrl<br/>Home Operations"]
        INDEXCTRL["IndexCtrl<br/>API Endpoints"]
    end
    
    subgraph "Email Processing Layer"
        ENVIAR_CUSTOM["enviarCustomEmail()<br/>src/ctrls/OperacionesCtrl.php:324-412"]
        ENVIAR_NOTIF["enviar_Notificacion()<br/>src/ctrls/OperacionesCtrl.php:433-480"]
        OBTENER_ETIQ["ObtenerEtiquetasEmail()<br/>src/ctrls/OperacionesCtrl.php:251-289"]
    end
    
    subgraph "Configuration Sources"
        CORP_CONFIG["Corporation Constants<br/>repo/corp/Corporation.php:6-15"]
        ADMIN_CONFIG["Database Config<br/>adminconfig table"]
    end
    
    subgraph "Delivery Paths"
        LOCAL_PATH["Local SMTP Path"]
        EXTERNAL_PATH["External Service Path"]
        
        subgraph "Local SMTP"
            CORREO_CLASS["Correo Class<br/>PHPMailer Wrapper"]
            PHPMAILER["PHPMailer 6.1.6<br/>src/libs/PHPMailer-61"]
            SMTP_SERVER["SMTP Server<br/>smtp.ipage.com:25"]
        end
        
        subgraph "External Service"
            API_CALL["CallAPI()<br/>HTTP POST"]
            EXTERNAL_API["External Email Service<br/>NotificaByMail Endpoint"]
        end
    end
    
    subgraph "Template System"
        TPL_STORAGE["Email Templates<br/>src/sistema/email/*.html"]
        VAR_SUBST["Variable Substitution<br/>{$variable} Syntax"]
    end
    
    OPCTRL --> ENVIAR_CUSTOM
    OPCTRL --> ENVIAR_NOTIF
    OPHOMECTRL --> ENVIAR_CUSTOM
    INDEXCTRL --> ENVIAR_CUSTOM
    
    ENVIAR_NOTIF --> OBTENER_ETIQ
    ENVIAR_NOTIF --> TPL_STORAGE
    ENVIAR_NOTIF --> VAR_SUBST
    VAR_SUBST --> ENVIAR_CUSTOM
    
    ENVIAR_CUSTOM --> CORP_CONFIG
    ENVIAR_CUSTOM --> ADMIN_CONFIG
    
    ADMIN_CONFIG --> LOCAL_PATH
    ADMIN_CONFIG --> EXTERNAL_PATH
    
    LOCAL_PATH --> CORREO_CLASS
    CORREO_CLASS --> PHPMAILER
    PHPMAILER --> SMTP_SERVER
    
    EXTERNAL_PATH --> API_CALL
    API_CALL --> EXTERNAL_API
    
    CORP_CONFIG -.->|Fallback Config| LOCAL_PATH
```

**Sources:** [src/ctrls/OperacionesCtrl.php:251-480](), [repo/corp/Corporation.php:1-22]()

---

## PHPMailer Integration

The system uses **PHPMailer version 6.1.6**, managed through Composer. This is a widely-used, full-featured email creation and transfer class for PHP with support for SMTP, HTML emails, and attachments.

### Dependency Configuration

| File | Purpose |
|------|---------|
| `src/libs/PHPMailer-61/composer.json` | Declares PHPMailer 6.1.6 dependency |
| `src/libs/PHPMailer-61/composer.lock` | Locks dependency to exact version |
| `src/libs/PHPMailer-61/vendor/` | Contains installed PHPMailer library |

The library is autoloaded via Composer's PSR-4 autoloader under the namespace `PHPMailer\PHPMailer`.

**Sources:** [src/libs/PHPMailer-61/composer.json:1-5](), [src/libs/PHPMailer-61/composer.lock:9-70]()

---

## Email Configuration System

The email system uses a two-tier configuration architecture: hardcoded constants for defaults and database configuration for runtime overrides.

### Configuration Hierarchy

```mermaid
graph TB
    CONFIG_READ["Configuration Read Request"]
    
    subgraph "Tier 1: Hardcoded Defaults"
        CORP_CONST["Corporation Class Constants<br/>repo/corp/Corporation.php"]
        
        MAIL_SMTPAUTHE["MAIL_SMTPAUTHE = true"]
        MAIL_PORT["MAIL_PORT = 25"]
        MAIL_HOST["MAIL_HOST = smtp.ipage.com"]
        MAIL_USERNAME["MAIL_USERNAME"]
        MAIL_PASSWORD["MAIL_PASSWORD"]
        MAIL_SMTPSECURE["MAIL_SMTPSECURE = empty"]
        MAIL_REMITENTE["MAIL_REMITENTE"]
        MAIL_LABEL["MAIL_LABEL_REMITENTE"]
    end
    
    subgraph "Tier 2: Database Overrides"
        ADMINCONFIG["adminconfig Table"]
        
        CFG_SMTP_AUTHSMTP["cfgsmtpauthsmpt"]
        CFG_SMTP_PORT["cfgsmtpportnum"]
        CFG_SMTP_HOST["cfgsmtphost"]
        CFG_SMTP_USER["cfgsmtpuser"]
        CFG_SMTP_PASS["cfgsmtppass"]
        CFG_SMTP_SECURE["cfgsmtpsecure"]
        CFG_SMTP_TFSERVICE["cfgsmtptfservice"]
        CFG_SMTP_TFSERVICEURL["cfgsmtptfserviceurl"]
        CFG_SMTP_TFSAPITOKEN["cfgsmtptfsapitoken"]
        CFG_SMTP_TFSCLIID["cfgsmtptfscliid"]
    end
    
    subgraph "Configuration Loader"
        LEER_CONFIG["LeerConfigCorp()<br/>src/ctrls/OperacionesCtrl.php:1312-1324"]
    end
    
    CONFIG_READ --> LEER_CONFIG
    LEER_CONFIG --> ADMINCONFIG
    ADMINCONFIG -.->|If not set| CORP_CONST
    
    CORP_CONST --> MAIL_SMTPAUTHE
    CORP_CONST --> MAIL_PORT
    CORP_CONST --> MAIL_HOST
    CORP_CONST --> MAIL_USERNAME
    CORP_CONST --> MAIL_PASSWORD
    CORP_CONST --> MAIL_SMTPSECURE
    CORP_CONST --> MAIL_REMITENTE
    CORP_CONST --> MAIL_LABEL
    
    ADMINCONFIG --> CFG_SMTP_AUTHSMTP
    ADMINCONFIG --> CFG_SMTP_PORT
    ADMINCONFIG --> CFG_SMTP_HOST
    ADMINCONFIG --> CFG_SMTP_USER
    ADMINCONFIG --> CFG_SMTP_PASS
    ADMINCONFIG --> CFG_SMTP_SECURE
    ADMINCONFIG --> CFG_SMTP_TFSERVICE
    ADMINCONFIG --> CFG_SMTP_TFSERVICEURL
    ADMINCONFIG --> CFG_SMTP_TFSAPITOKEN
    ADMINCONFIG --> CFG_SMTP_TFSCLIID
```

### Configuration Constants Reference

| Constant | Purpose | Default Value | Line Reference |
|----------|---------|---------------|----------------|
| `MAIL_SMTPAUTHE` | Enable SMTP authentication | `true` | [repo/corp/Corporation.php:6]() |
| `MAIL_PORT` | SMTP server port | `25` | [repo/corp/Corporation.php:7]() |
| `MAIL_HOST` | SMTP server address | `smtp.ipage.com` | [repo/corp/Corporation.php:8]() |
| `MAIL_USERNAME` | SMTP authentication username | `admin@nuevapp.com` | [repo/corp/Corporation.php:9]() |
| `MAIL_PASSWORD` | SMTP authentication password | (hardcoded) | [repo/corp/Corporation.php:10]() |
| `MAIL_SMTPSECURE` | Encryption type (ssl/tls) | `""` (none) | [repo/corp/Corporation.php:11]() |
| `MAIL_REMITENTE` | Default sender email | `admin@nuevapp.com` | [repo/corp/Corporation.php:13]() |
| `MAIL_LABEL_REMITENTE` | Default sender display name | `Nuevapp Notify` | [repo/corp/Corporation.php:14]() |

### Database Configuration Constants

| Database Key | Constant | Purpose | Line Reference |
|--------------|----------|---------|----------------|
| `cfgsmtpauthsmpt` | `CFG_SMTP_AUTHSMTP` | SMTP authentication flag | [src/ctrls/OperacionesCtrl.php:1149]() |
| `cfgsmtpportnum` | `CFG_SMTP_PORT` | Port number override | [src/ctrls/OperacionesCtrl.php:1158]() |
| `cfgsmtphost` | `CFG_SMTP_HOST` | Host server override | [src/ctrls/OperacionesCtrl.php:1166]() |
| `cfgsmtpuser` | `CFG_SMTP_USER` | Username override | [src/ctrls/OperacionesCtrl.php:1175]() |
| `cfgsmtppass` | `CFG_SMTP_PASS` | Password override | [src/ctrls/OperacionesCtrl.php:1186]() |
| `cfgsmtpsecure` | `CFG_SMTP_SECURE` | Security protocol (ssl/tls) | [src/ctrls/OperacionesCtrl.php:1195]() |
| `cfgsmtptfservice` | `CFG_SMTP_TFSERVICE` | Enable external service | [src/ctrls/OperacionesCtrl.php:1206]() |
| `cfgsmtptfserviceurl` | `CFG_SMTP_TFSERVICEURL` | External service URL | [src/ctrls/OperacionesCtrl.php:1215]() |
| `cfgsmtptfsapitoken` | `CFG_SMTP_TFSAPITOKEN` | External service API token (base64) | [src/ctrls/OperacionesCtrl.php:1225]() |
| `cfgsmtptfscliid` | `CFG_SMTP_TFSCLIID` | Client ID for external service | [src/ctrls/OperacionesCtrl.php:1235]() |

**Sources:** [repo/corp/Corporation.php:6-15](), [src/ctrls/OperacionesCtrl.php:1149-1235]()

---

## Core Email Sending Methods

### enviarCustomEmail()

The primary method for sending emails, implementing dual-path routing logic.

```mermaid
graph TB
    START["enviarCustomEmail(d)<br/>Line 324"]
    
    READ_CONFIG["Read Configuration<br/>LeerConfigCorp()"]
    CHECK_SERVICE{"CFG_SMTP_TFSERVICE<br/>enabled?"}
    
    subgraph "Local SMTP Path"
        CREATE_CORREO["Instantiate Correo Class"]
        SET_HTML["setEsHTML(true)"]
        SET_PARAMS["Set Email Parameters<br/>setPara, setTitulo,<br/>setMensaje, etc."]
        SET_ATTACHMENT{"Attachment<br/>provided?"}
        ADD_ATTACHMENT["setAdjunto(path)"]
        SEND_LOCAL["correo->enviar()"]
    end
    
    subgraph "External Service Path"
        BUILD_URL["Build API URL<br/>md5('Api/Servidor/NotificaByMail')"]
        PARSE_DOMAIN["Extract Domain<br/>for Client ID"]
        BUILD_JSON["Build JSON Payload<br/>destino, titulo64,<br/>mensaje, adjuntofull"]
        ENCODE_DATA["Base64 Encode<br/>JSON Payload"]
        CALL_API["CallAPI(POST, url, data)"]
        DECODE_RESPONSE["json_decode(response)"]
    end
    
    CHECK_ERROR{"Response<br/>has 'err'?"}
    THROW_ERROR["Throw Exception<br/>ERR_COD_USUARIO_O_CLAVE_INVALIDA"]
    RETURN_SUCCESS["Return Response"]
    
    START --> READ_CONFIG
    READ_CONFIG --> CHECK_SERVICE
    
    CHECK_SERVICE -->|false| CREATE_CORREO
    CREATE_CORREO --> SET_HTML
    SET_HTML --> SET_PARAMS
    SET_PARAMS --> SET_ATTACHMENT
    SET_ATTACHMENT -->|yes| ADD_ATTACHMENT
    SET_ATTACHMENT -->|no| SEND_LOCAL
    ADD_ATTACHMENT --> SEND_LOCAL
    SEND_LOCAL --> CHECK_ERROR
    
    CHECK_SERVICE -->|true| BUILD_URL
    BUILD_URL --> PARSE_DOMAIN
    PARSE_DOMAIN --> BUILD_JSON
    BUILD_JSON --> ENCODE_DATA
    ENCODE_DATA --> CALL_API
    CALL_API --> DECODE_RESPONSE
    DECODE_RESPONSE --> CHECK_ERROR
    
    CHECK_ERROR -->|yes| THROW_ERROR
    CHECK_ERROR -->|no| RETURN_SUCCESS
```

**Method Signature:**
```php
public static function enviarCustomEmail( $d )
```

**Parameters:**

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `para` | string | Yes | Recipient email address |
| `titulo` | string | Yes | Email subject line |
| `mensaje` | string | Yes | HTML email body |
| `desde` | string | Yes | Sender email address |
| `rotulo` | string | Yes | Sender display name |
| `adjunto` | string | No | File path for attachment (local SMTP only) |
| `adjuntofull` | string | No | Full file path for attachment (external service) |

**Exceptions:**

| HTTP Code | Error Code | Condition |
|-----------|------------|-----------|
| `ERR_COD_ENVIO_MAIL_FALLIDO` | `ERR_COD_ENVIO_MAIL_FALLIDO` | Local SMTP send fails |
| `ERR_COD_USUARIO_O_CLAVE_INVALIDA` | `ERR_COD_USUARIO_O_CLAVE_INVALIDA` | External service returns error |

**Sources:** [src/ctrls/OperacionesCtrl.php:324-412]()

---

### enviar_Notificacion()

Template-based email notification system for standardized communications.

```mermaid
graph TB
    START["enviar_Notificacion(d)<br/>Line 433"]
    
    EXTRACT_PARAMS["Extract Parameters<br/>tpl, campos, para"]
    SET_DEFAULTS["Set Default Values<br/>titulo, desde, rotulo"]
    BUILD_TPL_PATH["Build Template Path<br/>GET_BASE_MAIL() + tpl"]
    READ_TPL["file_get_contents(template)"]
    GET_ETIQUETAS["ObtenerEtiquetasEmail(campos)"]
    
    REGEX_REPLACE["preg_replace_callback<br/>Pattern: ~\{\$(.*?)\}~si"]
    
    subgraph "Variable Substitution"
        FIND_VAR["Find {$variable}"]
        CHECK_EXISTS{"Variable exists<br/>in array?"}
        REPLACE_VALUE["Replace with value"]
        KEEP_ORIGINAL["Keep original {$var}"]
    end
    
    BUILD_OPTIONS["Build Email Options<br/>para, titulo,<br/>mensaje, desde, rotulo"]
    CALL_CUSTOM["enviarCustomEmail(options)"]
    CATCH_ERROR{"Exception<br/>thrown?"}
    THROW_ERR["Throw Exception<br/>ERR_COD_CORREO_FAIL"]
    RETURN_RESULT["Return Send Result"]
    
    START --> EXTRACT_PARAMS
    EXTRACT_PARAMS --> SET_DEFAULTS
    SET_DEFAULTS --> BUILD_TPL_PATH
    BUILD_TPL_PATH --> READ_TPL
    READ_TPL --> GET_ETIQUETAS
    GET_ETIQUETAS --> REGEX_REPLACE
    
    REGEX_REPLACE --> FIND_VAR
    FIND_VAR --> CHECK_EXISTS
    CHECK_EXISTS -->|yes| REPLACE_VALUE
    CHECK_EXISTS -->|no| KEEP_ORIGINAL
    REPLACE_VALUE --> BUILD_OPTIONS
    KEEP_ORIGINAL --> BUILD_OPTIONS
    
    BUILD_OPTIONS --> CALL_CUSTOM
    CALL_CUSTOM --> CATCH_ERROR
    CATCH_ERROR -->|yes| THROW_ERR
    CATCH_ERROR -->|no| RETURN_RESULT
```

**Method Signature:**
```php
private static function enviar_Notificacion ( $d )
```

**Parameters:**

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `tpl` | string | Yes | Template filename (e.g., "bienvenida.html") |
| `campos` | array | Yes | Variables for template substitution |
| `para` | string | Yes | Recipient email address |
| `titulo` | string | No | Email subject (default: "Nuevapp - #YmdHis") |
| `desde` | string | No | Sender address (default: "notificador@nuevapp.com") |
| `rotulo` | string | No | Sender label (default: "Notification") |

**Sources:** [src/ctrls/OperacionesCtrl.php:433-480]()

---

## Email Template System

### Template Location

Templates are HTML files stored in the directory returned by `GET_BASE_MAIL()`, which resolves to:
```
src/sistema/email/
```

**Sources:** [src/ctrls/OperacionesCtrl.php:298-300]()

### Variable Substitution Syntax

Templates use a `{$variable}` syntax for dynamic content replacement. The system supports two categories of variables:

#### System Variables

Automatically available in all templates via `ObtenerEtiquetasEmail()`:

| Variable | Description | Example Value |
|----------|-------------|---------------|
| `{$corto}` | URL Config | Value from `Config::URLBASE` |
| `{$b}` | Base URL | `https://example.com/` |
| `{$u}` | Home URL | `https://example.com/home.php` |
| `{$i}` | Admin URL | `https://example.com/index.php` |
| `{$f}` | Unique ID | `20231201153045` (YmdHis) |
| `{$logo64}` | Corporate logo (base64) | Base64-encoded PNG |
| `{$now_day}` | Current day | `15` |
| `{$now_month}` | Current month | `12` |
| `{$now_year}` | Current year | `2023` |
| `{$now_hour}` | Current hour | `15` |
| `{$now_mins}` | Current minute | `30` |
| `{$now_secs}` | Current second | `45` |
| `{$now_date}` | Current date | `2023-12-15` |
| `{$now_time}` | Current time | `15:30:45` |
| `{$now_datetime}` | Current datetime | `2023-12-15 15:30:45` |

#### Custom Variables

Any variables passed in the `$d` parameter to `ObtenerEtiquetasEmail()` are merged and available for substitution.

### Template Processing Flow

```mermaid
graph LR
    TPL_FILE["Template File<br/>nuevaclave.html"]
    TPL_CONTENT["Template Content<br/>{$CLAVE_TMP}"]
    
    SYSTEM_VARS["System Variables<br/>corto, b, u, i, f,<br/>logo64, now_*"]
    CUSTOM_VARS["Custom Variables<br/>CLAVE_TMP, etc."]
    
    MERGE["Merge Variables<br/>ObtenerEtiquetasEmail()"]
    REPLACEMENT_ARRAY["Replacement Array"]
    
    REGEX["preg_replace_callback<br/>~\{\$(.*?)\}~si"]
    
    FINAL_HTML["Final HTML<br/>123456"]
    
    TPL_FILE --> TPL_CONTENT
    SYSTEM_VARS --> MERGE
    CUSTOM_VARS --> MERGE
    MERGE --> REPLACEMENT_ARRAY
    
    TPL_CONTENT --> REGEX
    REPLACEMENT_ARRAY --> REGEX
    REGEX --> FINAL_HTML
```

**Sources:** [src/ctrls/OperacionesCtrl.php:251-289](), [src/ctrls/OperacionesCtrl.php:216-231]()

---

## Common Email Use Cases

### Account Activation

```mermaid
sequenceDiagram
    participant Client
    participant OpCtrl as OperacionesCtrl
    participant DB as Database
    participant Codigoactiva
    participant Email as Email System
    participant User
    
    Client->>OpCtrl: RecuperarByEmailAjax({emailactivar})
    OpCtrl->>DB: Check user exists
    DB-->>OpCtrl: User record
    
    OpCtrl->>DB: Delete old codes
    OpCtrl->>Codigoactiva: Generate 6-digit code
    
    loop Retry up to 20 times
        Codigoactiva->>DB: saveData()
        alt Code collision
            DB-->>Codigoactiva: Duplicate error
            Codigoactiva->>Codigoactiva: Generate new code
        else Success
            DB-->>Codigoactiva: Saved
        end
    end
    
    OpCtrl->>OpCtrl: Load nuevaclave.html template
    OpCtrl->>OpCtrl: ObtenerEtiquetasEmail({CLAVE_TMP})
    OpCtrl->>OpCtrl: Variable substitution
    OpCtrl->>Email: enviarCustomEmail()
    Email->>User: Email with code
    Email-->>OpCtrl: Send result
    OpCtrl-->>Client: {ok: md5(user_id)}
```

**Key Methods:**
- `RecuperarByEmailAjax()` - [src/ctrls/OperacionesCtrl.php:952-1035]()
- `codigoactiva_Add()` - [src/ctrls/OperacionesCtrl.php:1452-1525]()

**Template Used:** `nuevaclave.html`

**Variables Available:**
- `{$CLAVE_TMP}` - 6-digit activation code
- All system variables (URLs, dates, logo)

**Sources:** [src/ctrls/OperacionesCtrl.php:952-1035]()

---

### Password Recovery and Assignment

```mermaid
sequenceDiagram
    participant Client
    participant OpCtrl as OperacionesCtrl
    participant DB as Database
    participant Usuarios
    
    Client->>OpCtrl: RecuAsignarClaveAjax({codActiva, key, c})
    OpCtrl->>DB: Find code by nombre and user hash
    
    alt Code not found
        DB-->>Client: Exception: Código inexistente
    else Code already used
        DB-->>Client: Exception: Código ya utilizado
    else Code expired (>10 min)
        DB-->>Client: Exception: Código inactivo
    else Valid code
        OpCtrl->>DB: Mark code as used (activo=1)
        OpCtrl->>Usuarios: readInfo(userselecto_id)
        OpCtrl->>Usuarios: setClave(md5(new_password))
        Usuarios->>DB: updateData()
        DB-->>Client: {ok: true}
    end
```

**Key Method:**
- `RecuAsignarClaveAjax()` - [src/ctrls/OperacionesCtrl.php:1062-1126]()

**Validation Rules:**
- Code must exist in `codigoactiva` table
- Code must match user hash (md5 of user ID)
- Code `activo` field must be 0 (not used)
- Code must be less than 10 minutes old

**Sources:** [src/ctrls/OperacionesCtrl.php:1062-1126]()

---

## Dual-Path Routing Logic

### Decision Flow

```mermaid
graph TB
    START["Email Send Request"]
    
    READ_CFG["Read adminconfig Table<br/>LeerConfigCorp()"]
    
    EXTRACT_TFSERVICE["Extract CFG_SMTP_TFSERVICE<br/>filter_var(FILTER_VALIDATE_BOOLEAN)"]
    
    CHECK_TFSERVICE{"CFG_SMTP_TFSERVICE<br/>== true?"}
    
    subgraph "Local SMTP Path"
        USE_CORREO["Use Correo Class"]
        SMTP_SETTINGS["Apply Corporation Constants<br/>or adminconfig overrides"]
        PHPMAILER_SEND["PHPMailer sends via SMTP"]
    end
    
    subgraph "External Service Path"
        EXTRACT_URL["Extract CFG_SMTP_TFSERVICEURL"]
        EXTRACT_TOKEN["Extract & Decode<br/>CFG_SMTP_TFSAPITOKEN"]
        EXTRACT_CLIID["Extract CFG_SMTP_TFSCLIID"]
        BUILD_PAYLOAD["Build JSON Payload"]
        ENCODE_PAYLOAD["Base64 Encode Payload"]
        HTTP_POST["HTTP POST to External API"]
    end
    
    RETURN["Return Result"]
    
    START --> READ_CFG
    READ_CFG --> EXTRACT_TFSERVICE
    EXTRACT_TFSERVICE --> CHECK_TFSERVICE
    
    CHECK_TFSERVICE -->|false| USE_CORREO
    USE_CORREO --> SMTP_SETTINGS
    SMTP_SETTINGS --> PHPMAILER_SEND
    PHPMAILER_SEND --> RETURN
    
    CHECK_TFSERVICE -->|true| EXTRACT_URL
    EXTRACT_URL --> EXTRACT_TOKEN
    EXTRACT_TOKEN --> EXTRACT_CLIID
    EXTRACT_CLIID --> BUILD_PAYLOAD
    BUILD_PAYLOAD --> ENCODE_PAYLOAD
    ENCODE_PAYLOAD --> HTTP_POST
    HTTP_POST --> RETURN
```

### External Service Payload Structure

When `CFG_SMTP_TFSERVICE` is enabled, emails are sent via HTTP POST to the external service:

**Endpoint Construction:**
```
{CFG_SMTP_TFSERVICEURL}/md5('Api/Servidor/NotificaByMail')
```

**POST Data:**
```php
[
    "u" => base64_decode(CFG_SMTP_TFSAPITOKEN),
    "data" => base64_encode(json_payload)
]
```

**JSON Payload Structure:**
```json
{
    "destino": "user@example.com",
    "titulo64": "<base64_encoded_subject>",
    "mensaje": "<base64_encoded_html_body>",
    "adjuntofull": "/path/to/attachment",
    "idserver": "<subdomain_from_host>",
    "cliente": "<CFG_SMTP_TFSCLIID>"
}
```

**Sources:** [src/ctrls/OperacionesCtrl.php:365-403]()

---

## Configuration Management Methods

### LeerConfigCorp()

Reads all configuration entries from the `adminconfig` table and indexes them by name.

```mermaid
graph LR
    START["LeerConfigCorp()"]
    QUERY["Singleton::_readInfo<br/>adminconfig, *, empty"]
    RESULTS["Array of Config Rows"]
    REINDEX["Reindex by 'nombre' field"]
    RETURN["Return Associative Array"]
    
    START --> QUERY
    QUERY --> RESULTS
    RESULTS --> REINDEX
    REINDEX --> RETURN
```

**Return Structure:**
```php
[
    "cfgsmtphost" => [
        "id" => 123,
        "nombre" => "cfgsmtphost",
        "val" => "smtp.example.com",
        "usuario_full" => "Admin User",
        "fecha" => "2023-12-15 10:30:00"
    ],
    // ... other configs
]
```

**Sources:** [src/ctrls/OperacionesCtrl.php:1312-1324]()

---

### EscribirConfig()

Wrapper method for updating or creating configuration entries.

**Method Signature:**
```php
public static function EscribirConfig( $d )
```

**Parameters:**

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | string | Yes | Configuration key (e.g., "cfgsmtphost") |
| `vl` | mixed | Yes | New value for the configuration |
| `ufull` | string | Yes | Full name of user making the change |

**Returns:**
```php
[
    "ok" => [
        "ok" => true,
        "cfg" => "cfgsmtphost"
    ]
]
```

**Sources:** [src/ctrls/OperacionesCtrl.php:1283-1295]()

---

### ModificaConfigCorp()

Internal method that handles the actual database operations for configuration management.

```mermaid
graph TB
    START["ModificaConfigCorp(llave, valor, ufull)"]
    
    GET_CURRENT["LeerConfigCorp()"]
    CHECK_EXISTS{"Configuration<br/>exists?"}
    
    subgraph "Update Path"
        BUILD_UPDATE["Build UPDATE Query"]
        SAFE_UPDATE["Singleton::_safeUpdate<br/>adminconfig table"]
        CHECK_UPDATE{"Rows<br/>affected >= 0?"}
        RETURN_OK_UPD["Return {ok: true, cfg: llave}"]
    end
    
    subgraph "Insert Path"
        BUILD_VALUES["Build INSERT VALUES<br/>(null, llave, valor, ufull, fecha)"]
        CLASSIC_INSERT["Singleton::_classicInsertUniqQuery<br/>adminconfig table"]
        CHECK_INSERT{"ID > 0?"}
        RETURN_OK_INS["Return {ok: true, cfg: llave}"]
    end
    
    RETURN_FAIL["Return {ok: false, cfg: llave}"]
    
    START --> GET_CURRENT
    GET_CURRENT --> CHECK_EXISTS
    
    CHECK_EXISTS -->|yes| BUILD_UPDATE
    BUILD_UPDATE --> SAFE_UPDATE
    SAFE_UPDATE --> CHECK_UPDATE
    CHECK_UPDATE -->|yes| RETURN_OK_UPD
    CHECK_UPDATE -->|no| RETURN_FAIL
    
    CHECK_EXISTS -->|no| BUILD_VALUES
    BUILD_VALUES --> CLASSIC_INSERT
    CLASSIC_INSERT --> CHECK_INSERT
    CHECK_INSERT -->|yes| RETURN_OK_INS
    CHECK_INSERT -->|no| RETURN_FAIL
```

**Sources:** [src/ctrls/OperacionesCtrl.php:1346-1382]()

---

## Security Considerations

### Hardcoded Credentials

The `Corporation` class contains hardcoded SMTP credentials, which presents a security risk:

```php
const MAIL_USERNAME = "admin@nuevapp.com";
const MAIL_PASSWORD = "73cn0l0g1@Info.";
```

**Recommendations:**
1. Move credentials to environment variables
2. Use the `adminconfig` database table exclusively
3. Remove hardcoded values from source control
4. Implement credential rotation procedures

**Sources:** [repo/corp/Corporation.php:9-10]()

### Base64 Token Storage

The external service API token is stored in base64 format in the database:

```php
$_CFG_SMTP_TFSAPITOKEN = base64_decode( $cfg[ self::CFG_SMTP_TFSAPITOKEN ]["val"] )
```

Base64 is **not encryption** - it's merely encoding. Consider using proper encryption for sensitive tokens.

**Sources:** [src/ctrls/OperacionesCtrl.php:329]()

### SQL Injection Risks

The local SMTP path uses the `Correo` class which wraps PHPMailer, providing some protection. However, the external service path constructs JSON payloads that should be sanitized.

---

## Error Handling

### Exception Codes

| Error Code Constant | HTTP Code | Scenario |
|---------------------|-----------|----------|
| `ERR_COD_ENVIO_MAIL_FALLIDO` | `ERR_COD_ENVIO_MAIL_FALLIDO` | Local SMTP send failure |
| `ERR_COD_USUARIO_O_CLAVE_INVALIDA` | `ERR_COD_USUARIO_O_CLAVE_INVALIDA` | External service auth failure |
| `ERR_COD_CORREO_FAIL` | `ERR_COD_CORREO_FAIL` | Template notification failure |

### Exception Messages

All email-related exceptions include descriptive prefixes to aid debugging:

```php
throw new Exception('[ERR_CODE]methodName: Detailed error message');
```

Examples:
- `"[401]enviarCustomEmail: Service returned invalid credentials"`
- `"enviar_Notificacion - enviarCustomEmail: SMTP connection failed"`
- `"RecuperarByEmailAjax: Error eliminando viejos tkns [...]"`

**Sources:** [src/ctrls/OperacionesCtrl.php:360-408](), [src/ctrls/OperacionesCtrl.php:474-477]()

---

## Integration Points

### Methods That Send Email

The following business logic methods utilize the email system:

| Method | Purpose | Template | Line Reference |
|--------|---------|----------|----------------|
| `RecuperarByEmailAjax()` | Password recovery | `nuevaclave.html` | [src/ctrls/OperacionesCtrl.php:952-1035]() |
| `codigoactiva_Add()` | Account activation code | `codigoactiva.html` | [src/ctrls/OperacionesCtrl.php:1452-1525]() |
| Account activation flows | User activation | Various | Multiple locations |

### Database Tables

| Table | Purpose |
|-------|---------|
| `adminconfig` | Stores runtime SMTP configuration overrides |
| `codigoactiva` | Stores temporary activation codes for email verification |
| `usuarios` | Contains user email addresses for notifications |

**Sources:** [src/ctrls/OperacionesCtrl.php:324-480](), [src/ctrls/OperacionesCtrl.php:952-1126]()

---

## Summary

The GESFINANCIERO email system provides a flexible, dual-path architecture for sending notifications:

- **PHPMailer 6.1.6** provides the underlying SMTP capabilities
- **Dual routing** supports both local SMTP and external email services
- **Template-based** system with variable substitution simplifies email creation
- **Two-tier configuration** balances defaults with runtime overrides
- **Primary methods** are `enviarCustomEmail()` and `enviar_Notificacion()`

For implementation details on specific email workflows like account activation, refer to [Account Activation and Recovery](#10.3). For modifying email configuration, see [System Configuration (Corporation.php)](#6.1).

---

---

## 9. API Reference

This document provides comprehensive technical documentation for the GESFINANCIERO API system, covering both REST and AJAX endpoints, authentication mechanisms, request/response formats, and endpoint conventions. For authentication implementation details, see [Authentication System](#10.1). For token management specifics, see [Token Management](#10.2).

## Overview

GESFINANCIERO implements a **dual API paradigm** with two distinct interfaces operating simultaneously:

1. **REST API** - Token-based authentication using Bearer tokens, accessed via `PATH_INFO` routing
2. **AJAX API** - Session-based authentication using MD5 endpoint hashing, accessed via POST parameters

This architectural pattern reflects evolutionary development where newer REST endpoints coexist with legacy AJAX endpoints. Both APIs delegate business logic to the same underlying operations in `OperacionesCtrl`, ensuring consistency while supporting different authentication and access patterns.

**Sources:** [src/ctrls/IndexCtrl.php:1-50](), [src/ctrls/Rest.php:1-276](), [src/ctrls/OperacionesCtrl.php:1-100]()

---

## API Architecture Overview

```mermaid
graph TB
    subgraph "Client Layer"
        CLIENT["HTTP Client"]
    end
    
    subgraph "Entry Point - index.php"
        INDEX["index.php<br/>Bootstrap"]
        INDEXCTRL["IndexCtrl<br/>Controller"]
    end
    
    subgraph "REST API Path"
        PATHINFO["PATH_INFO<br/>Detection"]
        RESTHANDLER["Rest::handler()<br/>Line 114-275"]
        BEARERAUTH["Bearer Token<br/>Validation"]
        RESTDISPATCH["Method Dispatch<br/>tkn_* methods"]
    end
    
    subgraph "AJAX API Path"
        POSTAJAX["POST ajax<br/>Parameter"]
        MD5MATCH["MD5 Hash<br/>Matching"]
        AJAXDISPATCH["Direct Method<br/>Invocation"]
    end
    
    subgraph "Business Logic Layer"
        OPCTRL["OperacionesCtrl<br/>Business Operations"]
    end
    
    subgraph "Response"
        JSONRESP["JSON Response"]
        DIETERM["die() Termination"]
    end
    
    CLIENT --> INDEX
    INDEX --> INDEXCTRL
    
    INDEXCTRL --> PATHINFO
    INDEXCTRL --> POSTAJAX
    
    PATHINFO --> RESTHANDLER
    RESTHANDLER --> BEARERAUTH
    BEARERAUTH --> RESTDISPATCH
    
    POSTAJAX --> MD5MATCH
    MD5MATCH --> AJAXDISPATCH
    
    RESTDISPATCH --> OPCTRL
    AJAXDISPATCH --> OPCTRL
    
    OPCTRL --> JSONRESP
    JSONRESP --> DIETERM
```

**Diagram: Dual API Request Processing Flow**

The system routes requests through two distinct paths based on request characteristics. REST API requests are identified by the presence of `$_SERVER['PATH_INFO']` and routed to `Rest::handler()`, while AJAX requests are identified by the `$_POST['ajax']` parameter containing an MD5 hash that matches endpoint constants.

**Sources:** [src/ctrls/IndexCtrl.php:1308-1334](), [src/ctrls/Rest.php:114-275]()

---

## Authentication Mechanisms

### REST API Authentication

The REST API uses **Bearer token authentication** with RSA key pairs:

```mermaid
sequenceDiagram
    participant Client
    participant RestHandler as Rest::handler()
    participant getBearerToken as Rest::getBearerToken()
    participant CompararToken as OperacionesCtrl::CompararToken()
    participant ApiboxLib
    
    Client->>RestHandler: POST /md5hash<br/>Authorization: Bearer {token}
    RestHandler->>getBearerToken: Extract token from header
    getBearerToken-->>RestHandler: token string
    RestHandler->>CompararToken: Validate token
    CompararToken->>ApiboxLib: ApiboxLib::Comparar()
    ApiboxLib-->>CompararToken: token data + metadata
    
    alt Token Valid & Active & Not Expired
        CompararToken-->>RestHandler: Token validated
        RestHandler->>RestHandler: Dispatch to tkn_* method
        RestHandler->>Client: JSON response
    else Token Invalid/Expired/Disabled
        CompararToken-->>RestHandler: Validation failure
        RestHandler->>Client: 401 Unauthorized<br/>{"err":"Invalid/Expired/Disabled token"}
    end
```

**Diagram: REST API Bearer Token Authentication Flow**

The REST API validates Bearer tokens by comparing them against stored RSA public keys in the `apibox` table. Token validation includes checking:
- Token existence and validity
- Active status (`activo == 1`)
- Expiration time (configurable via `CFG_LGIN_APT`, default 60 minutes)

**Sources:** [src/ctrls/Rest.php:123-163](), [src/ctrls/OperacionesCtrl.php:804-818]()

### AJAX API Authentication

The AJAX API uses **session-based authentication** with MD5 endpoint hashing:

| Authentication Component | Implementation | Location |
|-------------------------|----------------|----------|
| Session Check | `$_SESSION["usu"]` validation | [src/ctrls/IndexCtrl.php:1313-1320]() |
| User State Validation | `getEstado_id() > 1` check | [src/ctrls/IndexCtrl.php:1315-1319]() |
| Endpoint Discovery | `md5(API_CONSTANT)` matching | [src/ctrls/IndexCtrl.php:1411-1420]() |
| URL Binding | `$_SESSION["url"]` validation | [src/ctrls/IndexCtrl.php:1339-1345]() |

AJAX endpoints are accessed by hashing API constant names with MD5 and sending them in the `ajax` POST parameter.

**Sources:** [src/ctrls/IndexCtrl.php:1308-1450]()

---

## REST API Endpoint Structure

### Endpoint Naming Convention

REST endpoints follow a strict naming pattern:

```mermaid
graph LR
    subgraph "Method Prefix System"
        TKN["tkn_<br/>Requires Bearer Token"]
        NOTKN["notkn_<br/>Public Endpoint"]
    end
    
    subgraph "Method Resolution"
        METHODNAME["Method Name<br/>e.g., EmpleadosAdd"]
        FULLMETHOD["Full Method<br/>tkn_EmpleadosAdd()"]
    end
    
    subgraph "URL Pattern"
        AJAX["ajax parameter<br/>endpoint identifier"]
        HASH["MD5 Hash or<br/>Method Name"]
    end
    
    TKN --> FULLMETHOD
    NOTKN --> FULLMETHOD
    METHODNAME --> FULLMETHOD
    AJAX --> HASH
    HASH --> FULLMETHOD
```

**Diagram: REST Endpoint Naming Convention**

REST endpoints in `Rest.php` use prefixes to indicate authentication requirements:
- **`tkn_*`** methods require valid Bearer token authentication
- **`notkn_*`** methods are publicly accessible without authentication

**Sources:** [src/ctrls/Rest.php:207-259]()

### Token Generation Endpoint

The token generation endpoint uses Basic Authentication instead of Bearer tokens:

```mermaid
sequenceDiagram
    participant Client
    participant Rest as Rest::handler()
    participant getAuthBasic
    participant GenerarToken as OperacionesCtrl::GenerarToken()
    participant GenerarLlavePublica
    participant ApiboxLib
    
    Client->>Rest: POST /GenerarToken<br/>Authorization: Basic base64(user:pass)
    Rest->>getAuthBasic: Extract credentials
    getAuthBasic-->>Rest: {u: username, c: password}
    Rest->>GenerarToken: Generate token for user
    GenerarToken->>GenerarToken: AutenticaUsuarioSisAjax()
    GenerarToken->>GenerarLlavePublica: Generate RSA key pair
    GenerarLlavePublica-->>GenerarToken: {pub, pri, fecha}
    GenerarToken->>ApiboxLib: Store token (Crear/Actualizar)
    ApiboxLib-->>GenerarToken: Token stored
    GenerarToken-->>Rest: Public key
    Rest->>Client: 200 OK<br/>Public key (PEM format)
```

**Diagram: Token Generation Flow with Basic Authentication**

**Sources:** [src/ctrls/Rest.php:240-244](), [src/ctrls/OperacionesCtrl.php:674-787](), [src/ctrls/OperacionesCtrl.php:621-643]()

---

## AJAX API Endpoint Structure

### Endpoint Constants and Mapping

The AJAX API defines over 100 endpoint constants in `IndexCtrl`:

```mermaid
graph TB
    subgraph "Endpoint Categories"
        AUTH["Authentication<br/>API_LoginSystemAjax<br/>API_IniciarLoginAsOtro"]
        USERS["User Management<br/>API_UsuariosAdd<br/>API_UsuariosMod<br/>API_UsuariosRm"]
        EMPL["Employee Management<br/>API_EmpleadosAdd<br/>API_EmpleadosMod<br/>API_EmpleadosRm"]
        DOCS["Document Management<br/>API_plantillasAdd<br/>API_FirmasGet"]
        FLOW["Workflow Management<br/>API_FlujosHelperAdd<br/>API_FlujositemsGet"]
        PKG["Package Management<br/>API_PaquetesGetAjax<br/>API_PaquetesHelperAdd"]
    end
    
    subgraph "Handler Logic"
        CONST["API Constant String"]
        MD5["md5(Constant)"]
        MATCH["Match in __construct()"]
        DELEGATE["Delegate to OperacionesCtrl"]
    end
    
    AUTH --> CONST
    USERS --> CONST
    EMPL --> CONST
    DOCS --> CONST
    FLOW --> CONST
    PKG --> CONST
    
    CONST --> MD5
    MD5 --> MATCH
    MATCH --> DELEGATE
```

**Diagram: AJAX Endpoint Categories and Handler Resolution**

Each endpoint constant is hashed and matched in the `IndexCtrl::__construct()` method.

**Sources:** [src/ctrls/IndexCtrl.php:306-1263](), [src/ctrls/IndexCtrl.php:1401-2955]()

### Endpoint Constant Examples

| Functional Area | Constant Name | Line Number | Delegates To |
|----------------|---------------|-------------|--------------|
| Authentication | `API_LoginSystemAjax` | [372]() | `OperacionesCtrl::AutenticaUsuarioSisAjaxB64()` |
| Employees | `API_EmpleadosAdd` | [445]() | `OperacionesCtrl::Empleados_Agregar()` |
| Users | `API_UsuariosAdd` | [566]() | `OperacionesCtrl::usuarios_Agregar()` |
| Templates | `API_plantillasAdd` | [755]() | `OperacionesCtrl::plantillas_Agregar()` |
| Signatures | `API_FirmasGet` | [821]() | `OperacionesCtrl::firmas_Obtener()` |
| Workflows | `API_FlujosHelperAdd` | [957]() | `OperacionesCtrl::flujos_Agregar()` |
| Packages | `API_PaquetesGetAjax` | [1035]() | `OperacionesCtrl::paquetes_Obtener()` |

**Sources:** [src/ctrls/IndexCtrl.php:306-1263]()

---

## Request/Response Format

### REST API Request Format

REST API requests use standard HTTP methods with JSON payloads:

**POST Request Structure:**
```
POST /index.php/{endpoint_name}
Authorization: Bearer {rsa_public_key}
Content-Type: application/json

{
  "parameter1": "value1",
  "parameter2": "value2"
}
```

The endpoint name in the URL can be either:
- The literal method name (e.g., `EmpleadosAdd`)
- An MD5 hash of `"Api/Servidor/{MethodName}"`

**Sources:** [src/ctrls/Rest.php:168-199](), [src/ctrls/Rest.php:222-268]()

### AJAX API Request Format

AJAX API requests use POST parameters with MD5-hashed endpoint identifiers:

**POST Request Structure:**
```
POST /index.php
Content-Type: application/x-www-form-urlencoded

ajax={md5_of_constant}&param1=value1&param2=value2
```

**Example:**
```javascript
// JavaScript client example
const endpoint = md5('API_EmpleadosAdd');
const formData = new FormData();
formData.append('ajax', endpoint);
formData.append('nombre', 'John Doe');
formData.append('documento', '123456789');
```

**Sources:** [src/ctrls/IndexCtrl.php:1406-1420]()

### Response Format

Both APIs return JSON responses with consistent structure:

**Success Response:**
```json
{
  "ok": {
    "id": 123,
    "data": { /* result data */ }
  }
}
```

**Error Response:**
```json
{
  "err": "Error message description"
}
```

**HTTP Status Codes:**

| Code | Constant | Meaning |
|------|----------|---------|
| 200 | N/A | Success |
| 400 | N/A | Bad Request / Endpoint not found |
| 401 | N/A | Unauthorized / Invalid token |
| 520 | `ERR_COD_SIN_PRIVILEGIOS` | Insufficient privileges |
| 521 | `ERR_COD_USUARIO_NO_EXISTE_BY_ID` | User ID not found |
| 522 | `ERR_COD_ENVIO_MAIL_FALLIDO` | Email send failed |
| 523 | `ERR_COD_CAMBIO_CLAVE_FALLIDO` | Password change failed |
| 524 | `ERR_COD_CAMPO_OBLIGATORIO` | Required field missing |
| 529 | `ERR_COD_SESION_INACTIVA` | Session inactive |
| 530 | `ERR_COD_MSJ_ERR_COMUN` | Common error |
| 535 | `ERR_COD_USUARIO_O_CLAVE_INVALIDA` | Invalid credentials |
| 537 | `ERR_COD_REGISTRO_EXISTENTE` | Duplicate record |
| 538 | `ERR_COD_ACTUALIZACION_SQL` | SQL update failed |
| 539 | `ERR_COD_RESPUESTA_SQL_VACIA` | Empty SQL response |

**Sources:** [src/ctrls/IndexCtrl.php:76-277]()

---

## Major Endpoint Groups

### Authentication Endpoints

```mermaid
graph TB
    subgraph "Token-Based Authentication - REST"
        GENTOKEN["GenerarToken<br/>Basic Auth → Bearer Token"]
        COMPTOKEN["CompararToken<br/>Validate Bearer Token"]
    end
    
    subgraph "Session-Based Authentication - AJAX"
        LOGIN["API_LoginSystemAjax<br/>User/Password Login"]
        LOGINAS["API_IniciarLoginAsOtro<br/>Impersonate User"]
        SESSIONCHECK["API_SESSION_ACTIVA<br/>Check Session Status"]
    end
    
    subgraph "Password Recovery"
        RECUMAIL["RecuperarByEmail<br/>Send Recovery Code"]
        RECUASIGN["RecuAsignarClave<br/>Set New Password"]
    end
    
    subgraph "Business Logic"
        AUTENTICASIS["OperacionesCtrl::<br/>AutenticaUsuarioSisAjax()"]
        GENTOK["OperacionesCtrl::<br/>GenerarToken()"]
        RECUMAIL2["OperacionesCtrl::<br/>RecuperarByEmailAjax()"]
    end
    
    GENTOKEN --> GENTOK
    LOGIN --> AUTENTICASIS
    LOGINAS --> AUTENTICASIS
    RECUMAIL --> RECUMAIL2
```

**Diagram: Authentication Endpoint Architecture**

| Endpoint | Type | Authentication | Purpose |
|----------|------|----------------|---------|
| `GenerarToken` | REST | Basic Auth | Generate RSA Bearer token |
| `API_LoginSystemAjax` | AJAX | None | Authenticate user, create session |
| `API_IniciarLoginAsOtro` | AJAX | Session | Impersonate another user |
| `API_SESSION_ACTIVA` | AJAX | None | Check if session is active |
| `RecuperarByEmail` | REST | None | Send password recovery code |
| `RecuAsignarClave` | REST | None | Assign new password with code |

**Sources:** [src/ctrls/IndexCtrl.php:372-373](), [src/ctrls/IndexCtrl.php:365-366](), [src/ctrls/Rest.php:15-68](), [src/ctrls/OperacionesCtrl.php:674-787]()

### User and Employee Management Endpoints

```mermaid
graph TB
    subgraph "User CRUD Operations"
        USERADD["API_UsuariosAdd"]
        USERMOD["API_UsuariosMod"]
        USERRM["API_UsuariosRm"]
        USERGET["API_UsuariosGet"]
        USERGETAJAX["API_UsuariosGetAjax"]
    end
    
    subgraph "Employee CRUD Operations"
        EMPLADD["API_EmpleadosAdd"]
        EMPLMOD["API_EmpleadosMod"]
        EMPLRM["API_EmpleadosRm"]
        EMPLGET["API_EmpleadosGet"]
        EMPLGETAJAX["API_EmpleadosGetAjax"]
        EMPLACTIVAR["API_EmpleadosActivar"]
    end
    
    subgraph "Helper Operations"
        USERHELPER["API_UsuariosHelperGet<br/>API_UsuariosHelperMod"]
        EMPLHELPER["API_EmpleadosHelperGet<br/>API_EmpleadosHelperAdd"]
    end
    
    subgraph "Password Management"
        USERCLAVE["API_UsuariosClaveAsignadaAdmin<br/>API_UsuariosClaveAsignadaAdminManual"]
        EMPLCLAVE["API_EmpleadosClaveAsignadaAdmin<br/>API_EmpleadosClaveAsignadaAdminManual"]
    end
```

**Diagram: User and Employee Management Endpoints**

| Operation | Users Endpoint | Employees Endpoint |
|-----------|---------------|-------------------|
| Create | `API_UsuariosAdd` [566]() | `API_EmpleadosAdd` [445]() |
| Update | `API_UsuariosMod` [583]() | `API_EmpleadosMod` [454]() |
| Delete | `API_UsuariosRm` [592]() | `API_EmpleadosRm` [463]() |
| Read | `API_UsuariosGet` [610]() | `API_EmpleadosGet` [492]() |
| Read (AJAX) | `API_UsuariosGetAjax` [619]() | `API_EmpleadosGetAjax` [512]() |
| Activate | N/A | `API_EmpleadosActivar` [472]() |

**Sources:** [src/ctrls/IndexCtrl.php:557-656](), [src/ctrls/IndexCtrl.php:436-555]()

### Document and Workflow Management Endpoints

| Endpoint Group | Key Endpoints | Purpose |
|----------------|---------------|---------|
| **Templates** | `API_plantillasAdd` [755]()<br/>`API_plantillasNew` [764]()<br/>`API_plantillasDel` [773]() | Document template CRUD |
| **Signatures** | `API_FirmasGet` [821]()<br/>`API_FirmasPreviaGet` [831]()<br/>`API_FirmasproHelperAdd` [861]() | Digital signature management |
| **Workflows** | `API_FlujosHelperAdd` [957]()<br/>`API_FlujosGetAjax` [975]()<br/>`API_FlujosHelperEstadoMod` [966]() | Workflow process management |
| **Workflow Items** | `API_FlujositemsGet` [996]()<br/>`API_FlujositemsHelperGet` [1005]()<br/>`API_FlujositemsHelperDel` [1014]() | Individual workflow item operations |
| **Packages** | `API_PaquetesGetAjax` [1035]()<br/>`API_PaquetesHelperMoveReview` [1052]()<br/>`API_PaquetesHelperMoveAdmin` [1062]() | Document package management |

**Sources:** [src/ctrls/IndexCtrl.php:747-1095]()

### File and Resource Endpoints

```mermaid
graph TB
    subgraph "File Operations"
        UPLOAD["API_UpFotoPerfiles<br/>Upload Profile Photos"]
        CARGADATOS["API_Cargadatos_Upload<br/>Bulk Data Upload"]
        DOWNLOAD["API_LNK_DESCARGAR_ALUMNOS<br/>Download CSV"]
    end
    
    subgraph "Document Access"
        DOWNLOADPDF["API_LNK_DESCARGAR_PDF<br/>Download PDF<br/>Mask: REPO_ANEXOS"]
        VISTAPDF["API_LNK_VISTA_PDF_PROC<br/>View PDF<br/>Mask: REPO_PROCESOS"]
    end
    
    subgraph "Business Logic"
        SUBIR["OperacionesCtrl::<br/>SubirArchivo()"]
        URLMASK["OperacionesCtrl::<br/>crearUrlMask()"]
    end
    
    UPLOAD --> SUBIR
    CARGADATOS --> SUBIR
    DOWNLOADPDF --> URLMASK
    VISTAPDF --> URLMASK
```

**Diagram: File and Resource Management Endpoints**

**Special File Endpoints:**
- **`API_LNK_DESCARGAR_ALUMNOS`** - Generates CSV export of employee data
- **`API_LNK_DESCARGAR_PDF`** - Creates masked URL for secure PDF download from `repo/anexos`
- **`API_LNK_VISTA_PDF_PROC`** - Creates masked URL for PDF viewing from `repo/proc/{year}`
- **`API_UpFotoPerfiles`** - Handles profile photo uploads with Base64 encoding

**Sources:** [src/ctrls/IndexCtrl.php:743-744](), [src/ctrls/IndexCtrl.php:1354-1387](), [src/ctrls/OperacionesCtrl.php:889-927]()

---

## Endpoint Discovery

### REST API Endpoint Discovery

REST API endpoints can be discovered using the built-in WSDL endpoint:

**Request:**
```
POST /index.php/dd3bda2f13f14aef6cc0ede06064e75d
Authorization: Bearer {token}
```

**Response:**
```
AutenticaUsuarioSis = 88400f0088a755f38f2d3a8d6f3a39fd
RecuperarByEmail = 7cdf28cdb306941ec39675734b000b60
RecuAsignarClave = a30004055c915a3c7bc971256074374e
...
```

This endpoint returns all available REST methods with their MD5 hashes for `"Api/Servidor/{MethodName}"`.

**Sources:** [src/ctrls/Rest.php:230-237]()

### AJAX API Endpoint Discovery

AJAX endpoints are discovered by examining the constant definitions in `IndexCtrl.php`:

```php
// Example endpoint constants
const API_EmpleadosAdd = 'API_EmpleadosAdd';
const API_UsuariosGet = 'API_UsuariosGet';
const API_FlujosHelperAdd = 'API_FlujosHelperAdd';

// Client computes: md5('API_EmpleadosAdd')
// Server matches in __construct()
```

To use an endpoint:
1. Find the constant name in [src/ctrls/IndexCtrl.php:306-1263]()
2. Compute `md5(constant_value)`
3. Send as `ajax` POST parameter

**Sources:** [src/ctrls/IndexCtrl.php:306-1263](), [src/ctrls/IndexCtrl.php:1406-1450]()

---

## Special Endpoint Patterns

### Helper Endpoints

Many endpoints follow a **"Helper" pattern** for auxiliary operations:

| Pattern | Example | Purpose |
|---------|---------|---------|
| `*HelperGet` | `API_EmpleadosHelperGet` | Retrieve auxiliary/metadata |
| `*HelperAdd` | `API_FlujosHelperAdd` | Add with helper validation |
| `*HelperMod` | `API_UsuariosHelperMod` | Modify with helper logic |
| `*HelperDel` | `API_FlujositemsHelperDel` | Delete with cascade handling |

Helper endpoints typically perform validation, cascade operations, or retrieve related data beyond simple CRUD operations.

**Sources:** [src/ctrls/IndexCtrl.php:481-522](), [src/ctrls/IndexCtrl.php:599-601]()

### Home Controller Endpoints

Endpoints prefixed with `API_Home_*` are handled by `OperacionesHomeCtrl` for public-facing operations:

| Endpoint | Purpose | Authentication |
|----------|---------|----------------|
| `API_Home_Login` [1217]() | Public user login | None required |
| `API_Home_SolicitarTkn` [1208]() | Request activation token | None required |
| `API_Home_RecuperaUsuario` [1199]() | Recover user account | None required |
| `API_MiPerfilHomeGet` [1235]() | Get user profile | Session required |
| `API_Home_Empleado_Registro` [1262]() | Employee self-registration | None required |

**Sources:** [src/ctrls/IndexCtrl.php:1169-1263]()

### Configuration Endpoints

System configuration is managed through dedicated endpoints:

```mermaid
graph LR
    CONFIG["API_AgregarConfigCorp"]
    INST["API_InstitucionAdd<br/>API_InstitucionLogo"]
    ANYO["API_AnyolectivoAdd"]
    
    subgraph "Configuration Storage"
        ADMINCONFIG["adminconfig table"]
        MODCONFIG["OperacionesCtrl::<br/>ModificaConfigCorp()"]
    end
    
    CONFIG --> MODCONFIG
    INST --> MODCONFIG
    ANYO --> MODCONFIG
    MODCONFIG --> ADMINCONFIG
```

**Diagram: Configuration Management Flow**

All configuration changes are tracked with:
- User who made the change (`usuario_full`)
- Timestamp (`fecha`)
- Configuration key (`nombre`)
- Configuration value (`val`)

**Sources:** [src/ctrls/IndexCtrl.php:357-358](), [src/ctrls/IndexCtrl.php:424-434](), [src/ctrls/OperacionesCtrl.php:1283-1382]()

---

## Error Handling

### Error Response Structure

All errors follow a consistent JSON structure:

```json
{
  "err": "Error description message"
}
```

Errors may include HTTP status code prefixes:

```json
{
  "err": "[524] Campo obligatorio: nombre"
}
```

**Sources:** [src/ctrls/IndexCtrl.php:1416-1417](), [src/ctrls/Rest.php:21-22]()

### Common Error Patterns

| Error Type | Implementation | Example |
|------------|----------------|---------|
| **Missing Authentication** | `http_response_code(401)` | Bearer token not provided/invalid |
| **Missing Required Field** | `ERR_COD_CAMPO_OBLIGATORIO` | Required parameter not in request |
| **Database Error** | `ERR_COD_MSJ_ERR_COMUN` | SQL query failed |
| **Business Logic Error** | Custom exception message | Validation rule violation |
| **Session Expired** | `ERR_COD_SESION_INACTIVA` | User session timed out |

**Exception Throwing Pattern:**
```php
// All operations follow this pattern
try {
    $result = OperacionesCtrl::someOperation($data);
    echo json_encode($result);
} catch (Exception $ex) {
    $error = array("err" => $ex->getMessage());
    echo json_encode($error);
}
die("");
```

Every endpoint terminates with `die("")` after sending the response to prevent further execution.

**Sources:** [src/ctrls/IndexCtrl.php:1411-1420](), [src/ctrls/Rest.php:17-24]()

---

## Authentication Flow Comparison

```mermaid
sequenceDiagram
    participant Client
    participant IndexPHP as index.php
    participant IndexCtrl
    participant Rest
    participant OpCtrl as OperacionesCtrl
    participant Session
    participant ApiboxLib
    
    Note over Client,ApiboxLib: REST API Flow (Token-Based)
    Client->>IndexPHP: POST /endpoint<br/>Bearer: {token}
    IndexPHP->>IndexCtrl: PATH_INFO detected
    IndexCtrl->>Rest: Rest::handler()
    Rest->>Rest: getBearerToken()
    Rest->>OpCtrl: CompararToken()
    OpCtrl->>ApiboxLib: Validate token
    ApiboxLib-->>OpCtrl: Token valid + user data
    OpCtrl-->>Rest: Authenticated
    Rest->>OpCtrl: Execute business logic
    OpCtrl-->>Rest: Result
    Rest->>Client: JSON + die()
    
    Note over Client,ApiboxLib: AJAX API Flow (Session-Based)
    Client->>IndexPHP: POST ajax={md5}
    IndexPHP->>IndexCtrl: Constructor
    IndexCtrl->>Session: Check $_SESSION["usu"]
    Session-->>IndexCtrl: User data
    IndexCtrl->>IndexCtrl: Match md5 to constant
    IndexCtrl->>OpCtrl: Execute business logic
    OpCtrl-->>IndexCtrl: Result
    IndexCtrl->>Client: JSON + die()
```

**Diagram: REST vs AJAX Authentication Flow Comparison**

**Key Differences:**

| Aspect | REST API | AJAX API |
|--------|----------|----------|
| **Authentication** | Bearer token (RSA keys) | PHP session |
| **State** | Stateless | Stateful |
| **Entry Detection** | `$_SERVER['PATH_INFO']` | `$_POST['ajax']` |
| **Token Storage** | `apibox` table | `$_SESSION` variable |
| **Expiration** | Configurable (default 60 min) | PHP session timeout |
| **Endpoint Routing** | Method name or MD5 | MD5 of constant |
| **URL Pattern** | `/index.php/{endpoint}` | `/index.php` |

**Sources:** [src/ctrls/IndexCtrl.php:1323-1334](), [src/ctrls/Rest.php:114-163]()

---

## Usage Examples

### REST API Example: Generate Token

**Step 1: Generate Bearer Token**
```bash
curl -X POST "https://example.com/index.php/GenerarToken" \
  -u "username:password" \
  -H "Content-Type: application/json"
```

**Response:**
```
-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA...
-----END PUBLIC KEY-----
```

**Step 2: Use Bearer Token**
```bash
curl -X POST "https://example.com/index.php/EmpleadosAdd" \
  -H "Authorization: Bearer {public_key_from_step_1}" \
  -H "Content-Type: application/json" \
  -d '{
    "nombre": "John Doe",
    "documento": "123456789",
    "mail": "john@example.com"
  }'
```

**Sources:** [src/ctrls/Rest.php:240-244](), [src/ctrls/OperacionesCtrl.php:674-787]()

### AJAX API Example: Add Employee

**JavaScript Client:**
```javascript
// Step 1: Compute endpoint hash
const endpoint = md5('API_EmpleadosAdd');

// Step 2: Prepare form data
const formData = new FormData();
formData.append('ajax', endpoint);
formData.append('nombre', 'Jane Smith');
formData.append('documento', '987654321');
formData.append('mail', 'jane@example.com');

// Step 3: Send request
fetch('/index.php', {
  method: 'POST',
  body: formData,
  credentials: 'include' // Include session cookie
})
.then(response => response.json())
.then(data => {
  if (data.err) {
    console.error('Error:', data.err);
  } else {
    console.log('Success:', data.ok);
  }
});
```

**Sources:** [src/ctrls/IndexCtrl.php:445](), [src/ctrls/IndexCtrl.php:1523-1531]()

### REST API Example: Authenticate User

```bash
curl -X POST "https://example.com/index.php/88400f0088a755f38f2d3a8d6f3a39fd" \
  -H "Authorization: Bearer {token}" \
  -H "Content-Type: application/json" \
  -d '{
    "u": "username_or_email",
    "c": "password"
  }'
```

**Response (Success):**
```json
{
  "id": 123,
  "usuario": "username",
  "nombre": "John Doe",
  "mail": "john@example.com",
  "perfil_id": 2,
  "estado_id": 1
}
```

**Note:** The `clave` field is always excluded from the response for security.

**Sources:** [src/ctrls/Rest.php:59-68](), [src/ctrls/OperacionesCtrl.php:560-595]()

---

## Best Practices

### Security Considerations

1. **Always use HTTPS** in production to protect Bearer tokens and credentials
2. **Rotate Bearer tokens** periodically using `forcenew` parameter in `GenerarToken`
3. **Validate all input** - The system uses both safe (prepared statements) and classic (string concatenation) SQL methods
4. **Check user state** - Users with `estado_id > 1` are automatically logged out
5. **Implement rate limiting** - Prevent brute force attacks on authentication endpoints

**Sources:** [src/ctrls/IndexCtrl.php:1315-1319](), [src/ctrls/OperacionesCtrl.php:737-750]()

### Performance Optimization

1. **Use AJAX for frequent operations** - Lower overhead than REST token validation
2. **Cache configuration values** - `LeerConfigCorp()` returns all configs; cache on client
3. **Batch operations** - Use bulk endpoints when available (e.g., `API_Cargadatos_Upload`)
4. **Monitor token expiration** - Proactively renew tokens before expiration

**Sources:** [src/ctrls/OperacionesCtrl.php:1312-1324]()

### Error Handling

1. **Always check for `err` key** in JSON responses
2. **Parse HTTP status codes** - Use numeric codes for programmatic error handling
3. **Log errors** - System uses `error_log()` for debugging
4. **Handle `die()` termination** - All endpoints terminate execution after response

**Sources:** [src/ctrls/IndexCtrl.php:1416-1417](), [src/ctrls/Rest.php:21-24]()

---

## API Versioning

The system currently does not implement formal API versioning. However, the dual API pattern effectively provides two "versions":

- **v1 (Legacy):** AJAX API with session-based authentication
- **v2 (Modern):** REST API with token-based authentication

Both versions are maintained simultaneously and delegate to the same business logic layer (`OperacionesCtrl`), ensuring consistency across API paradigms.

**Sources:** [src/ctrls/IndexCtrl.php:1323-1450](), [src/ctrls/Rest.php:114-275]()

---

---

## 9.1 REST API Endpoints

This page documents the REST API endpoints provided by the GESFINANCIERO system. The REST API offers token-based authentication and programmatic access to core system operations. For traditional AJAX endpoints used by the web interface, see [AJAX API Endpoints](#9.2). For detailed documentation of specific functional areas, see [User Management APIs](#9.3) and [Document and Workflow APIs](#9.4).

The REST API is handled by the `Rest` class and provides a separate authentication and routing mechanism from the main application AJAX endpoints.

## API Architecture Overview

```mermaid
graph TB
    CLIENT["Client Application"]
    ENTRY["index.php<br/>Entry Point"]
    REST["Rest::handler()<br/>API Router"]
    OPCTRL["OperacionesCtrl<br/>Business Logic"]
    APIBOX["ApiboxLib<br/>Token Storage"]
    DB[("MySQL Database<br/>nuevapp_apps")]
    
    CLIENT -->|"HTTP Request<br/>PATH_INFO set"| ENTRY
    ENTRY -->|"Detected REST call"| REST
    
    REST -->|"1. Extract Bearer Token"| REST
    REST -->|"2. Validate Token"| APIBOX
    APIBOX -->|"Query apibox table"| DB
    REST -->|"3. Route to method"| REST
    REST -->|"4. Execute operation"| OPCTRL
    OPCTRL -->|"Business operations"| DB
    OPCTRL -->|"JSON response"| REST
    REST -->|"HTTP Response<br/>die()"| CLIENT
    
    REST -.->|"Basic Auth<br/>for GenerarToken"| OPCTRL
```

**Sources:** [src/ctrls/Rest.php:114-275](), [index.php (routing logic)]()

## Authentication Mechanisms

The REST API supports two authentication methods:

### Bearer Token Authentication

Bearer token authentication uses RSA public/private key pairs for secure API access. Tokens are generated via Basic authentication and then used for subsequent API calls.

| Component | Description |
|-----------|-------------|
| **Token Generation** | `OperacionesCtrl::GenerarToken()` creates RSA key pairs |
| **Token Storage** | Stored in `apibox` table via `ApiboxLib` |
| **Token Validation** | `OperacionesCtrl::CompararToken()` validates Bearer tokens |
| **Token Format** | RSA public key in PEM format sent as Bearer token |
| **Token Lifetime** | Configurable via `CFG_LGIN_APT` (default: 60 minutes) |

**Token Generation Flow:**

```mermaid
sequenceDiagram
    participant Client
    participant Rest as Rest::handler()
    participant OpCtrl as OperacionesCtrl
    participant ApiboxLib
    participant DB as Database
    
    Client->>Rest: POST with Basic Auth<br/>to GenerarToken
    Rest->>Rest: getAuthBasic()
    Rest->>OpCtrl: GenerarToken(u, c)
    OpCtrl->>OpCtrl: AutenticaUsuarioSisAjax()
    OpCtrl->>DB: Validate credentials
    DB-->>OpCtrl: User data
    OpCtrl->>OpCtrl: GenerarLlavePublica()<br/>Create RSA key pair
    OpCtrl->>ApiboxLib: Crear(id, key)
    ApiboxLib->>DB: INSERT INTO apibox
    DB-->>ApiboxLib: Token ID
    ApiboxLib-->>OpCtrl: Token data
    OpCtrl-->>Rest: Public key (PEM)
    Rest-->>Client: JSON with public key
```

**Sources:** [src/ctrls/Rest.php:240-244](), [src/ctrls/OperacionesCtrl.php:674-787](), [src/ctrls/OperacionesCtrl.php:621-643]()

### Token Validation Process

```mermaid
graph TB
    REQUEST["Incoming REST Request"]
    BEARER["getBearerToken()"]
    COMPARE["CompararToken()"]
    APIBOX["ApiboxLib::Comparar()"]
    DBQUERY["Query apibox table"]
    CHECKACTIVE["Check activo = 1"]
    CHECKTIME["Check token expiry<br/>CFG_LGIN_APT minutes"]
    EXECUTE["Execute endpoint method"]
    ERROR401["401 Unauthorized<br/>Invalid/Expired/Disabled"]
    
    REQUEST --> BEARER
    BEARER -->|"Token found"| COMPARE
    COMPARE --> APIBOX
    APIBOX --> DBQUERY
    DBQUERY --> CHECKACTIVE
    CHECKACTIVE -->|"activo != 1"| ERROR401
    CHECKACTIVE -->|"activo = 1"| CHECKTIME
    CHECKTIME -->|"Expired"| ERROR401
    CHECKTIME -->|"Valid"| EXECUTE
    BEARER -->|"No token"| ERROR401
```

**Sources:** [src/ctrls/Rest.php:123-163](), [src/ctrls/OperacionesCtrl.php:804-817](), [src/libs/Apibox/ApiboxLib.php (Comparar method)]()

### Basic Authentication

Basic authentication is only used for the initial `GenerarToken` endpoint to obtain a Bearer token. It is not used for other API operations.

**Sources:** [src/ctrls/Rest.php:165-166, 240-244]()

## Request Format

### HTTP Method Support

| Method | Purpose | Current Usage |
|--------|---------|---------------|
| **POST** | Primary method for API operations | All authenticated endpoints |
| **GET** | Method discovery and public endpoints | `notkn_*` methods |
| **PUT** | Reserved for future use | Not implemented |
| **DELETE** | Reserved for future use | Not implemented |

**Sources:** [src/ctrls/Rest.php:202-274]()

### URL Structure

REST API endpoints are accessed via PATH_INFO routing:

```
https://domain.com/index.php/[endpoint_identifier]
```

Where `[endpoint_identifier]` is either:
- An MD5 hash: `md5("Api/Servidor/MethodName")` for legacy methods
- A method name: Direct method name for `tkn_*` and `notkn_*` methods

**Sources:** [src/ctrls/Rest.php:169, 191]()

### Request Headers

```
Authorization: Bearer <RSA_PUBLIC_KEY_PEM>
Content-Type: application/json
```

**Sources:** [src/ctrls/Rest.php:123, 227]()

### Request Body

Request body must be valid JSON:

```json
{
  "param1": "value1",
  "param2": "value2"
}
```

**Sources:** [src/ctrls/Rest.php:170-189]()

## Response Format

### Success Response

```json
{
  "ok": {
    "field1": "value1",
    "field2": "value2"
  }
}
```

### Error Response

```json
{
  "err": "Error message description"
}
```

All endpoints terminate with `die()` after sending the response, preventing further execution.

**Sources:** [src/ctrls/Rest.php:15-69]()

## Endpoint Routing Mechanisms

The REST API uses three distinct routing mechanisms:

```mermaid
graph TB
    HANDLER["Rest::handler()"]
    METHOD["Check HTTP Method"]
    
    subgraph "POST Method Routing"
        CHECKAUTH["Check Authentication"]
        BASICAUTH["Basic Auth?"]
        BEARERAUTH["Bearer Token?"]
        
        GENTOKEN["GenerarToken<br/>Direct call"]
        
        TKN["Check tkn_ prefix<br/>method_exists()"]
        TKNEXEC["Execute tkn_* method"]
        
        MD5["Check MD5 hash<br/>md5('Api/Servidor/Method')"]
        MD5EXEC["Execute hashed method"]
        
        ERROR400["400 Bad Request<br/>Endpoint not found"]
    end
    
    subgraph "GET Method Routing"
        NOTKN["Check notkn_ prefix"]
        NOTKNEXEC["Execute notkn_* method"]
    end
    
    HANDLER --> METHOD
    METHOD -->|"POST"| CHECKAUTH
    METHOD -->|"GET"| NOTKN
    
    CHECKAUTH --> BASICAUTH
    CHECKAUTH --> BEARERAUTH
    
    BASICAUTH -->|"Yes + ajax='GenerarToken'"| GENTOKEN
    
    BEARERAUTH -->|"Valid token"| TKN
    TKN -->|"method_exists()"| TKNEXEC
    TKN -->|"not found"| ERROR400
    
    BASICAUTH -->|"No token"| MD5
    MD5 -->|"Hash matches"| MD5EXEC
    MD5 -->|"No match"| ERROR400
    
    NOTKN -->|"method_exists()"| NOTKNEXEC
```

**Sources:** [src/ctrls/Rest.php:202-274]()

## Available Endpoints

### Token Management Endpoints

#### POST GenerarToken

Generates a new API token using Basic authentication.

**Authentication:** Basic Auth (username and password)

**Request:**
```json
{
  "u": "user@example.com",
  "c": "password"
}
```

**Response:**
```json
"-----BEGIN PUBLIC KEY-----\nMIIBIjANBgkq...\n-----END PUBLIC KEY-----"
```

**Validation:**
- User must have authorized profile: `perfil_id` in [1, 2, 7]
- User must be active: `estado_id = 1`
- Generates RSA 2048-bit key pair with SHA-512 digest

**Sources:** [src/ctrls/Rest.php:241-243](), [src/ctrls/OperacionesCtrl.php:674-787]()

### Authentication Endpoints

#### POST AutenticaUsuarioSis

Authenticates a user and returns user data (excluding password).

**Endpoint Hash:** `md5("Api/Servidor/AutenticaUsuarioSis")` = `88400f0088a755f38f2d3a8d6f3a39fd`

**Authentication:** None (public endpoint)

**Request:**
```json
{
  "u": "user@example.com",
  "c": "password"
}
```

**Response:**
```json
{
  "id": 123,
  "usuario": "user@example.com",
  "nombres": "John",
  "apellidos": "Doe",
  "perfil_id": 1,
  "estado_id": 1,
  "mail": "user@example.com"
}
```

**Notes:**
- Password field is explicitly removed from response
- Supports authentication by username or email
- Uses MD5 hash of password for validation

**Sources:** [src/ctrls/Rest.php:59-68](), [src/ctrls/OperacionesCtrl.php:560-595]()

### Password Recovery Endpoints

#### POST RecuperarByEmail

Sends a temporary activation code to user's email for password recovery.

**Endpoint Hash:** `md5("Api/Servidor/RecuperarPorEmail")` = `7cdf28cdb306941ec39675734b000b60`

**Authentication:** None (public endpoint)

**Request:**
```json
{
  "emailactivar": "user@example.com"
}
```

**Response:**
```json
{
  "ok": "a1b2c3d4e5f6..."
}
```

**Process:**
1. Validates email format
2. Generates 6-digit activation code
3. Stores code in `codigoactiva` table
4. Sends email with template `nuevaclave.html`
5. Returns MD5 hash of user ID

**Sources:** [src/ctrls/Rest.php:39-48](), [src/ctrls/OperacionesCtrl.php:952-1035]()

#### POST RecuAsignarClave

Assigns a new password using a temporary activation code.

**Endpoint Hash:** `md5("Api/Servidor/RecuAsignarClave")` = `a30004055c915a3c7bc971256074374e`

**Authentication:** None (public endpoint)

**Request:**
```json
{
  "codActiva": "123456",
  "key": "a1b2c3d4e5f6...",
  "c": "newpassword"
}
```

**Response:**
```json
{
  "ok": true
}
```

**Validation:**
- Code must not have been used (`activo = 0`)
- Code must be less than 10 minutes old
- Key must match MD5 of user ID

**Sources:** [src/ctrls/Rest.php:15-24](), [src/ctrls/OperacionesCtrl.php:1062-1126]()

### Public Endpoints (No Token Required)

These endpoints use the `notkn_` prefix and do not require Bearer token authentication:

#### GET/POST notkn_CheckComm

Checks for pending communications to send.

**Method Name:** `notkn_CheckComm`

**Request:** Array of communication parameters

**Notes:**
- Calls `OperacionesCtrl::comunicaciones_CheckForSend()`
- Disables authentication requirement with `authRequOff()`

**Sources:** [src/ctrls/Rest.php:73-82]()

#### GET/POST notkn_Revisar

Reviews signature processes.

**Method Name:** `notkn_Revisar`

**Request:** Review parameters

**Notes:**
- Calls `OperacionesCtrl::firmaspro_Revisar()`

**Sources:** [src/ctrls/Rest.php:84-92]()

#### GET/POST notkn_GestorDocumental

Document management helper endpoint.

**Method Name:** `notkn_GestorDocumental`

**Request:** Document management parameters

**Notes:**
- Calls `OperacionesCtrl::gestordocumentalHelper()`

**Sources:** [src/ctrls/Rest.php:94-102]()

## Token-Authenticated Endpoints

Endpoints with the `tkn_` prefix require valid Bearer token authentication. The system supports these by checking for methods with this prefix:

```php
$tknN = 'tkn_' . $ajax;
if( method_exists( 'Rest', $tknN ) ){
    self::{ $tknN }( $input );
}
```

To add new token-authenticated endpoints, create methods in the `Rest` class with the `tkn_` prefix.

**Sources:** [src/ctrls/Rest.php:247-250]()

## Service Discovery

### WSDL Endpoint

The API provides a service discovery endpoint that lists all available methods:

**Endpoint Hash:** `md5('wsdl')` = `dd3bda2f13f14aef6cc0ede06064e75d`

**Request:**
```
POST /index.php/dd3bda2f13f14aef6cc0ede06064e75d
```

**Response:**
```
MethodName1 = hash1
MethodName2 = hash2
...
```

Each line shows the method name and its corresponding MD5 hash for routing.

**Sources:** [src/ctrls/Rest.php:230-237]()

## Error Handling

### HTTP Status Codes

| Code | Meaning | Trigger Condition |
|------|---------|-------------------|
| **200** | OK | Successful operation |
| **400** | Bad Request | Endpoint not found, invalid JSON |
| **401** | Unauthorized | Invalid, expired, or disabled token |
| **500** | Internal Server Error | Application-level errors |

**Sources:** [src/ctrls/Rest.php:138-162, 255-258]()

### Error Response Structure

All errors follow this JSON structure:

```json
{
  "err": "Descriptive error message"
}
```

### Common Error Messages

| Error Message | Cause | Resolution |
|---------------|-------|------------|
| `"Invalid token"` | Bearer token not found in database | Generate new token |
| `"Expired token"` | Token exceeded `CFG_LGIN_APT` lifetime | Generate new token |
| `"Disabled token"` | Token marked as inactive (`activo != 1`) | Generate new token |
| `"Endpoint no existe"` | Unknown `tkn_*` method | Check method name |
| `"id: X, msj: Y"` | JSON parsing error | Fix JSON syntax |

**Sources:** [src/ctrls/Rest.php:138-162, 173-189]()

## Request Execution Flow

```mermaid
sequenceDiagram
    participant Client
    participant WebServer
    participant IndexPHP as index.php
    participant Rest as Rest::handler()
    participant OpCtrl as OperacionesCtrl
    participant DB as Database
    
    Client->>WebServer: HTTP Request<br/>with PATH_INFO
    WebServer->>IndexPHP: Route request
    IndexPHP->>IndexPHP: Detect PATH_INFO set
    IndexPHP->>Rest: Call handler()
    
    Rest->>Rest: Extract HTTP method
    Rest->>Rest: getBearerToken()
    
    alt Bearer Token Present
        Rest->>OpCtrl: CompararToken(pkey)
        OpCtrl->>DB: Query apibox table
        DB-->>OpCtrl: Token data
        OpCtrl-->>Rest: Validation result
        
        alt Token Valid
            Rest->>Rest: Check expiry<br/>(CFG_LGIN_APT)
            
            alt Not Expired
                Rest->>Rest: Route to tkn_* method
                Rest->>OpCtrl: Execute business logic
                OpCtrl->>DB: Business operations
                DB-->>OpCtrl: Results
                OpCtrl-->>Rest: JSON response
                Rest->>Rest: echo json_encode()
                Rest->>Rest: die()
            else Expired
                Rest->>Client: 401 Expired token
            end
        else Token Invalid
            Rest->>Client: 401 Invalid token
        end
        
    else No Bearer Token
        Rest->>Rest: getAuthBasic()
        
        alt Basic Auth for GenerarToken
            Rest->>OpCtrl: GenerarToken()
            OpCtrl-->>Rest: New token
            Rest->>Client: JSON with token
        else MD5 Hash Method
            Rest->>Rest: Check MD5 routes
            Rest->>OpCtrl: Execute method
            OpCtrl-->>Rest: JSON response
            Rest->>Client: Response
        end
    end
```

**Sources:** [src/ctrls/Rest.php:114-275]()

## Integration with IndexCtrl

The REST API is invoked from `IndexCtrl` when `PATH_INFO` is detected:

```mermaid
graph LR
    REQUEST["HTTP Request"]
    INDEX["IndexCtrl::render()"]
    CHECKPATH["Check PATH_INFO"]
    REST["Rest::handler()"]
    DIE["die() - No page render"]
    
    REQUEST --> INDEX
    INDEX --> CHECKPATH
    CHECKPATH -->|"PATH_INFO set"| REST
    REST --> DIE
    CHECKPATH -->|"No PATH_INFO"| INDEX
```

This early routing ensures REST API calls terminate immediately without triggering the full page rendering pipeline.

**Sources:** [index.php (IndexCtrl instantiation)]()

## Security Considerations

### Token Security

- **RSA Key Generation**: Uses 2048-bit RSA keys with SHA-512 digest algorithm
- **Private Key Protection**: Private keys stored encrypted with passphrase: `email + timestamp`
- **Token Expiry**: Configurable via `CFG_LGIN_APT` (default 60 minutes)
- **Single Active Token**: New token generation invalidates previous tokens

**Sources:** [src/ctrls/OperacionesCtrl.php:621-643]()

### Authentication Flow Security

- **Password Hashing**: Passwords validated using MD5 (legacy, should migrate to bcrypt)
- **No Password in Response**: User authentication explicitly removes `clave` field
- **Activation Code Expiry**: Temporary codes expire after 10 minutes
- **One-Time Codes**: Activation codes marked as used after successful password reset

**Sources:** [src/ctrls/OperacionesCtrl.php:560-595, 1062-1126]()

### Endpoint Authorization

- **Token Generation Restriction**: Only users with `perfil_id` in [1, 2, 7]
- **Active User Requirement**: Only users with `estado_id = 1` can generate tokens
- **Token Validation**: Every authenticated request validates token status and expiry

**Sources:** [src/ctrls/OperacionesCtrl.php:696-778]()

## Configuration Constants

Key configuration constants affecting REST API behavior:

| Constant | Purpose | Location |
|----------|---------|----------|
| `CFG_LGIN_APT` | Token lifetime in minutes (default: 60) | `OperacionesCtrl` |
| `CFG_SMTP_*` | Email service configuration for password recovery | `OperacionesCtrl` |

**Sources:** [src/ctrls/OperacionesCtrl.php:700-701](), [src/ctrls/OperacionesCtrl.php:1149-1235]()

---

---

## 9.2 AJAX API Endpoints

## Purpose and Scope

This page documents the AJAX API endpoints exposed by the GESFINANCIERO system through the `IndexCtrl` controller. These endpoints handle authenticated AJAX requests from the frontend, providing functionality for user management, document workflows, templates, signatures, and system configuration. All AJAX endpoints use POST requests with MD5-hashed endpoint identifiers and return JSON responses.

For REST API endpoints with Bearer token authentication, see [REST API Endpoints](#9.1). For detailed business logic implementations, see [OperacionesCtrl - Core Operations](#4.1). For user and employee management specifics, see [User Management APIs](#9.3). For document and workflow operations, see [Document and Workflow APIs](#9.4).

---

## AJAX API Architecture

### Request Processing Flow

The AJAX API uses a hash-based routing mechanism where each endpoint is identified by an MD5 hash of a predefined constant. This design obfuscates endpoint names in client-side code while maintaining a clear mapping on the server side.

```mermaid
sequenceDiagram
    participant Client as "Frontend Client"
    participant IndexPHP as "index.php"
    participant IndexCtrl as "IndexCtrl::__construct()"
    participant OpCtrl as "OperacionesCtrl"
    participant DB as "Database"
    
    Client->>IndexPHP: POST request with ajax parameter
    IndexPHP->>IndexCtrl: Instantiate controller
    IndexCtrl->>IndexCtrl: Check session validity
    IndexCtrl->>IndexCtrl: Match MD5 hash to endpoint
    
    alt Valid Endpoint Match
        IndexCtrl->>OpCtrl: Call business logic method
        OpCtrl->>DB: Execute database operations
        DB-->>OpCtrl: Return data
        OpCtrl-->>IndexCtrl: Return result array
        IndexCtrl->>IndexCtrl: json_encode(result)
        IndexCtrl-->>Client: JSON response + die()
    else No Match
        IndexCtrl-->>Client: Continue to page render
    end
```

Sources: [src/ctrls/IndexCtrl.php:1308-1450]()

---

### Hash-Based Routing Mechanism

Each AJAX endpoint is protected by MD5 hashing to prevent direct enumeration of available endpoints from client-side code. The client must know the exact constant name to generate the correct hash.

```mermaid
graph LR
    subgraph "Client Side"
        CONST["API_EmpleadosAdd"]
        HASH["md5('API_EmpleadosAdd')"]
        REQUEST["POST with ajax param"]
    end
    
    subgraph "Server Side"
        POST["$_POST['ajax']"]
        COMPARE["Compare with<br/>md5(self::API_EmpleadosAdd)"]
        ROUTE["Route to<br/>OperacionesCtrl::Empleados_Agregar()"]
    end
    
    CONST-->HASH
    HASH-->REQUEST
    REQUEST-->POST
    POST-->COMPARE
    COMPARE-->ROUTE
```

Sources: [src/ctrls/IndexCtrl.php:1401-1450](), [src/ctrls/IndexCtrl.php:424-731]()

---

### Standard Request/Response Pattern

All AJAX endpoints follow a consistent pattern for request handling and response formatting:

**Request Structure:**
- **Method:** POST
- **Content-Type:** application/x-www-form-urlencoded or multipart/form-data
- **Required Parameter:** `ajax` - MD5 hash of endpoint constant
- **Additional Parameters:** Endpoint-specific data fields

**Response Structure:**
- **Success:** `{"ok": result_data}` with HTTP 200
- **Error:** `{"err": "error_message"}` with appropriate HTTP error code

**Example Flow:**

```mermaid
graph TD
    A["Client Request"] --> B["IndexCtrl receives POST"]
    B --> C{"Session valid?"}
    C -->|No| D["Logout + Redirect"]
    C -->|Yes| E{"MD5 hash matches?"}
    E -->|No| F["Continue to next check"]
    E -->|Yes| G["Call OperacionesCtrl method"]
    G --> H{"Try-Catch Block"}
    H -->|Success| I["json_encode(ok_array)"]
    H -->|Exception| J["json_encode(err_array)<br/>+ set HTTP code"]
    I --> K["echo JSON + die()"]
    J --> K
```

Sources: [src/ctrls/IndexCtrl.php:1401-1450](), [src/ctrls/IndexCtrl.php:1523-1562]()

---

## Endpoint Categories

The AJAX API is organized into functional categories, each handling specific aspects of the system. Below is a comprehensive mapping of all endpoint categories with their corresponding constants and handler methods.

### System and Authentication

| Constant | MD5 Check Line | Handler Method | Purpose |
|----------|---------------|----------------|---------|
| `API_AgregarConfigCorp` | [1411]() | `OperacionesCtrl::EscribirConfig()` | Add/update corporate configuration |
| `API_IniciarLoginAsOtro` | [1422]() | Session manipulation | Login as another user (admin feature) |
| `API_LoginSystemAjax` | [1441]() | `OperacionesCtrl::AutenticaUsuarioSisAjaxB64()` | System login with Base64 credentials |
| `API_RecuperarSisClave` | [1487]() | `OperacionesCtrl::sistema_recuperarClave_Get()` | Password recovery |
| `API_TamanoUsoGet` | [1476]() | `OperacionesCtrl::sistema_Tamano_Get()` | Get storage usage statistics |

Sources: [src/ctrls/IndexCtrl.php:357-412](), [src/ctrls/IndexCtrl.php:1411-1497]()

---

### Institution Management

| Constant | MD5 Check Line | Handler Method | Purpose |
|----------|---------------|----------------|---------|
| `API_InstitucionAdd` | [1500]() | `OperacionesCtrl::institucion_Agregar()` | Create/update institution |
| `API_InstitucionLogo` | [1510]() | `OperacionesCtrl::institucion_AgregarLogo()` | Upload institution logo |

Sources: [src/ctrls/IndexCtrl.php:424-434](), [src/ctrls/IndexCtrl.php:1500-1520]()

---

### Employee Management

| Constant | MD5 Check Line | Handler Method | Purpose |
|----------|---------------|----------------|---------|
| `API_EmpleadosAdd` | [1523]() | `OperacionesCtrl::Empleados_Agregar()` | Create new employee |
| `API_EmpleadosMod` | [1533]() | `OperacionesCtrl::Empleados_Helper_Modificar()` | Modify employee data |
| `API_EmpleadosRm` | [1543]() | `OperacionesCtrl::Empleados_Eliminar()` | Remove/deactivate employee |
| `API_EmpleadosActivar` | [1553]() | `OperacionesCtrl::Empleados_Activar()` | Activate employee account |
| `API_EmpleadosHelperGet` | [1563]() | `OperacionesCtrl::Empleados_Helper_Obtener()` | Get employee helper data |
| `API_EmpleadosGet` | [1573]() | `OperacionesCtrl::Empleados_Obtener()` | Get employee records |
| `API_EmpleadosGetAjax` | [1593]() | `OperacionesCtrl::Empleados_ObtenerAjax()` | Get employees for AJAX/DataTables |
| `API_EmpleadosHelperAdd` | [1603]() | `OperacionesCtrl::mnguserAdd_Helper()` | Add employee helper record |
| `API_EmpleadosGetAnexos` | [1624]() | `OperacionesCtrl::Empleados_ObtenerFilesAjax()` | Get employee attachments |
| `API_EmpleadosClaveAsignadaAdmin` | [1645]() | `OperacionesCtrl::Empleados_NuevaClaveAjax()` | Assign admin password to employee |

Sources: [src/ctrls/IndexCtrl.php:445-555](), [src/ctrls/IndexCtrl.php:1523-1655]()

---

### User Management

| Constant | MD5 Check Line | Handler Method | Purpose |
|----------|---------------|----------------|---------|
| `API_UsuariosAdd` | [1658]() | `OperacionesCtrl::usuarios_Agregar()` | Create new user |
| `API_UsuariosHelperMod` | [1668]() | `OperacionesCtrl::usuarios_Helper_Modificar()` | Modify user helper data |
| `API_UsuariosMod` | [1678]() | `OperacionesCtrl::usuarios_Modificar()` | Modify user data |
| `API_UsuariosRm` | [1688]() | `OperacionesCtrl::usuarios_Eliminar()` | Remove/deactivate user |
| `API_UsuariosHelperGet` | [1698]() | `OperacionesCtrl::usuarios_Helper_Obtener()` | Get user helper data |
| `API_UsuariosGet` | [1708]() | `OperacionesCtrl::usuarios_Obtener()` | Get user records |
| `API_UsuariosGetAjax` | [1718]() | `OperacionesCtrl::usuarios_ObtenerAjax()` | Get users for AJAX/DataTables |
| `API_AdminHelperAdd` | [1728]() | `OperacionesCtrl::mnguserAdd_Helper()` | Add admin helper record |
| `API_UsuariosMiniAdd` | [1738]() | `OperacionesCtrl::usuarios_Helper_AgregarMini()` | Add minimal user record |
| `API_UsuariosClaveAsignadaAdmin` | [1748]() | `OperacionesCtrl::usuarios_NuevaClaveAjax()` | Assign admin password to user |

Sources: [src/ctrls/IndexCtrl.php:565-656](), [src/ctrls/IndexCtrl.php:1658-1767]()

---

### Templates and Documents

| Constant | MD5 Check Line | Handler Method | Purpose |
|----------|---------------|----------------|---------|
| `API_plantillasAdd` | [1857]() | `OperacionesCtrl::editarPlantillas_Agregar()` | Add/update template |
| `API_plantillasNew` | [1867]() | `OperacionesCtrl::editarPlantillas_Nuevo()` | Create new template |
| `API_plantillasDel` | [1877]() | `OperacionesCtrl::editarPlantillas_Eliminar()` | Delete template |
| `API_plantillasMixAdd` | [1887]() | `OperacionesCtrl::editarPlantillas_Mezclar_Agregar()` | Add template mix |
| `API_plantillasMixGet` | [1897]() | `OperacionesCtrl::editarPlantillas_Mezclar_Obtener()` | Get template mix |
| `API_plantillasMixSend` | [1907]() | `OperacionesCtrl::editarPlantillas_Mezclar_Enviar()` | Send template mix |
| `API_plantillasMixVariablesHelperGet` | [1917]() | `OperacionesCtrl::editarPlantillas_JBB_Variables_Helper_Obtener()` | Get template variables |

Sources: [src/ctrls/IndexCtrl.php:755-810](), [src/ctrls/IndexCtrl.php:1857-1927]()

---

### Digital Signatures

| Constant | MD5 Check Line | Handler Method | Purpose |
|----------|---------------|----------------|---------|
| `API_FirmasGet` | [1931]() | `OperacionesCtrl::firmaspro_Helper_Obtener()` | Get signature records |
| `API_FirmasPreviaGet` | [1942]() | `OperacionesCtrl::firmaspro_Preview_Obtener()` | Get signature preview |
| `API_FirmasAgregarConfigCorp_Add` | [1952]() | `OperacionesCtrl::firmaspro_Config_Page_Agregar()` | Add signature config |
| `API_FirmasAgregarConfigCorp_Get` | [1962]() | `OperacionesCtrl::firmaspro_Config_Page_Obtener()` | Get signature config |
| `API_FirmasproHelperAdd` | [1973]() | `OperacionesCtrl::firmaspro_Helper_FirmarDoc()` | Sign document |
| `API_FirmasproAdminP12Add` | [1983]() | `OperacionesCtrl::firmaspro_Helper_Admin_MkCert_p12()` | Add P12 certificate |
| `API_FirmaslogHelperEvent` | [1996]() | `OperacionesCtrl::firmaspro_Helper_EventsObtener()` | Get signature events log |
| `API_FirmascomentariosHelperGet` | [2010]() | `OperacionesCtrl::firmascomentarios_Helper_Obtener()` | Get signature comments |
| `API_FirmascomentariosHelperAdd` | [2020]() | `OperacionesCtrl::firmascomentarios_Helper_Agregar()` | Add signature comment |
| `API_FirmascomentariosHelperDel` | [2030]() | `OperacionesCtrl::firmascomentarios_Helper_Eliminar()` | Delete signature comment |

Sources: [src/ctrls/IndexCtrl.php:821-890](), [src/ctrls/IndexCtrl.php:1931-2040]()

---

### Workflow Management

| Constant | MD5 Check Line | Handler Method | Purpose |
|----------|---------------|----------------|---------|
| `API_FlujosHelperAdd` | [2156]() | `OperacionesCtrl::flujos_Helper_Agregar()` | Add workflow |
| `API_FlujosHelperEstadoMod` | [2146]() | `OperacionesCtrl::flujos_Estados_Helper_Modificar()` | Modify workflow status |
| `API_FlujosGetAjax` | [2166]() | `OperacionesCtrl::flujos_Obtener_Ajax()` | Get workflows for AJAX |
| `API_FlujositemsPrincipalHelperGet` | [2179]() | `OperacionesCtrl::flujositems_Pricipal_Helper_Obtener()` | Get main workflow items |
| `API_FlujositemsGet` | [2189]() | `OperacionesCtrl::flujositems_Obtener()` | Get workflow items |
| `API_FlujositemsHelperGet` | [2199]() | `OperacionesCtrl::flujositems_Helper_Obtener()` | Get workflow items helper |
| `API_FlujositemsHelperDel` | [2209]() | `OperacionesCtrl::flujositems_Helper_Eliminar()` | Delete workflow item |
| `API_FlujositemsRevDtGet` | [2219]() | `OperacionesCtrl::flujositems_Helper_ObtenerRevisorData()` | Get reviewer data |

Sources: [src/ctrls/IndexCtrl.php:957-1024](), [src/ctrls/IndexCtrl.php:2146-2228]()

---

### Package Management

| Constant | MD5 Check Line | Handler Method | Purpose |
|----------|---------------|----------------|---------|
| `API_PaquetesGetAjax` | [2242]() | `OperacionesCtrl::paquetes_Obtener_Ajax()` | Get packages for AJAX |
| `API_PaquetesHelperGetAjax` | [2252]() | `OperacionesCtrl::paquetes_Helper_Obtener_Ajax()` | Get package helper data |
| `API_PaquetesHelperMoveReview` | [2262]() | `OperacionesCtrl::paquetes_Helper_MoverRevisar()` | Move package to review |
| `API_PaquetesHelperMoveAdmin` | [2272]() | `OperacionesCtrl::paquetes_Helper_MoverAdmin()` | Move package to admin |
| `API_PaquetesHomeHelperAdd` | [2232]() | `OperacionesCtrl::paquetes_Home_Helper_Agregar()` | Add package from home |
| `API_PaquetesAdminReg_Helper_Add` | [2386]() | `OperacionesCtrl::paquetesAdminReg_Helper_Agregar()` | Add admin registration package |
| `API_PaquetesrequHelperAdd` | [2285]() | `OperacionesCtrl::paquetesrequ_Helper_Agregar()` | Add package requirement |
| `API_PaquetesreqcomentariosHelperGet` | [2317]() | `OperacionesCtrl::paquetesreqcomentarios_Helper_Obtener()` | Get package comments |
| `API_PaquetesreqcomentariosHelperAdd` | [2327]() | `OperacionesCtrl::paquetesreqcomentarios_Helper_Agregar()` | Add package comment |
| `API_PaquetesreqcomentariosHelperDel` | [2337]() | `OperacionesCtrl::paquetesreqcomentarios_Helper_Eliminar()` | Delete package comment |

Sources: [src/ctrls/IndexCtrl.php:1035-1084](), [src/ctrls/IndexCtrl.php:2232-2347]()

---

### Forms and Requirements

| Constant | MD5 Check Line | Handler Method | Purpose |
|----------|---------------|----------------|---------|
| `API_FormulariosGetAjax` | [2411]() | `OperacionesCtrl::formularios_Obtener_Ajax()` | Get forms for AJAX |
| `API_FormulariosHelperAdd` | [2421]() | `OperacionesCtrl::formularios_Helper_Agregar()` | Add form |
| `API_FormulariosHelperDel` | [2411-2420]() | Referenced but not shown | Delete form |
| `API_FormulariosGet` | [2431]() | `OperacionesCtrl::formularios_Obtener()` | Get form records |
| `API_RequerimientostplsGetAjax` | [2113]() | `OperacionesCtrl::requerimientostpls_Obtener_Ajax()` | Get requirement templates |
| `API_RequerimientosHelperAdd` | [2123]() | `OperacionesCtrl::requerimientostpls_Helper_Agregar()` | Add requirement |
| `API_RequerimientostplsitemsHelperGet` | [2133]() | `OperacionesCtrl::requerimientostplsitems_Helper_Obtener()` | Get requirement items |

Sources: [src/ctrls/IndexCtrl.php:924-946](), [src/ctrls/IndexCtrl.php:1118-1146](), [src/ctrls/IndexCtrl.php:2113-2143](), [src/ctrls/IndexCtrl.php:2411-2441]()

---

### Home Portal Operations

These endpoints support the public-facing home portal with different authentication requirements:

| Constant | MD5 Check Line | Handler Method | Purpose |
|----------|---------------|----------------|---------|
| `API_Home_RecuperaUsuario` | [2517]() | `OperacionesCtrl::home_Login_Get()` | Recover user account |
| `API_Home_SolicitarTkn` | [2527]() | `OperacionesCtrl::home_RecuToken_Get()` | Request recovery token |
| `API_Home_Login` | [2537]() | `OperacionesCtrl::home_Start_Get()` | Home portal login |
| `API_Home_LoginAs` | [2547]() | `OperacionesCtrl::home_LoginAs_Get()` | Login as another user |
| `API_MiPerfilHomeGet` | [2557]() | `OperacionesCtrl::home_Perfil_Get()` | Get user profile from home |
| `API_Home_AlumnoPassAdd` | [2567]() | `OperacionesCtrl::home_AlumnoPass_Add()` | Add student password |
| `API_ContrasenaHome` | [2577]() | `OperacionesCtrl::cambioClave_Home_Add()` | Change password from home |
| `API_Home_Empleado_Registro` | [2588]() | `OperacionesCtrl::home_Empleado_Registro()` | Employee registration from home |

Sources: [src/ctrls/IndexCtrl.php:1199-1263](), [src/ctrls/IndexCtrl.php:2517-2595]()

---

### Activation Codes and API Tokens

| Constant | MD5 Check Line | Handler Method | Purpose |
|----------|---------------|----------------|---------|
| `API_CodigoactivaGet` | [1785]() | `OperacionesCtrl::codigoactiva_Get()` | Validate activation code |
| `API_CodigoactivaAdd` | [1795]() | `OperacionesCtrl::codigoactiva_Add()` | Generate activation code |
| `API_CodigoactivaJson64Add` | [1805]() | `OperacionesCtrl::codigoactivaHelperJson64_Add()` | Add code with JSON64 data |
| `API_ApiboxGet` | [2043]() | `OperacionesCtrl::apibox_Obtener()` | Get API box tokens |

Sources: [src/ctrls/IndexCtrl.php:690-709](), [src/ctrls/IndexCtrl.php:902-902](), [src/ctrls/IndexCtrl.php:1785-2053]()

---

## Endpoint Pattern Examples

### CRUD Operations Pattern

Most entity management follows a consistent CRUD pattern. Here's the employee endpoints as an example:

```mermaid
graph TB
    subgraph "Employee CRUD Endpoints"
        ADD["API_EmpleadosAdd<br/>Line 1523<br/>POST ajax=md5('API_EmpleadosAdd')"]
        MOD["API_EmpleadosMod<br/>Line 1533<br/>POST ajax=md5('API_EmpleadosMod')"]
        RM["API_EmpleadosRm<br/>Line 1543<br/>POST ajax=md5('API_EmpleadosRm')"]
        GET["API_EmpleadosGet<br/>Line 1573<br/>POST ajax=md5('API_EmpleadosGet')"]
        GETAJAX["API_EmpleadosGetAjax<br/>Line 1593<br/>POST ajax=md5('API_EmpleadosGetAjax')"]
    end
    
    subgraph "OperacionesCtrl Methods"
        AGRE["Empleados_Agregar()"]
        MODI["Empleados_Helper_Modificar()"]
        ELIM["Empleados_Eliminar()"]
        OBTE["Empleados_Obtener()"]
        AJAX["Empleados_ObtenerAjax()"]
    end
    
    ADD --> AGRE
    MOD --> MODI
    RM --> ELIM
    GET --> OBTE
    GETAJAX --> AJAX
```

Sources: [src/ctrls/IndexCtrl.php:445-512](), [src/ctrls/IndexCtrl.php:1523-1602]()

---

### Helper Pattern

Many endpoints use a "Helper" suffix to indicate auxiliary or supporting operations:

```mermaid
graph LR
    subgraph "Main Operations"
        MAIN1["API_EmpleadosGet"]
        MAIN2["API_FlujosGetAjax"]
        MAIN3["API_PaquetesGetAjax"]
    end
    
    subgraph "Helper Operations"
        HELP1["API_EmpleadosHelperGet<br/>Auxiliary employee data"]
        HELP2["API_FlujositemsHelperGet<br/>Workflow items helper"]
        HELP3["API_PaquetesHelperGetAjax<br/>Package helper data"]
    end
    
    MAIN1 -.->|supports| HELP1
    MAIN2 -.->|supports| HELP2
    MAIN3 -.->|supports| HELP3
```

Sources: [src/ctrls/IndexCtrl.php:481-521](), [src/ctrls/IndexCtrl.php:1005-1044]()

---

## Error Handling

All AJAX endpoints implement consistent error handling with specific HTTP status codes and error response format.

### Error Response Structure

When an exception occurs, endpoints return:

```json
{
  "err": "Error message describing what went wrong"
}
```

The HTTP response code is set using `http_response_code()` before throwing the exception.

### Standard Error Codes

| Error Code | Constant | Meaning |
|------------|----------|---------|
| 520 | `ERR_COD_SIN_PRIVILEGIOS` | User lacks sufficient privileges |
| 521 | `ERR_COD_USUARIO_NO_EXISTE_BY_ID` | User ID does not exist |
| 522 | `ERR_COD_ENVIO_MAIL_FALLIDO` | Email sending failed |
| 523 | `ERR_COD_CAMBIO_CLAVE_FALLIDO` | Password change failed |
| 524 | `ERR_COD_CAMPO_OBLIGATORIO` | Required field missing |
| 529 | `ERR_COD_SESION_INACTIVA` | Session inactive |
| 530 | `ERR_COD_MSJ_ERR_COMUN` | Common insertion error |
| 535 | `ERR_COD_USUARIO_O_CLAVE_INVALIDA` | Invalid user or password |
| 536 | `ERR_COD_PLANTILLA_NO_SALVADA` | Template not saved |
| 537 | `ERR_COD_REGISTRO_EXISTENTE` | Duplicate record exists |
| 538 | `ERR_COD_ACTUALIZACION_SQL` | SQL update error |
| 538 | `ERR_COD_ELIMINACION_SQL` | SQL deletion error |
| 539 | `ERR_COD_RESPUESTA_SQL_VACIA` | Empty SQL response |

Sources: [src/ctrls/IndexCtrl.php:82-277]()

### Error Handling Flow

```mermaid
graph TD
    A["Endpoint receives request"] --> B["Try block starts"]
    B --> C["Call OperacionesCtrl method"]
    C --> D{"Success?"}
    D -->|Yes| E["Prepare ok_array"]
    D -->|No| F["Catch Exception"]
    F --> G["Set http_response_code()"]
    G --> H["Prepare err_array"]
    E --> I["echo json_encode()"]
    H --> I
    I --> J["die() - terminate execution"]
```

Sources: [src/ctrls/IndexCtrl.php:1523-1562]()

---

## Session Management and Security

### Session Validation

Before processing any AJAX request, the constructor performs session validation:

```mermaid
graph TD
    A["Request arrives"] --> B{"Session exists?"}
    B -->|No| C["Start session"]
    B -->|Yes| D{"User object in session?"}
    D -->|Yes| E{"User estado_id > 1?"}
    E -->|Yes| F["Logout user"]
    F --> G["Alert: 'Usuario inactivo'"]
    G --> H["Redirect to index.php"]
    E -->|No| I["Check URL consistency"]
    D -->|No| I
    I --> J{"URL matches session URL?"}
    J -->|No| K["Logout + Redirect"]
    J -->|Yes| L["Process AJAX request"]
```

Sources: [src/ctrls/IndexCtrl.php:1308-1348]()

### Authentication Requirement Bypass

Some endpoints can bypass authentication requirement using `OperacionesCtrl::authRequOff()`:

| Endpoint | Line | Purpose |
|----------|------|---------|
| `API_EmpleadosHelperOffAuthAdd` | [1614]() | Add employee without auth (external registration) |
| `API_EmpleadosGetAnexos` | [1626]() | Get employee attachments (public access) |

Sources: [src/ctrls/IndexCtrl.php:1613-1633]()

---

## File Download Endpoints

Some special endpoints handle file downloads via the `ajaxl` parameter instead of `ajax`:

```mermaid
graph LR
    subgraph "Download Endpoints"
        CSV["API_LNK_DESCARGAR_ALUMNOS<br/>Employee CSV Download"]
        PDF["API_LNK_DESCARGAR_PDF<br/>PDF Document Download"]
        PROC["API_LNK_VISTA_PDF_PROC<br/>Process PDF View"]
        CERT["API_LNK_DESCARGAR_CERTIFICADOS<br/>Certificate Download"]
    end
    
    subgraph "Actions"
        GENCSV["Generate CSV file<br/>Set headers<br/>Echo content"]
        MASK["Create masked URL<br/>Serve file directly"]
    end
    
    CSV --> GENCSV
    PDF --> MASK
    PROC --> MASK
```

Sources: [src/ctrls/IndexCtrl.php:314-342](), [src/ctrls/IndexCtrl.php:1350-1387]()

---

## Complete Endpoint Reference by Category

### Authentication & System

```mermaid
graph TB
    subgraph "IndexCtrl Constants"
        C1["API_AgregarConfigCorp"]
        C2["API_IniciarLoginAsOtro"]
        C3["API_LoginSystemAjax"]
        C4["API_RecuperarSisClave"]
        C5["API_TamanoUsoGet"]
        C6["API_SESSION_ACTIVA"]
    end
    
    subgraph "OperacionesCtrl Methods"
        M1["EscribirConfig()"]
        M2["Session manipulation"]
        M3["AutenticaUsuarioSisAjaxB64()"]
        M4["sistema_recuperarClave_Get()"]
        M5["sistema_Tamano_Get()"]
        M6["Check session status"]
    end
    
    C1 --> M1
    C2 --> M2
    C3 --> M3
    C4 --> M4
    C5 --> M5
    C6 --> M6
```

Sources: [src/ctrls/IndexCtrl.php:357-412](), [src/ctrls/IndexCtrl.php:1411-1497]()

---

### Data Upload and Processing

| Constant | Purpose | Handler Method |
|----------|---------|----------------|
| `API_UpFotoPerfiles` | Upload profile photos | `OperacionesCtrl::SubirFotoPerfil()` |
| `API_Cargadatos_Upload` | Bulk data upload | `OperacionesCtrl::usuarios_CargaDatos_Upload()` |
| `API_Bogdata_Consultar` | Query Bogdata service | `OperacionesCtrl::empleados_Procesar_Archivos()` |

Sources: [src/ctrls/IndexCtrl.php:743-676](), [src/ctrls/IndexCtrl.php:1844-2510]()

---

### Configuration and Lists

| Constant | Purpose | Handler Method |
|----------|---------|----------------|
| `API_ObtenerLugares` | Get location list | `OperacionesCtrl::lugares_Obtener()` |
| `API_ObtenerTutores` | Get tutors list | `OperacionesCtrl::usuarios_Obtener()` |
| `API_AnyolectivoAdd` | Add academic year | `OperacionesCtrl::anyolectivo_Add_Helper()` |
| `API_ReflistaGet` | Get reference list | `OperacionesCtrl::reflista_Obtener()` |

Sources: [src/ctrls/IndexCtrl.php:382-392](), [src/ctrls/IndexCtrl.php:730-732](), [src/ctrls/IndexCtrl.php:1106-1107](), [src/ctrls/IndexCtrl.php:1453-1841]()

---

### Deductions Management

| Constant | Line | Handler Method | Purpose |
|----------|------|----------------|---------|
| `API_DeduccionesHelperAdd` | [2056]() | `deducciones_Helper_Agregar()` | Add deduction |
| `API_DeduccionesVirtualAdd` | [2069]() | `deducciones_Config_Agregar()` | Add virtual deduction config |
| `API_DeduccionesVirtualGet` | [2079]() | `deducciones_Config_Obtener()` | Get virtual deductions |
| `API_DeduccionesVirtualGetAjax` | [2089]() | `deducciones_Config_Obtener_Ajax()` | Get deductions for AJAX |
| `API_DeduccionesVirtualDel` | [2100]() | `deducciones_Config_Eliminar()` | Delete virtual deduction |

Sources: [src/ctrls/IndexCtrl.php:905-913](), [src/ctrls/IndexCtrl.php:2056-2110]()

---

### Support and Comments

| Constant | Purpose | Handler Method |
|----------|---------|----------------|
| `API_ApoyosGet` | Get support records | `OperacionesCtrl::apoyos_Obtener()` |
| `API_ApooyosHelperAdd` | Add support record | `OperacionesCtrl::apoyos_Helper_Agregar()` |
| `API_ApoyosDel` | Delete support record | `OperacionesCtrl::apoyos_Eliminar()` |
| `API_ComentariosVirtual_Helper_Add` | Add virtual comment | `OperacionesCtrl::comentarios_Virtual_Helper_Agregar()` |

Sources: [src/ctrls/IndexCtrl.php:1092-1095](), [src/ctrls/IndexCtrl.php:1078-1079](), [src/ctrls/IndexCtrl.php:2304-2384]()

---

### Employee Contract Details

| Constant | Purpose | Handler Method |
|----------|---------|----------------|
| `API_empleadosdetallescontrato_Get` | Get contract details | `OperacionesCtrl::empleadosdetallescontrato_Obtener()` |
| `API_empleadosdetallescontrato_Helper_Add` | Add contract details | `OperacionesCtrl::empleadosdetallescontrato_Helper_Agregar()` |

Sources: [src/ctrls/IndexCtrl.php:1157-1167](), [src/ctrls/IndexCtrl.php:2453-2473]()

---

## Implementation Notes

### MD5 Hash Generation

The client-side must generate the MD5 hash of the exact constant name string:

```javascript
// Client-side example (JavaScript)
const endpoint = 'API_EmpleadosAdd';
const hash = md5(endpoint);  // Using an MD5 library

// Send POST request
fetch('index.php', {
    method: 'POST',
    body: new URLSearchParams({
        ajax: hash,
        // ... other parameters
    })
});
```

### Response Termination

All AJAX endpoints terminate execution with `die("")` after sending the JSON response to prevent additional HTML output:

```php
echo json_encode($ok);
die("");
```

This ensures clean JSON responses without trailing HTML from the page rendering logic.

Sources: [src/ctrls/IndexCtrl.php:1530-1532]()

---

### Try-Catch Pattern

Every endpoint wraps the business logic call in a try-catch block:

```php
if ($_POST["ajax"] == md5(self::API_EmpleadosAdd)) {
    try {
        $ok = OperacionesCtrl::Empleados_Agregar($_POST);
        echo json_encode($ok);
    } catch (Exception $ex) {
        $er = array("err" => $ex->getMessage());
        echo json_encode($er);
    }
    die("");
}
```

Sources: [src/ctrls/IndexCtrl.php:1523-1532]()

---

## Endpoint Organization Summary

The AJAX API provides comprehensive coverage of system functionality through approximately 120+ endpoints organized into:

- **11 major functional categories** (Authentication, Employees, Users, Templates, etc.)
- **Consistent naming conventions** (Add/Mod/Rm/Get suffixes, Helper prefix)
- **Standardized error handling** with specific HTTP status codes
- **Session-based security** with automatic validation
- **MD5 hash-based routing** for endpoint obfuscation

For detailed business logic implementations of these endpoints, refer to [OperacionesCtrl - Core Operations](#4.1).

Sources: [src/ctrls/IndexCtrl.php:1-3050]()

---

---

## 9.3 User Management APIs

This page documents the API endpoints for managing users and employees in the GESFINANCIERO system. It covers CRUD operations, account activation, password management, authentication, and helper functions for user and employee entities.

For general REST API authentication and token management, see [Token Management](#10.2). For AJAX endpoint patterns and general API structure, see [AJAX API Endpoints](#9.2). For document and workflow-related operations, see [Document and Workflow APIs](#9.4).

## Overview

The system provides two parallel sets of APIs for managing personnel:

- **Employee APIs (`Empleados*`)**: Manage employee records with full profile information, contract details, and attachments
- **User APIs (`Usuarios*`)**: Manage user accounts with authentication credentials, roles, and system access

Both API sets follow similar patterns for CRUD operations and share common authentication requirements. All endpoints are routed through [src/ctrls/IndexCtrl.php:1308-2592]() with business logic implemented in [src/ctrls/OperacionesCtrl.php]().

## API Endpoint Structure

```mermaid
graph TB
    subgraph "Entry Point"
        INDEX["index.php<br/>Main Entry"]
    end
    
    subgraph "IndexCtrl - API Router"
        CONSTRUCTOR["IndexCtrl::__construct()<br/>Lines 1308-2592"]
        
        subgraph "Employee Endpoints"
            EMP_ADD["API_EmpleadosAdd<br/>Line 1523"]
            EMP_MOD["API_EmpleadosMod<br/>Line 1533"]
            EMP_RM["API_EmpleadosRm<br/>Line 1543"]
            EMP_ACT["API_EmpleadosActivar<br/>Line 1553"]
            EMP_GET["API_EmpleadosGet<br/>Line 1573"]
            EMP_GETAJAX["API_EmpleadosGetAjax<br/>Line 1593"]
            EMP_HELPER["API_EmpleadosHelperGet<br/>Line 1563"]
            EMP_PASS["API_EmpleadosClaveAsignadaAdmin<br/>Line 1645"]
        end
        
        subgraph "User Endpoints"
            USR_ADD["API_UsuariosAdd<br/>Line 1658"]
            USR_MOD["API_UsuariosMod<br/>Line 1678"]
            USR_RM["API_UsuariosRm<br/>Line 1688"]
            USR_GET["API_UsuariosGet<br/>Line 1708"]
            USR_GETAJAX["API_UsuariosGetAjax<br/>Line 1718"]
            USR_HELPER["API_UsuariosHelperGet<br/>Line 1698"]
            USR_PASS["API_UsuariosClaveAsignadaAdmin<br/>Line 1748"]
        end
        
        subgraph "Auth & Password"
            AUTH_LOGIN["API_LoginSystemAjax<br/>Line 1441"]
            AUTH_RECOVER["API_RecuperarSisClave<br/>Line 1487"]
            AUTH_CHANGE["API_Contrasena<br/>Line 1818"]
        end
    end
    
    subgraph "OperacionesCtrl - Business Logic"
        OP_EMP["Empleados_* methods"]
        OP_USR["usuarios_* methods"]
        OP_AUTH["Authentication methods"]
    end
    
    INDEX --> CONSTRUCTOR
    CONSTRUCTOR --> EMP_ADD
    CONSTRUCTOR --> USR_ADD
    CONSTRUCTOR --> AUTH_LOGIN
    
    EMP_ADD --> OP_EMP
    USR_ADD --> OP_USR
    AUTH_LOGIN --> OP_AUTH
```

**Sources:** [src/ctrls/IndexCtrl.php:1308-2592]()

## Complete API Endpoint Reference

### Employee Management Endpoints

| Endpoint Constant | Purpose | HTTP Method | Route Handler | Implementation |
|------------------|---------|-------------|---------------|----------------|
| `API_EmpleadosAdd` | Create new employee | POST | Line 1523 | `OperacionesCtrl::Empleados_Agregar()` |
| `API_EmpleadosMod` | Modify employee data | POST | Line 1533 | `OperacionesCtrl::Empleados_Helper_Modificar()` |
| `API_EmpleadosRm` | Delete/deactivate employee | POST | Line 1543 | `OperacionesCtrl::Empleados_Eliminar()` |
| `API_EmpleadosActivar` | Activate employee account | POST | Line 1553 | `OperacionesCtrl::Empleados_Activar()` |
| `API_EmpleadosGet` | Get employee records | POST | Line 1573 | `OperacionesCtrl::Empleados_Obtener()` |
| `API_EmpleadosGetAjax` | Get employees for DataTables | POST | Line 1593 | `OperacionesCtrl::Empleados_ObtenerAjax()` |
| `API_EmpleadosHelperGet` | Get employee helper data | POST | Line 1563 | `OperacionesCtrl::Empleados_Helper_Obtener()` |
| `API_EmpleadosHomeHelperGet` | Get employee home data | POST | Line 1583 | `OperacionesCtrl::Empleados_Home_Helper_Obtener()` |
| `API_EmpleadosHelperAdd` | Add employee with profile | POST | Line 1603 | `OperacionesCtrl::mnguserAdd_Helper()` |
| `API_EmpleadosHelperOffAuthAdd` | Add employee without auth | POST | Line 1613 | `OperacionesCtrl::mnguserAdd_Helper()` |
| `API_EmpleadosGetAnexos` | Get employee attachments | POST | Line 1624 | `OperacionesCtrl::Empleados_ObtenerFilesAjax()` |
| `API_EmpleadosClaveAsignadaAdminManual` | Manually assign password | POST | Line 1635 | `OperacionesCtrl::Empleados_NuevaClaveAjax()` |
| `API_EmpleadosClaveAsignadaAdmin` | Auto-assign password | POST | Line 1645 | `OperacionesCtrl::Empleados_NuevaClaveAjax()` |

**Sources:** [src/ctrls/IndexCtrl.php:445-555](), [src/ctrls/IndexCtrl.php:1522-1655]()

### User Management Endpoints

| Endpoint Constant | Purpose | HTTP Method | Route Handler | Implementation |
|------------------|---------|-------------|---------------|----------------|
| `API_UsuariosAdd` | Create new user | POST | Line 1658 | `OperacionesCtrl::usuarios_Agregar()` |
| `API_UsuariosMod` | Modify user data | POST | Line 1678 | `OperacionesCtrl::usuarios_Modificar()` |
| `API_UsuariosHelperMod` | Helper modify user | POST | Line 1668 | `OperacionesCtrl::usuarios_Helper_Modificar()` |
| `API_UsuariosRm` | Delete/deactivate user | POST | Line 1688 | `OperacionesCtrl::usuarios_Eliminar()` |
| `API_UsuariosGet` | Get user records | POST | Line 1708 | `OperacionesCtrl::usuarios_Obtener()` |
| `API_UsuariosGetAjax` | Get users for DataTables | POST | Line 1718 | `OperacionesCtrl::usuarios_ObtenerAjax()` |
| `API_UsuariosHelperGet` | Get user helper data | POST | Line 1698 | `OperacionesCtrl::usuarios_Helper_Obtener()` |
| `API_AdminHelperAdd` | Add admin user | POST | Line 1728 | `OperacionesCtrl::mnguserAdd_Helper()` |
| `API_UsuariosMiniAdd` | Add minimal user (provider) | POST | Line 1738 | `OperacionesCtrl::usuarios_Helper_AgregarMini()` |
| `API_UsuariosClaveAsignadaAdmin` | Auto-assign password | POST | Line 1748 | `OperacionesCtrl::usuarios_NuevaClaveAjax()` |
| `API_UsuariosClaveAsignadaAdminManual` | Manually assign password | POST | Line 1758 | `OperacionesCtrl::usuarios_NuevaClaveAjax()` |

**Sources:** [src/ctrls/IndexCtrl.php:566-656](), [src/ctrls/IndexCtrl.php:1657-1767]()

### Authentication & Password Management

| Endpoint Constant | Purpose | HTTP Method | Route Handler | Implementation |
|------------------|---------|-------------|---------------|----------------|
| `API_LoginSystemAjax` | User login with credentials | POST | Line 1441 | `OperacionesCtrl::AutenticaUsuarioSisAjaxB64()` |
| `API_RecuperarSisClave` | Password recovery request | POST | Line 1487 | `OperacionesCtrl::sistema_recuperarClave_Get()` |
| `API_Contrasena` | Change user password | POST | Line 1818 | `OperacionesCtrl::cambioClave_Add()` |
| `API_IniciarLoginAsOtro` | Login as another user | POST | Line 1422 | Session manipulation |

**Sources:** [src/ctrls/IndexCtrl.php:373-412](), [src/ctrls/IndexCtrl.php:1441-1827]()

## Request Flow Architecture

### Standard CRUD Request Flow

```mermaid
sequenceDiagram
    participant Client
    participant IndexCtrl
    participant OperacionesCtrl
    participant Singleton
    participant DB as MySQL Database
    
    Client->>IndexCtrl: POST /index.php<br/>ajax=md5(API_Constant)<br/>+ data parameters
    
    IndexCtrl->>IndexCtrl: __construct() validates<br/>session & routing
    
    alt Session Check
        IndexCtrl->>IndexCtrl: Check $_SESSION["usu"]<br/>Verify estado_id <= 1
    end
    
    IndexCtrl->>IndexCtrl: Match md5(ajax) to<br/>API constant
    
    IndexCtrl->>OperacionesCtrl: Call business logic<br/>method with $_POST
    
    OperacionesCtrl->>OperacionesCtrl: Validate parameters<br/>Check permissions
    
    OperacionesCtrl->>Singleton: Execute database query<br/>_readInfo / _safeUpdate
    
    Singleton->>DB: SQL query execution
    DB-->>Singleton: Result set
    
    Singleton-->>OperacionesCtrl: Data array
    
    OperacionesCtrl-->>IndexCtrl: Return array with<br/>"ok" or "err"
    
    IndexCtrl->>Client: echo json_encode($result)<br/>die()
```

**Sources:** [src/ctrls/IndexCtrl.php:1308-1400](), [src/ctrls/IndexCtrl.php:1401-2592]()

### Authentication Flow

```mermaid
sequenceDiagram
    participant Client
    participant IndexCtrl
    participant OperacionesCtrl
    participant Singleton
    participant DB
    participant Session
    
    Client->>IndexCtrl: POST ajax=md5(API_LoginSystemAjax)<br/>params=base64(JSON)
    
    IndexCtrl->>OperacionesCtrl: AutenticaUsuarioSisAjaxB64($_POST)
    
    OperacionesCtrl->>OperacionesCtrl: base64_decode(params)<br/>json_decode()
    
    alt Session-based Auth
        OperacionesCtrl->>OperacionesCtrl: Check qlgn_sesion flag
        OperacionesCtrl->>Session: Seguridad::loginAdmin(u, c)
        Session-->>OperacionesCtrl: true/false
    end
    
    alt Direct Auth
        OperacionesCtrl->>OperacionesCtrl: AutenticaUsuarioSisAjax(u, c)
        OperacionesCtrl->>Singleton: _readInfoChar("usuarios")<br/>WHERE (mail/usuario) AND clave=md5()
        Singleton->>DB: SELECT * FROM usuarios
        DB-->>Singleton: User record
        Singleton-->>OperacionesCtrl: User data array
        OperacionesCtrl->>OperacionesCtrl: unset($user["clave"])
    end
    
    OperacionesCtrl-->>IndexCtrl: User data (success) or Exception
    
    IndexCtrl->>Client: JSON response with<br/>user data or error
```

**Sources:** [src/ctrls/IndexCtrl.php:1441-1450](), [src/ctrls/OperacionesCtrl.php:505-534](), [src/ctrls/OperacionesCtrl.php:560-595]()

## User Profile Constants

The system defines several profile/role constants used throughout the user management APIs:

```mermaid
graph LR
    subgraph "Profile Constants - IndexCtrl"
        P1["PERFILES_SUPER_USUARIO = 1"]
        P2["PERFILES_ADMINISTRADOR = 2"]
        P3["PERFILES_SUPERVISOR = 3"]
        P4["PERFILES_CONTRATISTA = 4"]
        P5["PERFILES_ACUDIENTE = 5"]
        P6["PERFILES_FINANCIERO = 6"]
        P7["PERFILES_SUPERVISORADMIN = 7"]
        P8["PERFILES_PROVEEDOR = 8"]
        P9["PERFILES_API = 9"]
        P10["PERFILES_SOPORTE = 10"]
    end
    
    subgraph "Usage in APIs"
        API_AUTH["Token Generation<br/>Requires perfil_id in [1,2,7]"]
        API_USR["User Operations<br/>Profile-based permissions"]
        API_EMP["Employee Operations<br/>Profile-based access"]
    end
    
    P1 --> API_AUTH
    P2 --> API_AUTH
    P7 --> API_AUTH
    
    P1 --> API_USR
    P2 --> API_USR
    P3 --> API_USR
    
    P4 --> API_EMP
    P6 --> API_EMP
```

**Sources:** [src/ctrls/IndexCtrl.php:45-54]()

## Employee Management Operations

### Creating Employees

The employee creation endpoint `API_EmpleadosAdd` routes to `OperacionesCtrl::Empleados_Agregar()`:

**Request Format:**
```javascript
POST /index.php
{
  "ajax": "md5('API_EmpleadosAdd')",
  // Employee data fields
  "documento": "123456789",
  "nombres": "Juan",
  "apellidos": "Pérez",
  "mail": "juan.perez@example.com",
  // Additional fields...
}
```

**Response Format:**
```javascript
{
  "ok": {
    "id": 123,
    "documento": "123456789"
  }
}
// OR on error:
{
  "err": "Error message description"
}
```

**Sources:** [src/ctrls/IndexCtrl.php:1523-1531]()

### Modifying Employees

Two modification endpoints are available:

1. **`API_EmpleadosMod`** - Full employee modification via `Empleados_Helper_Modificar()`
2. Direct field updates using the same pattern

Both follow the update pattern with ID and field changes.

**Sources:** [src/ctrls/IndexCtrl.php:1533-1541]()

### Employee Activation

The `API_EmpleadosActivar` endpoint handles employee account activation and reactivation:

```mermaid
graph TD
    REQUEST["Client: API_EmpleadosActivar<br/>+ empleado_id"]
    
    ROUTE["IndexCtrl routes to<br/>Empleados_Activar()"]
    
    VALIDATE["Validate empleado_id<br/>Check permissions"]
    
    UPDATE["Update empleados table<br/>Set estado_id = 1"]
    
    NOTIFY["Optional: Send activation<br/>notification email"]
    
    RESPONSE["Return success/error"]
    
    REQUEST --> ROUTE
    ROUTE --> VALIDATE
    VALIDATE --> UPDATE
    UPDATE --> NOTIFY
    NOTIFY --> RESPONSE
```

**Sources:** [src/ctrls/IndexCtrl.php:1553-1561]()

### Employee Queries

Multiple query endpoints support different use cases:

| Endpoint | Purpose | Returns |
|----------|---------|---------|
| `API_EmpleadosGet` | Standard employee listing | Filtered employee records |
| `API_EmpleadosGetAjax` | DataTables integration | Paginated, searchable results |
| `API_EmpleadosHelperGet` | Dropdown/form helpers | Simplified employee data |
| `API_EmpleadosHomeHelperGet` | Home page data | Employee summary info |
| `API_EmpleadosGetAnexos` | File attachments | List of employee documents |

**Sources:** [src/ctrls/IndexCtrl.php:1563-1633]()

## User Management Operations

### Creating Users

The user creation process differs based on user type:

```mermaid
graph TB
    subgraph "User Creation Endpoints"
        STD["API_UsuariosAdd<br/>Standard user creation"]
        ADMIN["API_AdminHelperAdd<br/>Admin user creation"]
        MINI["API_UsuariosMiniAdd<br/>Minimal user (provider)"]
    end
    
    subgraph "Business Logic"
        ADD_USR["usuarios_Agregar()<br/>Full user validation"]
        ADD_ADMIN["mnguserAdd_Helper()<br/>PERFIL_ADMINISTRADOR"]
        ADD_MINI["usuarios_Helper_AgregarMini()<br/>PERFIL_PROVEEDOR"]
    end
    
    subgraph "Common Steps"
        VALIDATE["Validate required fields<br/>Check email uniqueness"]
        HASH["Hash password: md5(password)"]
        INSERT["Insert into usuarios table"]
        PROFILE["Assign perfil_id"]
        EMAIL["Optional: Send welcome email"]
    end
    
    STD --> ADD_USR
    ADMIN --> ADD_ADMIN
    MINI --> ADD_MINI
    
    ADD_USR --> VALIDATE
    ADD_ADMIN --> VALIDATE
    ADD_MINI --> VALIDATE
    
    VALIDATE --> HASH
    HASH --> PROFILE
    PROFILE --> INSERT
    INSERT --> EMAIL
```

**Sources:** [src/ctrls/IndexCtrl.php:1658-1746]()

### Modifying Users

User modification supports two patterns:

1. **Full Modification (`API_UsuariosMod`)**: Updates complete user record
2. **Helper Modification (`API_UsuariosHelperMod`)**: Updates specific fields with validation

Both endpoints use MD5-hashed AJAX identifiers and return JSON responses.

**Sources:** [src/ctrls/IndexCtrl.php:1668-1686]()

### User Deletion

The `API_UsuariosRm` endpoint performs soft deletion by updating the `estado_id` field rather than physically removing records:

```javascript
// Typical implementation pattern
usuarios_Eliminar({
  "id": user_id,
  "estado_id": 2  // Inactive/deleted state
})
```

**Sources:** [src/ctrls/IndexCtrl.php:1688-1696]()

## Password Management

### Password Storage

All passwords are stored using MD5 hashing:

- **Storage**: `clave = md5($password)`
- **Authentication**: `WHERE clave = md5($provided_password)`

**Note**: MD5 is considered cryptographically weak. The system uses it for legacy compatibility.

**Sources:** [src/ctrls/OperacionesCtrl.php:567]()

### Password Assignment

Two administrative password assignment endpoints exist:

```mermaid
graph LR
    subgraph "Manual Assignment"
        MANUAL_EMP["API_EmpleadosClaveAsignadaAdminManual"]
        MANUAL_USR["API_UsuariosClaveAsignadaAdminManual"]
    end
    
    subgraph "Auto Assignment"
        AUTO_EMP["API_EmpleadosClaveAsignadaAdmin"]
        AUTO_USR["API_UsuariosClaveAsignadaAdmin"]
    end
    
    subgraph "Implementation"
        IMPL_EMP["Empleados_NuevaClaveAjax()"]
        IMPL_USR["usuarios_NuevaClaveAjax()"]
    end
    
    MANUAL_EMP --> IMPL_EMP
    AUTO_EMP --> IMPL_EMP
    MANUAL_USR --> IMPL_USR
    AUTO_USR --> IMPL_USR
```

**Sources:** [src/ctrls/IndexCtrl.php:1635-1653](), [src/ctrls/IndexCtrl.php:1748-1766]()

### Password Recovery Flow

The password recovery process uses temporary activation codes:

```mermaid
sequenceDiagram
    participant User
    participant Client
    participant API as IndexCtrl
    participant OpCtrl as OperacionesCtrl
    participant DB
    participant Email
    
    User->>Client: Request password reset<br/>Enter email
    
    Client->>API: POST API_RecuperarSisClave<br/>emailactivar=email
    
    API->>OpCtrl: sistema_recuperarClave_Get()
    
    OpCtrl->>OpCtrl: RecuperarByEmailAjax()<br/>Validate email format
    
    OpCtrl->>DB: SELECT FROM usuarios<br/>WHERE mail = email
    
    DB-->>OpCtrl: User record
    
    OpCtrl->>DB: DELETE FROM codigoactiva<br/>WHERE userselecto_id = user.id
    
    OpCtrl->>OpCtrl: Generate 6-digit code<br/>Utiles::nuevoCl(6)
    
    OpCtrl->>DB: INSERT INTO codigoactiva<br/>nombre, userselecto_id, fecha
    
    OpCtrl->>OpCtrl: Load email template<br/>nuevaclave.html
    
    OpCtrl->>Email: enviarCustomEmail()<br/>Send code to user
    
    Email-->>User: Email with temp code
    
    OpCtrl-->>Client: {"ok": "md5(user_id)"}
    
    Note over User,Client: User receives code via email
    
    User->>Client: Enter code + new password
    
    Client->>API: POST with code validation
    
    API->>OpCtrl: RecuAsignarClaveAjax()<br/>codActiva, key, c
    
    OpCtrl->>DB: SELECT FROM codigoactiva<br/>WHERE nombre=code<br/>AND md5(userselecto_id)=key
    
    OpCtrl->>OpCtrl: Check activo=0<br/>Check timestamp < 10 min
    
    OpCtrl->>DB: UPDATE codigoactiva<br/>SET activo=1
    
    OpCtrl->>DB: UPDATE usuarios<br/>SET clave=md5(new_password)
    
    OpCtrl-->>Client: {"ok": true}
    
    Client-->>User: Password reset successful
```

**Sources:** [src/ctrls/OperacionesCtrl.php:952-1035](), [src/ctrls/OperacionesCtrl.php:1062-1126]()

### Code Validation Rules

Temporary activation codes have strict validation:

- **Length**: 6 characters (generated by `Utiles::nuevoCl(6)`)
- **Uniqueness**: Must not exist in `codigoactiva` table
- **Expiration**: 10 minutes from creation timestamp
- **Single Use**: `activo` flag set to 1 after first use
- **Retry Logic**: Up to 20 attempts to generate unique code

**Sources:** [src/ctrls/OperacionesCtrl.php:980-1001](), [src/ctrls/OperacionesCtrl.php:1666-1710]()

## Authentication Mechanism

### Direct Authentication

The `AutenticaUsuarioSisAjax()` method provides credential validation:

```javascript
// Authentication request
{
  "u": "username_or_email",
  "c": "plain_password"
}

// SQL query executed:
// WHERE (mail = 'u' OR usuario = 'u') AND clave = md5('c')
```

**Response:**
- **Success**: User object without `clave` field
- **Failure**: Exception with code `ERR_COD_USUARIO_O_CLAVE_INVALIDA` (535)

**Sources:** [src/ctrls/OperacionesCtrl.php:560-595]()

### MD5-based Authentication

Alternative authentication using pre-computed MD5:

```javascript
// Client computes: md5(username + password)
{
  "u": "md5_hash_of_username_password"
}

// SQL query executed:  
// WHERE md5(concat(usuario, clave)) = 'u'
```

Enabled by setting `md5Met = true` parameter.

**Sources:** [src/ctrls/OperacionesCtrl.php:560-595]()

### Base64 Encoded Authentication

The `API_LoginSystemAjax` endpoint accepts Base64-encoded JSON:

```javascript
// Client sends:
{
  "ajax": "md5('API_LoginSystemAjax')",
  "params": base64_encode(JSON.stringify({
    "qlgn_usuario": "username",
    "qlgn_clave": "password",
    "qlgn_sesion": true  // Optional: use session
  }))
}
```

**Sources:** [src/ctrls/OperacionesCtrl.php:505-534]()

## Authorization and Session Management

### Session Validation

All authenticated requests validate session state in the constructor:

```mermaid
graph TD
    REQUEST["Incoming Request"]
    
    SESSION_CHECK{"$_SESSION['usu']<br/>exists?"}
    
    STATE_CHECK{"usuario->getEstado_id()<br/>> 1?"}
    
    LOGOUT["Seguridad::logout()<br/>Destroy session"]
    
    ALERT["Alert: Usuario inactivo<br/>Redirect to index.php"]
    
    CONTINUE["Continue processing"]
    
    REQUEST --> SESSION_CHECK
    SESSION_CHECK -->|Yes| STATE_CHECK
    SESSION_CHECK -->|No| CONTINUE
    
    STATE_CHECK -->|Yes| LOGOUT
    STATE_CHECK -->|No| CONTINUE
    
    LOGOUT --> ALERT
```

**Sources:** [src/ctrls/IndexCtrl.php:1313-1320]()

### Estado (State) Values

User and employee states control access:

| estado_id | Meaning | Access |
|-----------|---------|--------|
| 1 | Active | Full access granted |
| 2+ | Inactive/Blocked/Deleted | Access denied, session terminated |

**Sources:** [src/ctrls/IndexCtrl.php:1313-1320]()

### URL Verification

Session hijacking protection via URL validation:

```php
if ( isset( $_SESSION["url"] ) ) {
    if ( trim(strtolower( $_SESSION["url"] )) != 
         trim(strtolower( Utiles::getBaseUrl())) ) {
        Seguridad::logout();
        // Redirect to index.php
    }
}
```

**Sources:** [src/ctrls/IndexCtrl.php:1339-1345]()

### Login As Another User

The `API_IniciarLoginAsOtro` endpoint allows privileged users to impersonate others:

```mermaid
sequenceDiagram
    participant Admin
    participant IndexCtrl
    participant DB
    participant Session
    
    Admin->>IndexCtrl: POST API_IniciarLoginAsOtro<br/>as=target_user_id
    
    IndexCtrl->>DB: SELECT FROM usuarios<br/>WHERE id = as
    
    DB-->>IndexCtrl: Target user record
    
    IndexCtrl->>Session: unset($_SESSION["usu"])<br/>session_destroy()
    
    IndexCtrl->>Session: session_start()
    
    IndexCtrl->>Session: $_SESSION["usu"] = target_user<br/>$_SESSION["url"] = base_url
    
    IndexCtrl-->>Admin: Redirect to index.php<br/>as target user
```

**Sources:** [src/ctrls/IndexCtrl.php:1422-1440]()

## Error Handling

### Error Code Constants

The system defines specific error codes for user management operations:

| Constant | Code | Meaning |
|----------|------|---------|
| `ERR_COD_SIN_PRIVILEGIOS` | 520 | Insufficient permissions |
| `ERR_COD_USUARIO_NO_EXISTE_BY_ID` | 521 | User ID not found |
| `ERR_COD_ENVIO_MAIL_FALLIDO` | 522 | Email send failure |
| `ERR_COD_CAMBIO_CLAVE_FALLIDO` | 523 | Password change failed |
| `ERR_COD_CAMPO_OBLIGATORIO` | 524 | Required field missing |
| `ERR_COD_SESION_INACTIVA` | 529 | Session expired/inactive |
| `ERR_COD_MSJ_ERR_COMUN` | 530 | Generic error |
| `ERR_COD_EST_CLAVE_NO_MODIFICADA` | 531 | Password not modified |
| `ERR_COD_CORREO_FAIL` | 532 | Email operation failed |
| `ERR_COD_USUARIO_EXISTE_PERO_SIN_DATOS` | 533 | User exists but no data |
| `ERR_COD_USUARIO_O_CLAVE_INVALIDA` | 535 | Invalid credentials |
| `ERR_COD_REGISTRO_EXISTENTE` | 537 | Duplicate record |
| `ERR_COD_RESPUESTA_SQL_VACIA` | 539 | Empty SQL result |

**Sources:** [src/ctrls/IndexCtrl.php:82-277]()

### Error Response Pattern

All API endpoints follow a consistent error response pattern:

```javascript
// Success response
{
  "ok": {
    // Success data
  }
}

// Error response
{
  "err": "Error message description"
}
```

HTTP status codes are set using `http_response_code()` before throwing exceptions.

**Sources:** [src/ctrls/IndexCtrl.php:1415-1419]()

### Try-Catch Wrapper Pattern

All endpoint handlers use consistent exception handling:

```php
if ($_POST["ajax"] == md5(self::API_CONSTANT)) {
    try {
        $ok = OperacionesCtrl::operation_Method($_POST);
        echo json_encode($ok);
    } catch (Exception $ex) {
        $er = array("err" => $ex->getMessage());
        echo json_encode($er);
    }
    die("");
}
```

**Sources:** [src/ctrls/IndexCtrl.php:1411-1419]()

## Helper Data Endpoints

Several "Helper" endpoints provide ancillary data for forms and UI:

### Employee Helpers

- **`API_EmpleadosHelperGet`**: Returns dropdown options, field configurations
- **`API_EmpleadosHomeHelperGet`**: Provides home page summary data
- **`API_EmpleadosHelperAdd`**: Creates employee with associated user profile

### User Helpers

- **`API_UsuariosHelperGet`**: Returns user form metadata
- **`API_UsuariosHelperMod`**: Modifies users with additional validation
- **`API_AdminHelperAdd`**: Specialized admin creation with elevated permissions

These helpers typically return structured metadata used by frontend forms to configure field visibility, validation rules, and dropdown options.

**Sources:** [src/ctrls/IndexCtrl.php:1563-1592](), [src/ctrls/IndexCtrl.php:1698-1706]()

## Integration with Other Systems

### Profile Photo Upload

User management integrates with photo upload via `API_UpFotoPerfiles`:

```mermaid
graph LR
    USER_FORM["User/Employee Form"]
    UPLOAD_API["API_UpFotoPerfiles"]
    SUBFOLDER["repo/avatar/user_id/"]
    RESIZE["Resize Image"]
    UPDATE_DB["Update usuarios.avatar"]
    
    USER_FORM --> UPLOAD_API
    UPLOAD_API --> SUBFOLDER
    SUBFOLDER --> RESIZE
    RESIZE --> UPDATE_DB
```

**Sources:** [src/ctrls/IndexCtrl.php:1844-1853]()

### Contract Details

Employee management links to contract details via `API_empleadosdetallescontrato_*` endpoints:

- Creates association between employees and contract metadata
- Stores contract terms, dates, and conditions
- Referenced in employee detail views

**Sources:** [src/ctrls/IndexCtrl.php:2453-2473]()

### Email Notifications

User operations trigger email notifications through the templated email system:

- **Welcome emails**: Sent on user creation
- **Password reset**: Uses `nuevaclave.html` template
- **Account activation**: Uses `codigocheck.html` template

**Sources:** [src/ctrls/OperacionesCtrl.php:433-480](), [src/ctrls/OperacionesCtrl.php:1003-1012]()

## Security Considerations

### Password Security Issues

**Current Implementation:**
- Uses MD5 for password hashing (line 567)
- MD5 is cryptographically broken and vulnerable to rainbow table attacks
- No salt is applied to passwords

**Recommendation:** Migrate to bcrypt or Argon2 for production systems.

**Sources:** [src/ctrls/OperacionesCtrl.php:567]()

### Session Security

**Protections in place:**
- Session state validation on every request
- URL-based session hijacking prevention
- Automatic logout for inactive/blocked users

**Vulnerabilities:**
- No CSRF token validation visible in endpoints
- Session ID regeneration not implemented after login

**Sources:** [src/ctrls/IndexCtrl.php:1313-1345]()

### SQL Injection Protection

The system uses both patterns:
- **Unsafe**: Classic methods with string concatenation (legacy code)
- **Safe**: Prepared statements via `_safeSelect`, `_safeUpdate`, `_safeInsert`

Most user management operations use safe methods through `Singleton::_readInfo()` and related functions.

**Sources:** [src/ctrls/OperacionesCtrl.php:567]()

### Input Validation

Validation varies by endpoint:
- Email format validation in password recovery
- Required field checking via constants
- User state validation in session management

No centralized input validation framework is evident in the code.

**Sources:** [src/ctrls/OperacionesCtrl.php:957-959]()

---

---

## 9.4 Document and Workflow APIs

## Purpose and Scope

This page documents the API endpoints for document and workflow management in GESFINANCIERO. These endpoints handle document template operations, digital signatures, package management, and workflow orchestration throughout the system.

**Coverage:**
- Document template management (creation, modification, mixing)
- Digital signature operations and configuration
- Package lifecycle management (creation, review, administration)
- Workflow definition and execution (flows, flow items, state transitions)
- Requirements templates and their associated items
- Comments and annotations on documents and packages

**Related Pages:**
- For general API authentication and structure, see [REST API Endpoints](#9.1) and [AJAX API Endpoints](#9.2)
- For user and employee management APIs, see [User Management APIs](#9.3)
- For business logic implementation, see [OperacionesCtrl - Core Operations](#4.1)

---

## API Architecture Overview

The document and workflow APIs follow a dual-path architecture with both AJAX POST endpoints and REST API access through the `IndexCtrl` controller, which delegates to `OperacionesCtrl` for business logic execution.

```mermaid
graph TB
    CLIENT["Client Application"]
    
    subgraph "Entry Layer"
        INDEXPHP["index.php"]
        INDEXCTRL["IndexCtrl::__construct()"]
    end
    
    subgraph "API Routing"
        AJAX_ROUTE["AJAX POST Handler<br/><?php if ($_POST['ajax'] == md5(...))"]
        REST_ROUTE["REST Handler<br/>Rest::handler()"]
    end
    
    subgraph "Business Logic - OperacionesCtrl"
        DOC_OPS["Document Operations"]
        WF_OPS["Workflow Operations"]
        
        TPL_OPS["editarPlantillas_*()"]
        FIRMA_OPS["firmaspro_*()"]
        PKG_OPS["paquetes_*()"]
        FLUJO_OPS["flujos_*()"]
        FLUJOI_OPS["flujositems_*()"]
        REQ_OPS["requerimientostpls_*()"]
    end
    
    subgraph "Data Layer"
        SINGLETON["Singleton<br/>Database Queries"]
        MODELS["Model Classes<br/>src/modelo/*"]
    end
    
    CLIENT --> INDEXPHP
    INDEXPHP --> INDEXCTRL
    INDEXCTRL --> AJAX_ROUTE
    INDEXCTRL --> REST_ROUTE
    
    AJAX_ROUTE --> DOC_OPS
    AJAX_ROUTE --> WF_OPS
    REST_ROUTE --> DOC_OPS
    REST_ROUTE --> WF_OPS
    
    DOC_OPS --> TPL_OPS
    DOC_OPS --> FIRMA_OPS
    DOC_OPS --> PKG_OPS
    
    WF_OPS --> FLUJO_OPS
    WF_OPS --> FLUJOI_OPS
    WF_OPS --> REQ_OPS
    
    TPL_OPS --> SINGLETON
    FIRMA_OPS --> SINGLETON
    PKG_OPS --> SINGLETON
    FLUJO_OPS --> SINGLETON
    FLUJOI_OPS --> SINGLETON
    REQ_OPS --> SINGLETON
    
    SINGLETON --> MODELS
```

**Sources:** [src/ctrls/IndexCtrl.php:1308-1400](), [src/ctrls/IndexCtrl.php:1401-2600]()

---

## Document Management APIs

### Template Management APIs

Template APIs handle creation, modification, deletion, and mixing of document templates. Templates support variable substitution and component-based HTML generation.

#### API Endpoint Constants

| Constant | Value | Purpose |
|----------|-------|---------|
| `API_plantillasAdd` | 'API_plantillasAdd' | Add new template |
| `API_plantillasNew` | 'API_plantillasNew' | Initialize template creation |
| `API_plantillasDel` | 'API_plantillasDel' | Delete template |
| `API_plantillasMixAdd` | 'API_plantillasMixAdd' | Add template mix configuration |
| `API_plantillasMixGet` | 'API_plantillasMixGet' | Retrieve template mix |
| `API_plantillasMixSend` | 'API_plantillasMixSend' | Send/apply template mix |
| `API_plantillasMixVariablesHelperGet` | 'API_plantillasMixVariablesHelperGet' | Get helper variables for mixing |

**Sources:** [src/ctrls/IndexCtrl.php:747-809]()

#### Add Template - `API_plantillasAdd`

**Request:**
```javascript
POST /index.php
{
  "ajax": md5("API_plantillasAdd"),
  // Template data fields
}
```

**Handler Route:**
```php
// src/ctrls/IndexCtrl.php:1857-1866
if ($_POST["ajax"] == md5(self::API_plantillasAdd)) {
    $ok = OperacionesCtrl::editarPlantillas_Agregar($_POST);
    echo json_encode($ok);
}
```

**Business Logic:**
- Method: `OperacionesCtrl::editarPlantillas_Agregar($_POST)`
- Processes template data and stores in database
- Handles HTML content with component parsing

**Sources:** [src/ctrls/IndexCtrl.php:1857-1866]()

#### Delete Template - `API_plantillasDel`

**Request:**
```javascript
POST /index.php
{
  "ajax": md5("API_plantillasDel"),
  "id": <template_id>
}
```

**Handler Route:**
```php
// src/ctrls/IndexCtrl.php:1877-1886
if ($_POST["ajax"] == md5(self::API_plantillasDel)) {
    $ok = OperacionesCtrl::editarPlantillas_Eliminar($_POST);
    echo json_encode($ok);
}
```

**Sources:** [src/ctrls/IndexCtrl.php:1877-1886]()

#### Template Mixing Operations

Template mixing allows combining multiple templates with variable substitution.

**Add Mix Configuration - `API_plantillasMixAdd`:**
```javascript
POST /index.php
{
  "ajax": md5("API_plantillasMixAdd"),
  // Mix configuration data
}
```

**Get Mix - `API_plantillasMixGet`:**
```javascript
POST /index.php
{
  "ajax": md5("API_plantillasMixGet"),
  "id": <mix_id>
}
```

**Send Mix - `API_plantillasMixSend`:**
```javascript
POST /index.php
{
  "ajax": md5("API_plantillasMixSend"),
  // Send configuration
}
```

**Sources:** [src/ctrls/IndexCtrl.php:1887-1926]()

#### HTML Component Processing

Templates support custom HTML components with attribute-based syntax:

```php
// Component syntax: [type attribute=value]
// Example: [input type=text name=field1]
```

**Component Parser:**
- Method: `OperacionesCtrl::componenteHTML($d)`
- Parses custom component tags in HTML
- Supports attributes with boolean, numeric, and string values
- Location: [src/ctrls/OperacionesCtrl.php:154-207]()

**Sources:** [src/ctrls/OperacionesCtrl.php:154-207]()

---

### Digital Signature APIs

Digital signature APIs manage electronic signatures, certificate configuration, and signature workflows.

#### Signature Endpoint Constants

| Constant | Value | Purpose |
|----------|-------|---------|
| `API_FirmasGet` | 'API_FirmasGet' | Get signature data |
| `API_FirmasPreviaGet` | 'API_FirmasPreviaGet' | Get signature preview |
| `API_FirmasAgregarConfigCorp_Add` | 'API_FirmasAgregarConfigCorp_Add' | Add corporate signature config |
| `API_FirmasAgregarConfigCorp_Get` | 'API_FirmasAgregarConfigCorp_Get' | Get corporate signature config |
| `API_FirmasproHelperAdd` | 'API_FirmasproHelperAdd' | Sign document |
| `API_FirmasproAdminP12Add` | 'API_FirmasproAdminP12Add' | Add admin P12 certificate |

**Sources:** [src/ctrls/IndexCtrl.php:813-872]()

#### Get Signatures - `API_FirmasGet`

**Request:**
```javascript
POST /index.php
{
  "ajax": md5("API_FirmasGet"),
  // Filter criteria
}
```

**Handler Route:**
```php
// src/ctrls/IndexCtrl.php:1931-1940
if ($_POST["ajax"] == md5(self::API_FirmasGet)) {
    $ok = OperacionesCtrl::firmaspro_Helper_Obtener($_POST);
    echo json_encode($ok);
}
```

**Business Logic:**
- Method: `OperacionesCtrl::firmaspro_Helper_Obtener($_POST)`
- Retrieves signature records from database
- Returns signature metadata and status

**Sources:** [src/ctrls/IndexCtrl.php:1931-1940]()

#### Sign Document - `API_FirmasproHelperAdd`

**Request:**
```javascript
POST /index.php
{
  "ajax": md5("API_FirmasproHelperAdd"),
  // Document and signature data
}
```

**Handler Route:**
```php
// src/ctrls/IndexCtrl.php:1973-1982
if ($_POST["ajax"] == md5(self::API_FirmasproHelperAdd)) {
    $ok = OperacionesCtrl::firmaspro_Helper_FirmarDoc($_POST);
    echo json_encode($ok);
}
```

**Business Logic:**
- Method: `OperacionesCtrl::firmaspro_Helper_FirmarDoc($_POST)`
- Applies digital signature to document
- Handles certificate validation
- Updates document status

**Sources:** [src/ctrls/IndexCtrl.php:1973-1982]()

#### Signature Configuration

Corporate signature configuration management:

**Add Config:**
```javascript
POST /index.php
{
  "ajax": md5("API_FirmasAgregarConfigCorp_Add"),
  // Configuration parameters
}
```

**Get Config:**
```javascript
POST /index.php
{
  "ajax": md5("API_FirmasAgregarConfigCorp_Get")
}
```

**Sources:** [src/ctrls/IndexCtrl.php:1952-1971]()

#### Signature Events and Comments

**Signature Events - `API_FirmaslogHelperEvent`:**
```javascript
POST /index.php
{
  "ajax": md5("API_FirmaslogHelperEvent"),
  // Event query parameters
}
```

Handler: [src/ctrls/IndexCtrl.php:1996-2005]()

**Signature Comments:**

| Endpoint | Purpose |
|----------|---------|
| `API_FirmascomentariosHelperGet` | Retrieve comments |
| `API_FirmascomentariosHelperAdd` | Add comment |
| `API_FirmascomentariosHelperDel` | Delete comment |

Handlers: [src/ctrls/IndexCtrl.php:2010-2040]()

**Sources:** [src/ctrls/IndexCtrl.php:887-890](), [src/ctrls/IndexCtrl.php:1996-2040]()

---

### Package Management APIs

Packages aggregate documents and requirements through workflow stages (submission, review, administration).

#### Package Endpoint Constants

| Constant | Value | Purpose |
|----------|-------|---------|
| `API_PaquetesGetAjax` | 'API_PaquetesGetAjax' | Get packages via AJAX |
| `API_PaquetesHelperGetAjax` | 'API_PaquetesHelperGetAjax' | Get helper package data |
| `API_PaquetesHelperMoveReview` | 'API_PaquetesHelperMoveReview' | Move package to review |
| `API_PaquetesHelperMoveAdmin` | 'API_PaquetesHelperMoveAdmin' | Move package to admin |
| `API_PaquetesHomeHelperAdd` | 'API_PaquetesHomeHelperAdd' | Add package from home |
| `API_PaquetesAdminReg_Helper_Add` | 'API_PaquetesAdminReg_Helper_Add' | Register package admin |

**Sources:** [src/ctrls/IndexCtrl.php:1026-1063]()

```mermaid
stateDiagram-v2
    [*] --> Submission: API_PaquetesHomeHelperAdd
    Submission --> Review: API_PaquetesHelperMoveReview
    Review --> Administration: API_PaquetesHelperMoveAdmin
    Administration --> [*]
    
    Submission --> Submission: Add Requirements<br/>API_PaquetesrequHelperAdd
    Review --> Review: Add Comments<br/>API_PaquetesreqcomentariosHelperAdd
    Administration --> Administration: Register<br/>API_PaquetesAdminReg_Helper_Add
```

**Sources:** [src/ctrls/IndexCtrl.php:1026-1063](), [src/ctrls/IndexCtrl.php:2232-2395]()

#### Get Packages - `API_PaquetesGetAjax`

**Request:**
```javascript
POST /index.php
{
  "ajax": md5("API_PaquetesGetAjax"),
  // Query filters
}
```

**Handler Route:**
```php
// src/ctrls/IndexCtrl.php:2242-2251
if ($_POST["ajax"] == md5(self::API_PaquetesGetAjax)) {
    $ok = OperacionesCtrl::paquetes_Obtener_Ajax($_POST);
    echo json_encode($ok);
}
```

**Business Logic:**
- Method: `OperacionesCtrl::paquetes_Obtener_Ajax($_POST)`
- Returns package list with status and metadata
- Supports filtering by user, state, date range

**Sources:** [src/ctrls/IndexCtrl.php:2242-2251]()

#### Move Package to Review - `API_PaquetesHelperMoveReview`

**Request:**
```javascript
POST /index.php
{
  "ajax": md5("API_PaquetesHelperMoveReview"),
  "id": <package_id>
}
```

**Handler Route:**
```php
// src/ctrls/IndexCtrl.php:2262-2271
if ($_POST["ajax"] == md5(self::API_PaquetesHelperMoveReview)) {
    $ok = OperacionesCtrl::paquetes_Helper_MoverRevisar($_POST);
    echo json_encode($ok);
}
```

**Business Logic:**
- Method: `OperacionesCtrl::paquetes_Helper_MoverRevisar($_POST)`
- Transitions package state to review
- Validates requirements completion
- Triggers notifications

**Sources:** [src/ctrls/IndexCtrl.php:2262-2271]()

#### Move Package to Administration - `API_PaquetesHelperMoveAdmin`

**Request:**
```javascript
POST /index.php
{
  "ajax": md5("API_PaquetesHelperMoveAdmin"),
  "id": <package_id>
}
```

**Handler Route:**
```php
// src/ctrls/IndexCtrl.php:2272-2281
if ($_POST["ajax"] == md5(self::API_PaquetesHelperMoveAdmin)) {
    $ok = OperacionesCtrl::paquetes_Helper_MoverAdmin($_POST);
    echo json_encode($ok);
}
```

**Sources:** [src/ctrls/IndexCtrl.php:2272-2281]()

#### Package Requirements

**Add Requirement - `API_PaquetesrequHelperAdd`:**
```javascript
POST /index.php
{
  "ajax": md5("API_PaquetesrequHelperAdd"),
  "paquete_id": <package_id>,
  "requerimiento_id": <requirement_id>,
  // Additional requirement data
}
```

Handler: [src/ctrls/IndexCtrl.php:2285-2294]()

**Sources:** [src/ctrls/IndexCtrl.php:1073-1075](), [src/ctrls/IndexCtrl.php:2285-2294]()

#### Package Requirement Comments

Comments support collaborative review of package requirements.

| Endpoint | Method | Purpose |
|----------|--------|---------|
| `API_PaquetesreqcomentariosHelperGet` | `paquetesreqcomentarios_Helper_Obtener()` | Get comments |
| `API_PaquetesreqcomentariosHelperAdd` | `paquetesreqcomentarios_Helper_Agregar()` | Add comment |
| `API_PaquetesreqcomentariosHelperDel` | `paquetesreqcomentarios_Helper_Eliminar()` | Delete comment |

**Request Example:**
```javascript
POST /index.php
{
  "ajax": md5("API_PaquetesreqcomentariosHelperAdd"),
  "paqueterequ_id": <requirement_id>,
  "comentario": "Review comment text"
}
```

**Sources:** [src/ctrls/IndexCtrl.php:1082-1085](), [src/ctrls/IndexCtrl.php:2317-2347]()

---

## Workflow Management APIs

### Flow (Flujos) APIs

Flows define workflow structures with states, transitions, and approval chains.

#### Flow Endpoint Constants

| Constant | Value | Purpose |
|----------|-------|---------|
| `API_FlujosHelperAdd` | 'API_FlujosHelperAdd' | Add/create flow |
| `API_FlujosHelperEstadoMod` | 'API_FlujosHelperEstadoMod' | Modify flow state |
| `API_FlujosGetAjax` | 'API_FlujosGetAjax' | Get flows via AJAX |

**Sources:** [src/ctrls/IndexCtrl.php:949-976]()

#### Add Flow - `API_FlujosHelperAdd`

**Request:**
```javascript
POST /index.php
{
  "ajax": md5("API_FlujosHelperAdd"),
  "nombre": "Flow Name",
  "descripcion": "Flow description",
  // Additional flow configuration
}
```

**Handler Route:**
```php
// src/ctrls/IndexCtrl.php:2156-2165
if ($_POST["ajax"] == md5(self::API_FlujosHelperAdd)) {
    $ok = OperacionesCtrl::flujos_Helper_Agregar($_POST);
    echo json_encode($ok);
}
```

**Business Logic:**
- Method: `OperacionesCtrl::flujos_Helper_Agregar($_POST)`
- Creates new workflow definition
- Initializes default states
- Sets up approval chain structure

**Sources:** [src/ctrls/IndexCtrl.php:2156-2165]()

#### Modify Flow State - `API_FlujosHelperEstadoMod`

**Request:**
```javascript
POST /index.php
{
  "ajax": md5("API_FlujosHelperEstadoMod"),
  "id": <flow_id>,
  "estado_id": <new_state_id>
}
```

**Handler Route:**
```php
// src/ctrls/IndexCtrl.php:2146-2155
if ($_POST["ajax"] == md5(self::API_FlujosHelperEstadoMod)) {
    $ok = OperacionesCtrl::flujos_Estados_Helper_Modificar($_POST);
    echo json_encode($ok);
}
```

**Business Logic:**
- Method: `OperacionesCtrl::flujos_Estados_Helper_Modificar($_POST)`
- Updates flow state/status
- Validates state transition rules
- Logs state changes

**Sources:** [src/ctrls/IndexCtrl.php:2146-2155]()

#### Get Flows - `API_FlujosGetAjax`

**Request:**
```javascript
POST /index.php
{
  "ajax": md5("API_FlujosGetAjax"),
  // Optional filters
}
```

**Handler Route:**
```php
// src/ctrls/IndexCtrl.php:2166-2175
if ($_POST["ajax"] == md5(self::API_FlujosGetAjax)) {
    $ok = OperacionesCtrl::flujos_Obtener_Ajax($_POST);
    echo json_encode($ok);
}
```

**Sources:** [src/ctrls/IndexCtrl.php:2166-2175]()

---

### Flow Items (Flujositems) APIs

Flow items represent individual steps/stages within a workflow, including reviewers and approval requirements.

#### Flow Item Endpoint Constants

| Constant | Value | Purpose |
|----------|-------|---------|
| `API_FlujositemsPrincipalHelperGet` | 'API_FlujositemsPrincipalHelperGet' | Get principal item helper |
| `API_FlujositemsGet` | 'API_FlujositemsGet' | Get flow items |
| `API_FlujositemsHelperGet` | 'API_FlujositemsHelperGet' | Get item helper data |
| `API_FlujositemsHelperDel` | 'API_FlujositemsHelperDel' | Delete flow item |
| `API_FlujositemsRevDtGet` | 'API_FlujositemsRevDtGet' | Get reviewer data |

**Sources:** [src/ctrls/IndexCtrl.php:978-1024]()

```mermaid
graph LR
    FLOW["Flow Definition<br/>flujos table"]
    
    ITEM1["Flow Item 1<br/>flujositems"]
    ITEM2["Flow Item 2<br/>flujositems"]
    ITEM3["Flow Item 3<br/>flujositems"]
    
    REV1["Reviewer 1<br/>Usuario"]
    REV2["Reviewer 2<br/>Usuario"]
    REV3["Reviewer 3<br/>Usuario"]
    
    FLOW -->|"has multiple"| ITEM1
    FLOW --> ITEM2
    FLOW --> ITEM3
    
    ITEM1 -->|"assigned to"| REV1
    ITEM2 -->|"assigned to"| REV2
    ITEM3 -->|"assigned to"| REV3
    
    ITEM1 -->|"order: 1"| ITEM2
    ITEM2 -->|"order: 2"| ITEM3
```

**Sources:** [src/ctrls/IndexCtrl.php:2179-2229]()

#### Get Flow Items - `API_FlujositemsGet`

**Request:**
```javascript
POST /index.php
{
  "ajax": md5("API_FlujositemsGet"),
  "flujos_id": <flow_id>
}
```

**Handler Route:**
```php
// src/ctrls/IndexCtrl.php:2189-2198
if ($_POST["ajax"] == md5(self::API_FlujositemsGet)) {
    $ok = OperacionesCtrl::flujositems_Obtener($_POST);
    echo json_encode($ok);
}
```

**Business Logic:**
- Method: `OperacionesCtrl::flujositems_Obtener($_POST)`
- Returns ordered list of flow items
- Includes reviewer assignments
- Shows approval status

**Sources:** [src/ctrls/IndexCtrl.php:2189-2198]()

#### Get Principal Flow Item - `API_FlujositemsPrincipalHelperGet`

**Request:**
```javascript
POST /index.php
{
  "ajax": md5("API_FlujositemsPrincipalHelperGet"),
  "flujos_id": <flow_id>
}
```

**Handler Route:**
```php
// src/ctrls/IndexCtrl.php:2179-2188
if ($_POST["ajax"] == md5(self::API_FlujositemsPrincipalHelperGet)) {
    $ok = OperacionesCtrl::flujositems_Pricipal_Helper_Obtener($_POST);
    echo json_encode($ok);
}
```

**Sources:** [src/ctrls/IndexCtrl.php:2179-2188]()

#### Delete Flow Item - `API_FlujositemsHelperDel`

**Request:**
```javascript
POST /index.php
{
  "ajax": md5("API_FlujositemsHelperDel"),
  "id": <item_id>
}
```

**Handler Route:**
```php
// src/ctrls/IndexCtrl.php:2209-2218
if ($_POST["ajax"] == md5(self::API_FlujositemsHelperDel)) {
    $ok = OperacionesCtrl::flujositems_Helper_Eliminar($_POST);
    echo json_encode($ok);
}
```

**Business Logic:**
- Method: `OperacionesCtrl::flujositems_Helper_Eliminar($_POST)`
- Removes flow item from workflow
- Validates no active documents are at this stage
- Updates dependent flow items

**Sources:** [src/ctrls/IndexCtrl.php:2209-2218]()

#### Get Reviewer Data - `API_FlujositemsRevDtGet`

**Request:**
```javascript
POST /index.php
{
  "ajax": md5("API_FlujositemsRevDtGet"),
  "item_id": <flow_item_id>
}
```

**Handler Route:**
```php
// src/ctrls/IndexCtrl.php:2219-2228
if ($_POST["ajax"] == md5(self::API_FlujositemsRevDtGet)) {
    $ok = OperacionesCtrl::flujositems_Helper_ObtenerRevisorData($_POST);
    echo json_encode($ok);
}
```

**Business Logic:**
- Method: `OperacionesCtrl::flujositems_Helper_ObtenerRevisorData($_POST)`
- Returns reviewer/approver information
- Includes user details and permissions
- Shows approval history

**Sources:** [src/ctrls/IndexCtrl.php:2219-2228]()

---

### Requirements Template APIs

Requirements templates define document requirements that can be attached to workflows and packages.

#### Requirements Endpoint Constants

| Constant | Value | Purpose |
|----------|-------|---------|
| `API_RequerimientostplsGetAjax` | 'API_RequerimientostplsGetAjax' | Get requirements templates |
| `API_RequerimientosHelperAdd` | 'API_RequerimientosHelperAdd' | Add requirement helper |
| `API_RequerimientostplsitemsHelperGet` | 'API_RequerimientostplsitemsHelperGet' | Get requirement items |

**Sources:** [src/ctrls/IndexCtrl.php:915-946]()

#### Get Requirements Templates - `API_RequerimientostplsGetAjax`

**Request:**
```javascript
POST /index.php
{
  "ajax": md5("API_RequerimientostplsGetAjax"),
  // Optional filters
}
```

**Handler Route:**
```php
// src/ctrls/IndexCtrl.php:2113-2122
if ($_POST["ajax"] == md5(self::API_RequerimientostplsGetAjax)) {
    $ok = OperacionesCtrl::requerimientostpls_Obtener_Ajax($_POST);
    echo json_encode($ok);
}
```

**Business Logic:**
- Method: `OperacionesCtrl::requerimientostpls_Obtener_Ajax($_POST)`
- Returns list of requirement templates
- Includes associated workflow information
- Supports DataTables integration

**Sources:** [src/ctrls/IndexCtrl.php:2113-2122]()

#### Add Requirement - `API_RequerimientosHelperAdd`

**Request:**
```javascript
POST /index.php
{
  "ajax": md5("API_RequerimientosHelperAdd"),
  "nombre": "Requirement name",
  "descripcion": "Description",
  // Additional requirement data
}
```

**Handler Route:**
```php
// src/ctrls/IndexCtrl.php:2123-2132
if ($_POST["ajax"] == md5(self::API_RequerimientosHelperAdd)) {
    $ok = OperacionesCtrl::requerimientostpls_Helper_Agregar($_POST);
    echo json_encode($ok);
}
```

**Sources:** [src/ctrls/IndexCtrl.php:2123-2132]()

#### Get Requirement Items - `API_RequerimientostplsitemsHelperGet`

**Request:**
```javascript
POST /index.php
{
  "ajax": md5("API_RequerimientostplsitemsHelperGet"),
  "requerimiento_id": <requirement_id>
}
```

**Handler Route:**
```php
// src/ctrls/IndexCtrl.php:2133-2142
if ($_POST["ajax"] == md5(self::API_RequerimientostplsitemsHelperGet)) {
    $ok = OperacionesCtrl::requerimientostplsitems_Helper_Obtener($_POST);
    echo json_encode($ok);
}
```

**Business Logic:**
- Method: `OperacionesCtrl::requerimientostplsitems_Helper_Obtener($_POST)`
- Returns sub-items for a requirement
- Includes document type specifications
- Shows validation rules

**Sources:** [src/ctrls/IndexCtrl.php:2133-2142]()

---

## Document and Workflow Integration

### Document-Workflow Relationship

```mermaid
graph TB
    subgraph "Document Layer"
        TPL["Templates<br/>plantillas"]
        DOC["Generated Documents"]
        SIG["Digital Signatures<br/>firmaspro"]
    end
    
    subgraph "Workflow Layer"
        FLOW["Workflow Definition<br/>flujos"]
        ITEMS["Flow Items<br/>flujositems"]
        REQ["Requirements<br/>requerimientostpls"]
    end
    
    subgraph "Package Layer"
        PKG["Package<br/>paquetes"]
        PKGREQ["Package Requirements<br/>paquetesrequ"]
        PKGCOM["Package Comments<br/>paquetesreqcomentarios"]
    end
    
    subgraph "Configuration"
        CFGMIX["Template Mix Config<br/>CFG_REQUERIMIENTOS_MEZCLA"]
    end
    
    TPL -->|"mixed with config"| CFGMIX
    CFGMIX -->|"generates"| DOC
    DOC -->|"signed by"| SIG
    
    FLOW -->|"defines"| ITEMS
    FLOW -->|"requires"| REQ
    
    PKG -->|"follows"| FLOW
    PKG -->|"contains"| PKGREQ
    PKGREQ -->|"references"| REQ
    PKGREQ -->|"has"| PKGCOM
    
    DOC -->|"attached to"| PKGREQ
    SIG -->|"validates"| PKGREQ
```

**Sources:** [src/ctrls/OperacionesCtrl.php:1248-1262](), [src/ctrls/IndexCtrl.php:1026-2395]()

### Template Mixing Configuration

Template mixing is controlled via corporate configuration:

**Configuration Constant:**
```php
// src/ctrls/OperacionesCtrl.php:1262
const CFG_REQUERIMIENTOS_MEZCLA = 'cfgrequerimientosmezcla';
```

This stores a JSON structure mapping flows to their active template configurations.

**Accessing Mix Configuration:**
```php
$cfg = OperacionesCtrl::LeerConfigCorp();
$mixConfig = $cfg[OperacionesCtrl::CFG_REQUERIMIENTOS_MEZCLA]["val"];
```

**Sources:** [src/ctrls/OperacionesCtrl.php:1248-1262](), [src/ctrls/OperacionesCtrl.php:1312-1324]()

---

## Common Patterns and Utilities

### Authentication Requirements

All document and workflow APIs require active session authentication. The authentication is verified in the controller constructor:

```php
// src/ctrls/IndexCtrl.php:1308-1320
public function __construct(){
    if(!isset($_SESSION)){ session_start(); }
    if (isset($_SESSION["usu"])) {
        $_usu_tmp = $_SESSION["usu"];
        if($_usu_tmp->getEstado_id() > 1){
            Seguridad::logout();
            // User inactive/blocked/deleted
        }
    }
}
```

**Exception:** Some helper endpoints use `OperacionesCtrl::authRequOff()` to bypass authentication for specific use cases.

**Sources:** [src/ctrls/IndexCtrl.php:1308-1320]()

### MD5 Endpoint Hashing

All AJAX endpoints use MD5 hashing of the constant name for routing:

```javascript
// Client-side
const endpoint = md5("API_FlujosGetAjax");
$.post("index.php", { ajax: endpoint, ...data });
```

```php
// Server-side
if ($_POST["ajax"] == md5(self::API_FlujosGetAjax)) {
    // Handle request
}
```

**Sources:** [src/ctrls/IndexCtrl.php:1401-2600]()

### Error Handling

Errors are returned with HTTP status codes and JSON responses:

```php
try {
    $ok = OperacionesCtrl::flujos_Helper_Agregar($_POST);
    echo json_encode($ok);
} catch (Exception $ex) {
    $er = array("err" => $ex->getMessage());
    echo json_encode($er);
}
```

**Common Error Codes:**

| Code | Constant | Meaning |
|------|----------|---------|
| 520 | `ERR_COD_SIN_PRIVILEGIOS` | Insufficient privileges |
| 524 | `ERR_COD_CAMPO_OBLIGATORIO` | Required field missing |
| 529 | `ERR_COD_SESION_INACTIVA` | Session inactive |
| 530 | `ERR_COD_MSJ_ERR_COMUN` | Common/general error |
| 536 | `ERR_COD_PLANTILLA_NO_SALVADA` | Template not saved |
| 537 | `ERR_COD_REGISTRO_EXISTENTE` | Duplicate record |
| 538 | `ERR_COD_ACTUALIZACION_SQL` | SQL update failed |
| 539 | `ERR_COD_RESPUESTA_SQL_VACIA` | Empty SQL response |

**Sources:** [src/ctrls/IndexCtrl.php:82-277]()

### Response Formats

**Success Response:**
```json
{
  "ok": {
    // Result data
  }
}
```

**Error Response:**
```json
{
  "err": "Error message description"
}
```

**Sources:** [src/ctrls/IndexCtrl.php:1401-2600]()

---

## API Method Mapping

### IndexCtrl to OperacionesCtrl Routing

```mermaid
graph LR
    subgraph "IndexCtrl Endpoints"
        E1["API_plantillasAdd"]
        E2["API_FirmasGet"]
        E3["API_PaquetesGetAjax"]
        E4["API_FlujosHelperAdd"]
        E5["API_FlujositemsGet"]
        E6["API_RequerimientostplsGetAjax"]
    end
    
    subgraph "OperacionesCtrl Methods"
        M1["editarPlantillas_Agregar()"]
        M2["firmaspro_Helper_Obtener()"]
        M3["paquetes_Obtener_Ajax()"]
        M4["flujos_Helper_Agregar()"]
        M5["flujositems_Obtener()"]
        M6["requerimientostpls_Obtener_Ajax()"]
    end
    
    E1 -->|"delegates to"| M1
    E2 -->|"delegates to"| M2
    E3 -->|"delegates to"| M3
    E4 -->|"delegates to"| M4
    E5 -->|"delegates to"| M5
    E6 -->|"delegates to"| M6
```

**Complete Mapping Table:**

| IndexCtrl Constant | OperacionesCtrl Method | Line Reference |
|-------------------|------------------------|----------------|
| `API_plantillasAdd` | `editarPlantillas_Agregar()` | [1857-1866]() |
| `API_plantillasNew` | `editarPlantillas_Nuevo()` | [1867-1876]() |
| `API_plantillasDel` | `editarPlantillas_Eliminar()` | [1877-1886]() |
| `API_plantillasMixAdd` | `editarPlantillas_Mezclar_Agregar()` | [1887-1896]() |
| `API_plantillasMixGet` | `editarPlantillas_Mezclar_Obtener()` | [1897-1906]() |
| `API_plantillasMixSend` | `editarPlantillas_Mezclar_Enviar()` | [1907-1916]() |
| `API_plantillasMixVariablesHelperGet` | `editarPlantillas_JBB_Variables_Helper_Obtener()` | [1917-1926]() |
| `API_FirmasGet` | `firmaspro_Helper_Obtener()` | [1931-1940]() |
| `API_FirmasPreviaGet` | `firmaspro_Preview_Obtener()` | [1942-1951]() |
| `API_FirmasAgregarConfigCorp_Add` | `firmaspro_Config_Page_Agregar()` | [1952-1961]() |
| `API_FirmasAgregarConfigCorp_Get` | `firmaspro_Config_Page_Obtener()` | [1962-1971]() |
| `API_FirmasproHelperAdd` | `firmaspro_Helper_FirmarDoc()` | [1973-1982]() |
| `API_FirmasproAdminP12Add` | `firmaspro_Helper_Admin_MkCert_p12()` | [1983-1992]() |
| `API_FirmaslogHelperEvent` | `firmaspro_Helper_EventsObtener()` | [1996-2005]() |
| `API_FirmascomentariosHelperGet` | `firmascomentarios_Helper_Obtener()` | [2010-2019]() |
| `API_FirmascomentariosHelperAdd` | `firmascomentarios_Helper_Agregar()` | [2020-2029]() |
| `API_FirmascomentariosHelperDel` | `firmascomentarios_Helper_Eliminar()` | [2030-2039]() |
| `API_PaquetesGetAjax` | `paquetes_Obtener_Ajax()` | [2242-2251]() |
| `API_PaquetesHelperGetAjax` | `paquetes_Helper_Obtener_Ajax()` | [2252-2261]() |
| `API_PaquetesHelperMoveReview` | `paquetes_Helper_MoverRevisar()` | [2262-2271]() |
| `API_PaquetesHelperMoveAdmin` | `paquetes_Helper_MoverAdmin()` | [2272-2281]() |
| `API_PaquetesHomeHelperAdd` | `paquetes_Home_Helper_Agregar()` | [2232-2241]() |
| `API_PaquetesAdminReg_Helper_Add` | `paquetesAdminReg_Helper_Agregar()` | [2386-2395]() |
| `API_PaquetesrequHelperAdd` | `paquetesrequ_Helper_Agregar()` | [2285-2294]() |
| `API_PaquetesreqcomentariosHelperGet` | `paquetesreqcomentarios_Helper_Obtener()` | [2317-2326]() |
| `API_PaquetesreqcomentariosHelperAdd` | `paquetesreqcomentarios_Helper_Agregar()` | [2327-2336]() |
| `API_PaquetesreqcomentariosHelperDel` | `paquetesreqcomentarios_Helper_Eliminar()` | [2337-2346]() |
| `API_FlujosHelperAdd` | `flujos_Helper_Agregar()` | [2156-2165]() |
| `API_FlujosHelperEstadoMod` | `flujos_Estados_Helper_Modificar()` | [2146-2155]() |
| `API_FlujosGetAjax` | `flujos_Obtener_Ajax()` | [2166-2175]() |
| `API_FlujositemsPrincipalHelperGet` | `flujositems_Pricipal_Helper_Obtener()` | [2179-2188]() |
| `API_FlujositemsGet` | `flujositems_Obtener()` | [2189-2198]() |
| `API_FlujositemsHelperGet` | `flujositems_Helper_Obtener()` | [2199-2208]() |
| `API_FlujositemsHelperDel` | `flujositems_Helper_Eliminar()` | [2209-2218]() |
| `API_FlujositemsRevDtGet` | `flujositems_Helper_ObtenerRevisorData()` | [2219-2228]() |
| `API_RequerimientostplsGetAjax` | `requerimientostpls_Obtener_Ajax()` | [2113-2122]() |
| `API_RequerimientosHelperAdd` | `requerimientostpls_Helper_Agregar()` | [2123-2132]() |
| `API_RequerimientostplsitemsHelperGet` | `requerimientostplsitems_Helper_Obtener()` | [2133-2142]() |

**Sources:** [src/ctrls/IndexCtrl.php:1857-2395]()

---

---

## 10. Security and Authentication

## Purpose and Scope

This document describes the security and authentication architecture of the GESFINANCIERO system. It covers the multiple authentication mechanisms supported by the system, including session-based authentication, REST API token authentication, LDAP integration, and account recovery workflows.

For detailed information about specific authentication endpoints, see [Authentication System](#10.1). For token lifecycle management, see [Token Management](#10.2). For password recovery flows, see [Account Activation and Recovery](#10.3).

---

## Overview of Authentication Architecture

GESFINANCIERO implements a multi-layered authentication system supporting three distinct authentication paradigms:

| Authentication Type | Use Case | Primary Handler | Token Type |
|---------------------|----------|-----------------|------------|
| **Session-Based** | Main application access (index.php) | `OperacionesCtrl::AutenticaUsuarioSisAjax` | PHP Sessions |
| **REST API Bearer Token** | External integrations, mobile apps | `Rest::handler` + `OperacionesCtrl::CompararToken` | RSA Public Keys |
| **LDAP Corporate** | Enterprise SSO integration | `OperacionesHomeCtrl::LoginLdapUsur` | LDAP Bind |
| **External OAuth** | Social login (placeholder) | `OperacionesHomeCtrl::LoginFromExterno` | Third-party tokens |

### Authentication Flow Overview

```mermaid
graph TB
    subgraph "Entry Points"
        INDEX["index.php<br/>Main Application"]
        HOME["home.php<br/>Public Portal"]
        RESTEP["REST Endpoint<br/>PATH_INFO set"]
    end
    
    subgraph "Authentication Methods"
        SESSION["Session Authentication<br/>OperacionesCtrl::AutenticaUsuarioSisAjax"]
        BEARER["Bearer Token<br/>Rest::getBearerToken"]
        BASIC["Basic Auth<br/>Rest::getAuthBasic"]
        LDAP["LDAP Auth<br/>OperacionesHomeCtrl::LoginLdapUsur"]
        TEMPCODE["Temporary Code<br/>OperacionesHomeCtrl::activarCuenta"]
    end
    
    subgraph "Token Management"
        GENTOKEN["Generate Token<br/>OperacionesCtrl::GenerarToken"]
        APIBOX["Token Storage<br/>ApiboxLib::Crear"]
        COMPARE["Token Validation<br/>OperacionesCtrl::CompararToken"]
        RSAKEY["RSA Key Generation<br/>OperacionesCtrl::GenerarLlavePublica"]
    end
    
    subgraph "Data Sources"
        DBUSR["usuarios table<br/>System Users"]
        DBUSERSEL["userselecto table<br/>Public Users"]
        DBAPIBOX["apibox table<br/>RSA Tokens"]
        LDAPSRV["LDAP Directory<br/>Corporate Auth"]
    end
    
    INDEX --> SESSION
    HOME --> TEMPCODE
    HOME --> LDAP
    RESTEP --> BEARER
    RESTEP --> BASIC
    
    SESSION --> DBUSR
    TEMPCODE --> DBUSERSEL
    LDAP --> LDAPSRV
    LDAP --> DBUSERSEL
    
    BEARER --> COMPARE
    BASIC --> GENTOKEN
    
    GENTOKEN --> RSAKEY
    GENTOKEN --> APIBOX
    COMPARE --> DBAPIBOX
    
    APIBOX --> DBAPIBOX
```

**Sources:** [src/ctrls/OperacionesCtrl.php:505-595](), [src/ctrls/OperacionesHomeCtrl.php:254-322](), [src/ctrls/Rest.php:114-275]()

---

## Session-Based Authentication

Session-based authentication is used for the main application accessed via `index.php`. This method validates credentials against the `usuarios` table and establishes a PHP session.

### Authentication Method: AutenticaUsuarioSisAjax

The primary authentication method is `OperacionesCtrl::AutenticaUsuarioSisAjax`, which supports two authentication modes:

| Mode | Parameter | Query Method | Use Case |
|------|-----------|--------------|----------|
| **Direct** | `u`: username/email<br/>`c`: password | `WHERE (mail = 'u' OR usuario = 'u') AND clave = MD5('c')` | Standard login |
| **MD5 Hash** | `u`: MD5(username+password) | `WHERE MD5(CONCAT(usuario, clave)) = 'u'` | Pre-hashed credentials |

### Authentication Flow Diagram

```mermaid
sequenceDiagram
    participant Client
    participant IndexCtrl
    participant OpCtrl as "OperacionesCtrl"
    participant Singleton
    participant DB as "usuarios table"
    
    Client->>IndexCtrl: POST login credentials
    IndexCtrl->>OpCtrl: AutenticaUsuarioSisAjax(u, c)
    
    alt Direct Authentication
        OpCtrl->>Singleton: _readInfoChar("usuarios", ...)
        Note over OpCtrl,Singleton: WHERE (mail='u' OR usuario='u')<br/>AND clave=MD5('c')
    else MD5 Authentication
        OpCtrl->>Singleton: _readInfoChar("usuarios", ...)
        Note over OpCtrl,Singleton: WHERE MD5(CONCAT(usuario,clave))='u'
    end
    
    Singleton->>DB: Execute SELECT query
    DB-->>Singleton: User record(s)
    
    alt User Found
        Singleton-->>OpCtrl: User data array
        OpCtrl->>OpCtrl: Check count == 1
        OpCtrl->>OpCtrl: unset(clave) for security
        OpCtrl-->>IndexCtrl: User data (no password)
        IndexCtrl-->>Client: HTTP 200 + User JSON
    else Multiple Users
        OpCtrl-->>Client: HTTP 500<br/>ERR_COD_MSJ_ERR_COMUN
    else No User Found
        OpCtrl-->>Client: HTTP 401<br/>ERR_COD_USUARIO_O_CLAVE_INVALIDA
    end
```

**Sources:** [src/ctrls/OperacionesCtrl.php:560-595]()

### Security Considerations for Session Authentication

**Password Hashing:**
- Passwords stored as MD5 hashes: `clave = md5('password')` [src/ctrls/OperacionesCtrl.php:567]()
- **Security Warning:** MD5 is cryptographically weak and should be upgraded to bcrypt or Argon2

**SQL Injection Risk:**
- Direct string concatenation in WHERE clause: `"where (mail = '" . $u . "' or usuario = '" . $u . "')"`
- **Critical Issue:** No parameterized queries used, vulnerable to SQL injection
- Should migrate to `Singleton::_safeSelect` methods [src/ctrls/OperacionesCtrl.php:566-568]()

**Password Removal:**
- System correctly removes password field before returning user data: `unset($db_chkusr[0]["clave"])` [src/ctrls/OperacionesCtrl.php:587]()

---

## REST API Token Authentication

REST API authentication uses RSA key pairs stored in the `apibox` table. Each authorized user can generate a unique public/private key pair that serves as their Bearer token.

### Token Generation Process

```mermaid
graph TB
    subgraph "Token Request"
        CLIENT["REST Client"]
        BASICAUTH["Basic Auth<br/>Username + Password"]
    end
    
    subgraph "Authentication"
        RESTHANDLER["Rest::handler"]
        GETBASIC["Rest::getAuthBasic"]
        AUTHUSR["OperacionesCtrl::AutenticaUsuarioSisAjax"]
    end
    
    subgraph "Authorization Check"
        CHECKPROFILE["Check perfil_id<br/>Must be 1, 2, or 7"]
        CHECKSTATUS["Check estado_id<br/>Must be 1 (Active)"]
    end
    
    subgraph "Key Generation"
        GENKEY["GenerarLlavePublica<br/>OpenSSL RSA 2048-bit"]
        CONFIG["digest_alg: sha512<br/>private_key_type: RSA"]
        PASSPHRASE["Passphrase:<br/>email + timestamp"]
    end
    
    subgraph "Token Storage"
        APIBOXCREATE["ApiboxLib::Crear"]
        APIBOXTABLE["apibox table<br/>usuarios_id, publica,<br/>privada, activo, fecha"]
    end
    
    CLIENT --> BASICAUTH
    BASICAUTH --> RESTHANDLER
    RESTHANDLER --> GETBASIC
    GETBASIC --> AUTHUSR
    
    AUTHUSR --> CHECKSTATUS
    CHECKSTATUS --> CHECKPROFILE
    
    CHECKPROFILE --> GENKEY
    GENKEY --> CONFIG
    GENKEY --> PASSPHRASE
    
    GENKEY --> APIBOXCREATE
    APIBOXCREATE --> APIBOXTABLE
    
    APIBOXTABLE --> CLIENT
```

**Sources:** [src/ctrls/OperacionesCtrl.php:621-643](), [src/ctrls/OperacionesCtrl.php:674-787](), [src/libs/Apibox/ApiboxLib.php:9-41]()

### RSA Key Pair Generation

The system generates RSA keys using OpenSSL with the following configuration:

**Configuration Parameters:**
```php
// From OperacionesCtrl::GenerarLlavePublica
digest_alg: "sha512"
private_key_bits: 2048
private_key_type: OPENSSL_KEYTYPE_RSA
```

**Passphrase Generation:**
```php
// Private key protected with: email + YmdHis timestamp
$passphrase = $email . date('YmdHis', strtotime($fecha))
```

**Key Storage Format:**
- Public key stored as PEM format in `apibox.publica`
- Private key stored as PEM format in `apibox.privada`
- Both keys stored as full PEM strings including headers
- No additional encoding applied

**Sources:** [src/ctrls/OperacionesCtrl.php:621-643]()

### Authorized User Profiles

Only users with specific profile IDs can generate API tokens:

| Profile ID | Profile Name | Access Level |
|------------|--------------|--------------|
| 1 | Administrator | Full system access |
| 2 | Manager | Management access |
| 7 | API User | API-specific access |

**Authorization Check:**
```php
if ($okI['perfil_id'] == 1 || $okI['perfil_id'] == 2 || $okI['perfil_id'] == 7) {
    // Authorized to generate token
}
```

**Sources:** [src/ctrls/OperacionesCtrl.php:697]()

### Bearer Token Validation Flow

```mermaid
sequenceDiagram
    participant Client
    participant RestHandler as "Rest::handler"
    participant GetBearer as "Rest::getBearerToken"
    participant OpCtrl as "OperacionesCtrl"
    participant ApiboxLib
    participant DB as "apibox table"
    participant Config as "ConfigCorp"
    
    Client->>RestHandler: HTTP Request<br/>Authorization: Bearer {token}
    RestHandler->>GetBearer: Extract token from header
    GetBearer-->>RestHandler: Public key string
    
    RestHandler->>OpCtrl: CompararToken(pkey)
    OpCtrl->>ApiboxLib: Comparar(pkey)
    ApiboxLib->>DB: SELECT * WHERE publica='...'
    DB-->>ApiboxLib: Token record(s)
    ApiboxLib-->>OpCtrl: Token data array
    
    alt Token Found
        OpCtrl-->>RestHandler: Token array
        
        RestHandler->>RestHandler: Check activo == 1
        
        alt Token Active
            RestHandler->>Config: Get CFG_LGIN_APT (timeout)
            Config-->>RestHandler: timeout_minutes (default 60)
            
            RestHandler->>RestHandler: Calculate expiry<br/>fecha + timeout_minutes
            
            alt Token Not Expired
                RestHandler->>RestHandler: Set auten = true
                RestHandler->>RestHandler: Process request
            else Token Expired
                RestHandler-->>Client: HTTP 401<br/>{"err":"Expired token"}
            end
        else Token Disabled
            RestHandler-->>Client: HTTP 401<br/>{"err":"Disabled token"}
        end
    else Token Not Found
        RestHandler-->>Client: HTTP 401<br/>{"err":"Invalid token"}
    end
```

**Sources:** [src/ctrls/Rest.php:114-163](), [src/ctrls/OperacionesCtrl.php:804-818](), [src/libs/Apibox/ApiboxLib.php:84-99]()

### Token Lifecycle Management

**Token States:**
| State | `activo` Value | Description |
|-------|----------------|-------------|
| Active | 1 | Token valid for API requests |
| Disabled | 0 | Token revoked, cannot be used |

**Token Expiration:**
- Tokens expire after configurable timeout (default 60 minutes)
- Expiration calculated from `apibox.fecha` field
- Timeout configured via `CFG_LGIN_APT` in corporate config

**Token Refresh:**
- Force new token with `forcenew: true` parameter
- Deletes old token and generates new RSA key pair
- Updates `apibox` record with new keys and timestamp

**Sources:** [src/ctrls/Rest.php:129-142](), [src/ctrls/OperacionesCtrl.php:737-750]()

### ApiboxLib Token Operations

The `ApiboxLib` class provides CRUD operations for token management:

| Method | Purpose | Database Table |
|--------|---------|----------------|
| `Crear($d)` | Insert new token | `apibox` |
| `Actualizar($d)` | Delete old + create new | `apibox` |
| `Obtener($d)` | Retrieve token by user ID | `apibox` |
| `Comparar($d)` | Validate token by public key | `apibox` |
| `Eliminar($d)` | Delete token by user ID | `apibox` |
| `EliminarTodo()` | Delete all tokens | `apibox` |

**Database Schema:**
```sql
CREATE TABLE apibox (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuarios_id INT,
    publica TEXT,      -- RSA public key PEM
    privada TEXT,      -- RSA private key PEM
    activo TINYINT,    -- 1=active, 0=disabled
    fecha DATETIME     -- Creation timestamp
)
```

**Sources:** [src/libs/Apibox/ApiboxLib.php:1-131]()

---

## LDAP Corporate Authentication

For enterprise environments, GESFINANCIERO supports LDAP authentication allowing users to authenticate against corporate Active Directory or LDAP servers.

### LDAP Configuration

LDAP settings are stored in corporate configuration:

| Config Key | Description | Example |
|------------|-------------|---------|
| `ldapurl` | LDAP server URL | `ldap://ad.company.com` |
| `ldapdmn` | Domain name | `company.com` |
| `ldap_bse` | Base DN for searches | `DC=company,DC=com` |

### LDAP Authentication Flow

```mermaid
sequenceDiagram
    participant Client
    participant HomeCtrl
    participant OpHomeCtrl as "OperacionesHomeCtrl"
    participant LDAP as "LDAP Server"
    participant Config as "ConfigCorp"
    participant DB as "userselecto table"
    
    Client->>HomeCtrl: Login with username + password
    HomeCtrl->>OpHomeCtrl: LoginLdapUsur(u, c)
    
    OpHomeCtrl->>Config: LeerConfigCorp()
    Config-->>OpHomeCtrl: ldapurl, ldapdmn, ldap_bse
    
    OpHomeCtrl->>LDAP: ldap_connect(adServer)
    LDAP-->>OpHomeCtrl: LDAP connection
    
    OpHomeCtrl->>LDAP: ldap_bind(username@domain, password)
    
    alt Bind Successful
        LDAP-->>OpHomeCtrl: Bind OK
        
        OpHomeCtrl->>LDAP: ldap_search(sAMAccountName=username)
        LDAP-->>OpHomeCtrl: User entry from AD
        
        OpHomeCtrl->>OpHomeCtrl: ldap_get_entries()
        
        OpHomeCtrl->>DB: Check if user exists in userselecto
        DB-->>OpHomeCtrl: User not found
        
        OpHomeCtrl-->>Client: Exception<br/>"Existe en corporación<br/>pero no en Evolusign"
        
    else Bind Failed
        LDAP-->>OpHomeCtrl: Bind failed
        OpHomeCtrl-->>Client: Exception<br/>"Invalid email/password"
    end
```

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:335-383]()

### LDAP Authentication Implementation

**LDAP Connection Setup:**
```php
// From OperacionesHomeCtrl::LoginLdapUsur
$ldap = ldap_connect($adServer);
$ldaprdn = $username . "@" . $ldapdomain;

ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

$bind = @ldap_bind($ldap, $ldaprdn, $password);
```

**LDAP Search Filter:**
```php
$filter = "(sAMAccountName=$username)";
$result = ldap_search($ldap, $adBase, $filter);
$info = ldap_get_entries($ldap, $result);
```

**Important Notes:**
1. LDAP authentication validates credentials but does NOT create local user accounts
2. Users must pre-exist in `userselecto` table
3. If LDAP succeeds but user not in local DB, authentication fails
4. Error suppression (`@ldap_bind`) silences connection errors

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:342-383]()

---

## Password Recovery and Account Activation

The system provides secure password recovery using temporary activation codes sent via email.

### Password Recovery Flow

```mermaid
graph TB
    subgraph "Step 1: Request Code"
        CLIENT1["User enters email"]
        RECOVERY["RecuperarByEmailAjax"]
        VALIDATE["Validate email format"]
        CHECKUSER["Query usuarios table"]
        DELETEOLD["Delete old codes<br/>codigoactiva"]
        GENCODE["Generate 6-char code<br/>Utiles::nuevoCl(6)"]
        SAVECODE["Save to codigoactiva<br/>activo=0"]
    end
    
    subgraph "Step 2: Email Delivery"
        TEMPLATE["Load template<br/>nuevaclave.html"]
        REPLACEVAR["Replace {$CLAVE_TMP}"]
        SENDEMAIL["enviarCustomEmail"]
        EMAILDELIVER["Email with code"]
    end
    
    subgraph "Step 3: Validate Code"
        CLIENT2["User submits code"]
        RECUASIGNAR["RecuAsignarClaveAjax"]
        CHECKCODE["Query codigoactiva<br/>WHERE nombre=code<br/>AND md5(userselecto_id)=key"]
        CHECKACTIVE["Check activo == 0<br/>(not used)"]
        CHECKTIME["Check created within<br/>10 minutes"]
    end
    
    subgraph "Step 4: Update Password"
        MARKUSED["Set activo=1"]
        UPDATEPWD["Update usuarios.clave<br/>clave=MD5(newPassword)"]
        SUCCESS["Return success"]
    end
    
    CLIENT1 --> RECOVERY
    RECOVERY --> VALIDATE
    VALIDATE --> CHECKUSER
    CHECKUSER --> DELETEOLD
    DELETEOLD --> GENCODE
    GENCODE --> SAVECODE
    
    SAVECODE --> TEMPLATE
    TEMPLATE --> REPLACEVAR
    REPLACEVAR --> SENDEMAIL
    SENDEMAIL --> EMAILDELIVER
    
    EMAILDELIVER --> CLIENT2
    CLIENT2 --> RECUASIGNAR
    RECUASIGNAR --> CHECKCODE
    CHECKCODE --> CHECKACTIVE
    CHECKACTIVE --> CHECKTIME
    
    CHECKTIME --> MARKUSED
    MARKUSED --> UPDATEPWD
    UPDATEPWD --> SUCCESS
```

**Sources:** [src/ctrls/OperacionesCtrl.php:952-1035](), [src/ctrls/OperacionesCtrl.php:1062-1116]()

### Temporary Code Generation

**Code Generation Algorithm:**
```php
// From OperacionesCtrl::RecuperarByEmailAjax
$tmpCl = Utiles::nuevoCl(6);  // 6-character random code

// Retry loop to handle collisions
$i_ctrl = 0;
do {
    $ca->setNombre($tmpCl);
    $ca->setActivo(0);
    $ca->setUserselecto_id($usr["id"]);
    $ca->setFecha(date("Y-m-d H:i:s"));
    
    $r = $ca->saveData();
    if (strlen($ca->obtenerError()) > 0) {
        // Code collision, generate new one
        $nuevaClave = true;
    }
    $i_ctrl++;
    if($i_ctrl >= 20) break;  // Max 20 attempts
} while($nuevaClave);
```

**Database Schema:**
```sql
CREATE TABLE codigoactiva (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(6),        -- Temporary code
    activo TINYINT,           -- 0=unused, 1=used
    userselecto_id INT,       -- User reference
    fecha DATETIME            -- Creation timestamp
)
```

**Sources:** [src/ctrls/OperacionesCtrl.php:979-1001]()

### Code Validation Rules

| Validation | Rule | Error Message |
|------------|------|---------------|
| **Code Exists** | Must match `nombre` + `md5(userselecto_id)` | "Código inexistente" |
| **Not Used** | `activo` must equal 0 | "Código ya utilizado" |
| **Time Valid** | Created within last 10 minutes | "Código inactivo por no usar en los últimos 10 minutos" |

**Code Expiration Check:**
```php
$horaAct = date("Y-m-d H:i:s");
$horaReg = strtotime('+10 minutes', strtotime($aExist["fecha"]));

if ($horaAct > date("Y-m-d H:i:s", $horaReg)) {
    throw new Exception("Código inactivo por no usar...");
}
```

**Mark Code as Used:**
```php
$aa->setActivo(1);
$r2 = $aa->updateData();
```

**Sources:** [src/ctrls/OperacionesCtrl.php:1076-1089]()

### Account Activation for Public Portal

Similar to password recovery, the public portal (`home.php`) uses temporary codes for account activation:

```mermaid
sequenceDiagram
    participant User
    participant HomeCtrl
    participant OpHomeCtrl as "OperacionesHomeCtrl"
    participant Singleton
    participant CodeActiva as "codigoactiva table"
    participant Email
    
    User->>HomeCtrl: Request activation
    HomeCtrl->>OpHomeCtrl: LoginUsurCod(email)
    
    OpHomeCtrl->>Singleton: Query userselecto by email
    Singleton-->>OpHomeCtrl: User record
    
    OpHomeCtrl->>OpHomeCtrl: Generate random code<br/>Utiles::nuevoCl()
    
    OpHomeCtrl->>CodeActiva: INSERT code record<br/>activo=0
    
    OpHomeCtrl->>Email: Send activation email<br/>Template: nuevaclavehome.phtml
    Email-->>User: Email with code
    
    User->>HomeCtrl: Submit code + email
    HomeCtrl->>OpHomeCtrl: LoginUsur(u, c)
    
    OpHomeCtrl->>OpHomeCtrl: activarCuenta(code, userID)
    OpHomeCtrl->>CodeActiva: Query WHERE nombre=code<br/>AND userselecto_id=id
    
    alt Code Valid and Not Expired
        CodeActiva-->>OpHomeCtrl: Code record
        OpHomeCtrl->>OpHomeCtrl: Check created within 1 year
        OpHomeCtrl-->>HomeCtrl: Return true
        HomeCtrl-->>User: Authentication success
    else Code Invalid/Expired
        OpHomeCtrl-->>User: Exception with error
    end
```

**Key Differences from Password Recovery:**
- Uses `userselecto` table instead of `usuarios`
- Codes valid for 1 year instead of 10 minutes
- Does NOT mark code as used (can be reused)
- Used for authentication, not password reset

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:37-68](), [src/ctrls/OperacionesHomeCtrl.php:111-185](), [src/ctrls/OperacionesHomeCtrl.php:217-239]()

---

## Email Notification System

All authentication flows leverage the email notification system for sending activation codes and recovery links.

### Email Template System

**Template Variables:**
```php
// From OperacionesCtrl::ObtenerEtiquetasEmail
$tpl = array(
    'corto' => Config::URLBASE,           // Configured URL
    'b' => $baseUrl,                       // Full base URL
    'u' => $baseUrl . "home.php",          // Home URL
    'i' => $baseUrl . "index.php",         // Index URL
    'f' => date("YmdHis"),                 // Timestamp
    'logo64' => base64_encode($logoFile),  // Corporate logo
    'now_day' => date('d'),                // Current day
    'now_month' => date('m'),              // Current month
    'now_year' => date('Y'),               // Current year
    'now_hour' => date('H'),               // Current hour
    'now_mins' => date('i'),               // Current minute
    'now_secs' => date('s'),               // Current second
    'now_date' => date('Y-m-d'),           // Current date
    'now_time' => date('H:i:s'),           // Current time
    'now_datetime' => date('Y-m-d H:i:s')  // Current datetime
);
```

**Template Syntax:**
```html
<!-- Variables use {$variable_name} syntax -->
<p>Your temporary code is: {$CLAVE_TMP}</p>
<p>Visit {$u} to activate your account</p>
<p>Generated on {$now_datetime}</p>
```

**Sources:** [src/ctrls/OperacionesCtrl.php:251-289]()

### Email Delivery Methods

GESFINANCIERO supports two email delivery methods:

| Method | Configuration | Use Case |
|--------|---------------|----------|
| **Local SMTP** | PHPMailer with local server | Default, self-hosted |
| **External Service** | HTTP API with base64 payload | Third-party email service |

**Configuration Check:**
```php
$_CFG_SMTP_TFSERVICE = filter_var($cfg[self::CFG_SMTP_TFSERVICE]["val"], FILTER_VALIDATE_BOOLEAN);

if (!$_CFG_SMTP_TFSERVICE) {
    // Use local PHPMailer
    $correo = new Correo();
    $correo->enviar();
} else {
    // Use external API
    $url = rtrim($_CFG_SMTP_TFSERVICEURL, "/") . "/" . md5('Api/Servidor/NotificaByMail');
    // POST base64-encoded email data
}
```

**Sources:** [src/ctrls/OperacionesCtrl.php:324-411]()

---

## Security Considerations and Best Practices

### Critical Security Issues

**1. SQL Injection Vulnerabilities**

Multiple authentication methods use string concatenation for SQL queries:

```php
// VULNERABLE CODE - Direct string concatenation
$extra = "where (mail = '" . $u . "' or usuario = '" . $u . "') and clave = md5('" . $c . "')";
```

**Affected Methods:**
- [src/ctrls/OperacionesCtrl.php:567]() - `AutenticaUsuarioSisAjax`
- [src/ctrls/OperacionesHomeCtrl.php:203]() - `LoginUsrsExtra`
- [src/ctrls/OperacionesHomeCtrl.php:280]() - `LoginUsur`
- [src/ctrls/OperacionesHomeCtrl.php:432]() - `LoginAsUsur`

**Recommendation:** Migrate all authentication queries to use `Singleton::_safeSelect` with parameterized queries.

**2. Weak Password Hashing**

Passwords stored using MD5 hashing:

```php
// WEAK - MD5 is cryptographically broken
AND clave = md5('" . $c . "')
```

**Issues:**
- MD5 vulnerable to rainbow table attacks
- No salt used
- Fast computation enables brute force

**Recommendation:** Migrate to PHP's `password_hash()` with bcrypt or Argon2:
```php
// Secure alternative
password_hash($password, PASSWORD_ARGON2ID)
password_verify($password, $hash)
```

**3. LDAP Error Suppression**

LDAP bind errors suppressed with `@`:

```php
$bind = @ldap_bind($ldap, $ldaprdn, $password);
```

**Issue:** Silent failures make debugging difficult and hide connection problems.

**Recommendation:** Remove error suppression and implement proper error logging.

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:351]()

### Authentication Token Security

**RSA Key Security:**

| Aspect | Implementation | Security Level |
|--------|----------------|----------------|
| Key Size | 2048-bit RSA | ✓ Adequate |
| Digest Algorithm | SHA-512 | ✓ Strong |
| Private Key Protection | Passphrase (email+timestamp) | ⚠️ Predictable |
| Key Storage | Database plaintext | ⚠️ No encryption at rest |

**Token Expiration:**
- Default 60-minute timeout is reasonable
- Configurable via `CFG_LGIN_APT`
- Expiration properly enforced in REST handler

**Concerns:**
1. Private keys stored unencrypted in database
2. Passphrase based on predictable data (email + timestamp)
3. No key rotation policy implemented

**Sources:** [src/ctrls/OperacionesCtrl.php:621-643](), [src/ctrls/Rest.php:129-142]()

### Temporary Code Security

**Activation Code Analysis:**

| Property | Value | Assessment |
|----------|-------|------------|
| Code Length | 6 characters | ⚠️ Relatively weak (36^6 combinations) |
| Character Set | Alphanumeric | Limited entropy |
| Expiration | 10 minutes (recovery)<br/>1 year (activation) | ⚠️ Home codes never expire effectively |
| Rate Limiting | None | ❌ Vulnerable to brute force |
| Reuse Prevention | Recovery only | ⚠️ Home codes reusable |

**Vulnerabilities:**
1. No rate limiting on code submission
2. Home activation codes valid for 1 year
3. Only 6 characters = 2.2 billion combinations (feasible to brute force)
4. No account lockout after failed attempts

**Recommendations:**
1. Implement rate limiting (max 5 attempts per 15 minutes)
2. Increase code length to 8-10 characters
3. Add account lockout after repeated failures
4. Reduce home activation expiry to 24-48 hours
5. Implement single-use codes for all flows

**Sources:** [src/ctrls/OperacionesCtrl.php:979-1001](), [src/ctrls/OperacionesHomeCtrl.php:37-68]()

### Configuration Security

**Hardcoded Credentials:**

Critical security issue - database and SMTP credentials hardcoded in `Corporation.php`:

```php
// From repo/corp/Corporation.php (not shown but referenced)
const DB_HOST = "localhost";
const DB_USER = "username";
const DB_PASS = "password";
const SMTP_USER = "smtp_user";
const SMTP_PASS = "smtp_password";
```

**Issues:**
1. Credentials in version control
2. Same credentials across all environments
3. No secrets management
4. Difficult to rotate credentials

**Recommendation:** 
- Move all credentials to environment variables
- Use `.env` files (excluded from git)
- Implement secrets management (Vault, AWS Secrets Manager)
- Different credentials per environment

**Sources:** Referenced throughout [src/ctrls/OperacionesCtrl.php]() via `Corporation` class constants

---

## Authentication Method Summary

### Method Comparison Matrix

| Feature | Session Auth | REST Bearer Token | LDAP Auth | Temp Code |
|---------|--------------|-------------------|-----------|-----------|
| **Entry Point** | index.php | REST API | home.php | home.php |
| **User Table** | usuarios | usuarios | userselecto | usuarios/userselecto |
| **Credential Storage** | MD5 in DB | RSA keys in apibox | LDAP server | Temp codes in codigoactiva |
| **Token Expiry** | PHP session | 60 min (config) | None | 10 min / 1 year |
| **Use Case** | Interactive UI | API integrations | SSO | Recovery/Activation |
| **Security Level** | ⚠️ Medium (MD5) | ✓ High (RSA) | ✓ High (LDAP) | ⚠️ Medium |

### Code Entity Reference

| Authentication Component | Primary Class/Method | Database Table |
|--------------------------|----------------------|----------------|
| **Session Login** | `OperacionesCtrl::AutenticaUsuarioSisAjax` | `usuarios` |
| **Token Generation** | `OperacionesCtrl::GenerarToken` | `apibox` |
| **Token Validation** | `OperacionesCtrl::CompararToken` | `apibox` |
| **Token Storage** | `ApiboxLib::Crear` | `apibox` |
| **LDAP Authentication** | `OperacionesHomeCtrl::LoginLdapUsur` | `userselecto` |
| **Password Recovery** | `OperacionesCtrl::RecuperarByEmailAjax` | `codigoactiva` |
| **Password Reset** | `OperacionesCtrl::RecuAsignarClaveAjax` | `usuarios` |
| **Account Activation** | `OperacionesHomeCtrl::activarCuenta` | `codigoactiva` |
| **Email Notifications** | `OperacionesCtrl::enviarCustomEmail` | N/A |
| **REST Handler** | `Rest::handler` | N/A |

**Sources:** [src/ctrls/OperacionesCtrl.php](), [src/ctrls/OperacionesHomeCtrl.php](), [src/ctrls/Rest.php](), [src/libs/Apibox/ApiboxLib.php]()

---

---

## 10.1 Authentication System

## Purpose and Scope

This document describes the authentication mechanisms implemented in GESFINANCIERO. The system provides multiple authentication methods to support different client types and use cases: traditional session-based authentication for web interfaces, REST API Bearer token authentication, LDAP integration for corporate environments, and email-based account activation.

For information about API token storage and management, see [Token Management](#10.2). For account activation and password recovery workflows, see [Account Activation and Recovery](#10.3).

## Authentication Architecture Overview

GESFINANCIERO implements a multi-layered authentication architecture supporting four distinct authentication contexts:

| Authentication Context | Entry Point | Primary Handler | Use Case |
|------------------------|-------------|-----------------|----------|
| Main Application (AJAX) | `index.php` | `OperacionesCtrl::AutenticaUsuarioSisAjax` | Authenticated admin/user sessions |
| REST API | `index.php` via `Rest::handler()` | Bearer Token validation | External API integrations |
| Public Home | `home.php` | `OperacionesHomeCtrl::LoginUsur` | Public user access |
| LDAP Corporate | `home.php` | `OperacionesHomeCtrl::LoginLdapUsur` | Enterprise directory integration |

### Authentication Flow Architecture

```mermaid
flowchart TB
    subgraph "Entry Points"
        INDEX["index.php"]
        HOME["home.php"]
    end
    
    subgraph "Authentication Handlers"
        INDEXCTRL["IndexCtrl"]
        REST["Rest::handler()"]
        HOMECTRL["HomeCtrl"]
    end
    
    subgraph "Authentication Methods"
        AUTH_AJAX["AutenticaUsuarioSisAjax<br/>(user/pass)"]
        AUTH_B64["AutenticaUsuarioSisAjaxB64<br/>(Base64 encoded)"]
        AUTH_TOKEN["CompararToken<br/>(Bearer Token)"]
        AUTH_HOME["LoginUsur<br/>(email + temp code)"]
        AUTH_LDAP["LoginLdapUsur<br/>(LDAP bind)"]
    end
    
    subgraph "Token System"
        GEN_TOKEN["GenerarToken"]
        CMP_TOKEN["CompararToken"]
        APIBOX["ApiboxLib"]
    end
    
    subgraph "Data Layer"
        DB_USUARIOS["usuarios table"]
        DB_USERSELECTO["userselecto table"]
        DB_APIBOX["apibox table"]
        DB_CODIGOACTIVA["codigoactiva table"]
    end
    
    INDEX --> INDEXCTRL
    INDEX --> REST
    HOME --> HOMECTRL
    
    INDEXCTRL --> AUTH_AJAX
    INDEXCTRL --> AUTH_B64
    REST --> AUTH_TOKEN
    HOMECTRL --> AUTH_HOME
    HOMECTRL --> AUTH_LDAP
    
    AUTH_AJAX --> DB_USUARIOS
    AUTH_TOKEN --> CMP_TOKEN
    CMP_TOKEN --> APIBOX
    APIBOX --> DB_APIBOX
    AUTH_HOME --> DB_USERSELECTO
    AUTH_HOME --> DB_CODIGOACTIVA
    AUTH_LDAP --> DB_USERSELECTO
    
    GEN_TOKEN --> APIBOX
```

**Sources:** [src/ctrls/OperacionesCtrl.php:505-595](), [src/ctrls/OperacionesHomeCtrl.php:254-322](), [src/ctrls/Rest.php:114-275]()

## Main System Authentication

The primary authentication mechanism for the main application uses the `AutenticaUsuarioSisAjax` method, which validates user credentials against the `usuarios` table.

### AutenticaUsuarioSisAjax Method

```mermaid
flowchart LR
    INPUT["Input:<br/>u: username/email<br/>c: password<br/>md5Met: bool"]
    
    subgraph "Authentication Logic"
        CHECK_METHOD{"md5Met?"}
        QUERY_MD5["Query: md5(concat(usuario, clave))"]
        QUERY_DIRECT["Query: mail/usuario + md5(c)"]
    end
    
    subgraph "Validation"
        CHECK_COUNT{"Count > 0?"}
        CHECK_DUP{"Count > 1?"}
        REMOVE_PWD["unset(clave)"]
    end
    
    subgraph "Response"
        SUCCESS["Return user data"]
        ERR_DUP["Exception:<br/>ERR_COD_MSJ_ERR_COMUN"]
        ERR_INVALID["Exception:<br/>ERR_COD_USUARIO_O_CLAVE_INVALIDA"]
    end
    
    INPUT --> CHECK_METHOD
    CHECK_METHOD -->|true| QUERY_MD5
    CHECK_METHOD -->|false| QUERY_DIRECT
    QUERY_MD5 --> CHECK_COUNT
    QUERY_DIRECT --> CHECK_COUNT
    CHECK_COUNT -->|false| ERR_INVALID
    CHECK_COUNT -->|true| CHECK_DUP
    CHECK_DUP -->|true| ERR_DUP
    CHECK_DUP -->|false| REMOVE_PWD
    REMOVE_PWD --> SUCCESS
```

**Sources:** [src/ctrls/OperacionesCtrl.php:560-595]()

### Authentication Methods

#### Direct Authentication (md5Met = false)

Authenticates using username/email and password:

```php
// Query pattern from OperacionesCtrl.php:567
$extra = "where (mail = '" . $u . "' or usuario = '" . $u . "') and clave = md5('" . $c . "')";
```

**Parameters:**
- `u` (string): Username or email address
- `c` (string): Plain text password (hashed with MD5 in query)

**Sources:** [src/ctrls/OperacionesCtrl.php:560-568]()

#### MD5 Hash Authentication (md5Met = true)

Authenticates using pre-computed MD5 hash:

```php
// Query pattern from OperacionesCtrl.php:565
$extra = "where md5(concat(usuario, clave)) = '" . $u . "'";
```

**Parameters:**
- `u` (string): MD5 hash of concatenated username and password hash

**Sources:** [src/ctrls/OperacionesCtrl.php:565]()

#### Base64 Encoded Authentication

The `AutenticaUsuarioSisAjaxB64` wrapper accepts Base64-encoded JSON credentials:

```mermaid
sequenceDiagram
    participant Client
    participant AutenticaUsuarioSisAjaxB64
    participant AutenticaUsuarioSisAjax
    participant Seguridad
    participant Database
    
    Client->>AutenticaUsuarioSisAjaxB64: params (Base64 JSON)
    AutenticaUsuarioSisAjaxB64->>AutenticaUsuarioSisAjaxB64: base64_decode(params)
    AutenticaUsuarioSisAjaxB64->>AutenticaUsuarioSisAjaxB64: json_decode(decoded)
    
    alt qlgn_sesion = false
        AutenticaUsuarioSisAjaxB64->>AutenticaUsuarioSisAjax: u, c
        AutenticaUsuarioSisAjax->>Database: Validate credentials
        Database-->>AutenticaUsuarioSisAjax: User data
        AutenticaUsuarioSisAjax-->>AutenticaUsuarioSisAjaxB64: User data
        AutenticaUsuarioSisAjaxB64-->>Client: User data
    else qlgn_sesion = true
        AutenticaUsuarioSisAjaxB64->>Seguridad: loginAdmin(u, c)
        Seguridad-->>AutenticaUsuarioSisAjaxB64: true/false
        AutenticaUsuarioSisAjaxB64-->>Client: true/false
    end
```

**Sources:** [src/ctrls/OperacionesCtrl.php:505-534]()

### Response Format

Successful authentication returns all user fields from the `usuarios` table, excluding the `clave` field:

```php
// From OperacionesCtrl.php:587
unset($db_chkusr[0]["clave"]);
return $db_chkusr[0];
```

**Typical Response Fields:**
- `id` - User ID
- `usuario` - Username
- `mail` - Email address
- `perfil_id` - Profile/role ID
- `estado_id` - User state ID
- Additional user profile fields

**Sources:** [src/ctrls/OperacionesCtrl.php:587-588]()

## REST API Authentication

The REST API uses Bearer token authentication managed through the `Rest::handler()` method. This provides stateless authentication for API clients.

### REST Handler Authentication Flow

```mermaid
flowchart TB
    REQUEST["HTTP Request<br/>PATH_INFO set"]
    
    subgraph "Token Extraction"
        GET_BEARER["getBearerToken()"]
        CHECK_TOKEN{"Token present?"}
        GET_BASIC["getAuthBasic()"]
    end
    
    subgraph "Token Validation"
        COMPARE["CompararToken(pkey)"]
        CHECK_EXISTS{"Token exists?"}
        CHECK_ACTIVE{"activo = 1?"}
        CHECK_EXPIRY{"Token expired?"}
    end
    
    subgraph "Authorization Results"
        AUTH_SUCCESS["auten = true<br/>Process request"]
        AUTH_FAIL_INVALID["401: Invalid token"]
        AUTH_FAIL_DISABLED["401: Disabled token"]
        AUTH_FAIL_EXPIRED["401: Expired token"]
    end
    
    subgraph "Request Processing"
        PARSE_ENDPOINT["Parse PATH_INFO"]
        DISPATCH["Dispatch to endpoint"]
    end
    
    REQUEST --> GET_BEARER
    GET_BEARER --> CHECK_TOKEN
    CHECK_TOKEN -->|null| GET_BASIC
    CHECK_TOKEN -->|not null| COMPARE
    COMPARE --> CHECK_EXISTS
    CHECK_EXISTS -->|false| AUTH_FAIL_INVALID
    CHECK_EXISTS -->|true| CHECK_ACTIVE
    CHECK_ACTIVE -->|false| AUTH_FAIL_DISABLED
    CHECK_ACTIVE -->|true| CHECK_EXPIRY
    CHECK_EXPIRY -->|true| AUTH_FAIL_EXPIRED
    CHECK_EXPIRY -->|false| AUTH_SUCCESS
    AUTH_SUCCESS --> PARSE_ENDPOINT
    PARSE_ENDPOINT --> DISPATCH
```

**Sources:** [src/ctrls/Rest.php:114-275]()

### Bearer Token Authentication

Bearer tokens are validated against stored RSA public keys in the `apibox` table:

```php
// From Rest.php:123-127
$keytk = self::getBearerToken();
if( $keytk !== null ){
    $cpT = OperacionesCtrl::CompararToken( array( 'pkey' => $keytk ) );
    if ( sizeof( $cpT ) > 0 ) {
        // Token validation logic
    }
}
```

**Token Validation Steps:**

1. **Extract Bearer Token** - From `Authorization: Bearer <token>` header
2. **Compare Token** - `OperacionesCtrl::CompararToken()` checks against stored keys
3. **Verify Active Status** - `activo = 1` in database
4. **Check Expiration** - Token age < `CFG_LGIN_APT` minutes (default 60)

**Sources:** [src/ctrls/Rest.php:123-163]()

### Token Expiration Logic

```php
// From Rest.php:129-142
$cfg = OperacionesCtrl::LeerConfigCorp();
$time = ( isset( $cfg[ OperacionesCtrl::CFG_LGIN_APT ]) ? $cfg[ OperacionesCtrl::CFG_LGIN_APT ]["val"] : "60" );

foreach ($cpT as $cptO) {
    if ( $cptO['activo'] == 1 ) { 
        $horaAct = date("Y-m-d H:i:s");
        $horaReg = strtotime("+{$time} minutes", strtotime( $cptO["fecha"] ));
        if( $horaAct > date("Y-m-d H:i:s", $horaReg) ){
            // Token expired
        }
    }
}
```

**Configuration:**
- `CFG_LGIN_APT` - Token lifetime in minutes (stored in `adminconfig` table)

**Sources:** [src/ctrls/Rest.php:129-142]()

### Basic Authentication Fallback

If no Bearer token is present, the system falls back to HTTP Basic Authentication for the `GenerarToken` endpoint:

```php
// From Rest.php:240-244
if ( !is_null( $ab ) ) {
    if( $ajax == 'GenerarToken' ){
        self::tkn_GenerarToken( array( 'u' => $ab['u'] , 'c' => $ab['c'] ) );
    }
}
```

**Sources:** [src/ctrls/Rest.php:165-166, 240-244]()

### REST Endpoint Authentication

```mermaid
flowchart LR
    subgraph "Public Endpoints (No Token)"
        NOTKN_CHECK["notkn_CheckComm"]
        NOTKN_REV["notkn_Revisar"]
        NOTKN_GESTOR["notkn_GestorDocumental"]
    end
    
    subgraph "Token Required Endpoints"
        TKN_PREFIX["tkn_* methods"]
    end
    
    subgraph "Legacy Hash Endpoints"
        MD5_AUTH["AutenticaUsuarioSis<br/>md5('Api/Servidor/...')"]
        MD5_RECUP["RecuperarByEmail"]
        MD5_ASIGN["RecuAsignarClave"]
    end
    
    REQUEST["REST Request"]
    CHECK_PREFIX{"Method prefix?"}
    
    REQUEST --> CHECK_PREFIX
    CHECK_PREFIX -->|"notkn_"| NOTKN_CHECK
    CHECK_PREFIX -->|"notkn_"| NOTKN_REV
    CHECK_PREFIX -->|"notkn_"| NOTKN_GESTOR
    CHECK_PREFIX -->|"tkn_"| TKN_PREFIX
    CHECK_PREFIX -->|"MD5 hash"| MD5_AUTH
    CHECK_PREFIX -->|"MD5 hash"| MD5_RECUP
    CHECK_PREFIX -->|"MD5 hash"| MD5_ASIGN
```

**Sources:** [src/ctrls/Rest.php:207-215, 246-259]()

## Home/Public Authentication

The home authentication system (`OperacionesHomeCtrl`) handles public-facing user authentication with temporary code-based access.

### LoginUsur Method

Primary authentication method for public users using email and temporary codes:

```mermaid
sequenceDiagram
    participant Client
    participant LoginUsur
    participant ObtenerCorreoPrincipal
    participant Database
    participant activarCuenta
    
    Client->>LoginUsur: u (email), c (code), pase (optional)
    LoginUsur->>ObtenerCorreoPrincipal: dtLlave = u
    ObtenerCorreoPrincipal-->>LoginUsur: Primary email
    LoginUsur->>Database: Query userselecto by mail
    
    alt User not found in userselecto
        LoginUsur->>Database: Query extusers table
        Database-->>LoginUsur: User data
    end
    
    alt pase parameter provided
        LoginUsur->>LoginUsur: Check timestamp expiry
        alt Timestamp valid (< 1 minute old)
            LoginUsur-->>Client: User data (without clave)
        else Timestamp expired
            LoginUsur-->>Client: Exception: Suspected impersonation
        end
    else Standard flow
        LoginUsur->>activarCuenta: Validate temporary code
        activarCuenta-->>LoginUsur: Validation result
        LoginUsur-->>Client: User data (without clave)
    end
```

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:254-322]()

### Email Resolution

Before authentication, the system resolves aliases to primary email addresses:

```php
// From OperacionesHomeCtrl.php:265-273
$rm = OperacionesCtrl::ObtenerCorreoPrincipal( array('dtLlave' => $dtllave ) );
if( sizeof( $rm ) > 0 ){
    foreach ($rm as $_rm) {
        $dtllave = $_rm['mmail'];
    }
}
```

This allows users to authenticate with any registered email alias.

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:265-273]()

### LoginUsurCod - Code Generation

Generates and sends temporary activation codes for email-based authentication:

```mermaid
flowchart TB
    INPUT["u: email address"]
    
    subgraph "User Lookup"
        QUERY["Query userselecto"]
        CHECK_EXISTS{"User exists?"}
    end
    
    subgraph "Code Generation"
        GEN_CODE["Utiles::nuevoCl()"]
        CREATE_CODE["Create codigoactiva record"]
        SEND_EMAIL["actviarSendMail()"]
    end
    
    subgraph "Response"
        SUCCESS["Return: estado=true"]
        FAIL["Return: estado=false"]
    end
    
    INPUT --> QUERY
    QUERY --> CHECK_EXISTS
    CHECK_EXISTS -->|false| FAIL
    CHECK_EXISTS -->|true| GEN_CODE
    GEN_CODE --> CREATE_CODE
    CREATE_CODE --> SEND_EMAIL
    SEND_EMAIL --> SUCCESS
```

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:217-239]()

### Account Activation Validation

The `activarCuenta` method validates temporary codes with 1-year expiration:

```php
// From OperacionesHomeCtrl.php:45-57
$r = Singleton::_readInfo("codigoactiva", "*", 
    "where nombre = '" . $caa . "' and userselecto_id = '" . $key . "'");

$horaAct = date("Y-m-d H:i:s");
$horaReg = strtotime('+1 year', strtotime( $aExist["fecha"] ));

if( $horaAct > date("Y-m-d H:i:s", $horaReg) ){
    throw new Exception("Código inactivo...");
}
```

**Validation Parameters:**
- `c` - Temporary code (6 digits)
- `u` - User ID (userselecto_id)
- Expiration: 1 year from creation

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:37-68]()

## LDAP Integration

Corporate environments can authenticate users against an LDAP directory using the `LoginLdapUsur` method.

### LDAP Authentication Flow

```mermaid
sequenceDiagram
    participant Client
    participant LoginLdapUsur
    participant ConfigCorp
    participant LDAP_Server
    participant Database
    
    Client->>LoginLdapUsur: u (username), c (password)
    LoginLdapUsur->>ConfigCorp: Read LDAP configuration
    ConfigCorp-->>LoginLdapUsur: ldapurl, ldapdmn, ldap_bse
    
    LoginLdapUsur->>LDAP_Server: ldap_connect(adServer)
    LoginLdapUsur->>LDAP_Server: ldap_bind(u@domain, password)
    
    alt Bind successful
        LDAP_Server-->>LoginLdapUsur: Authentication success
        LoginLdapUsur->>LDAP_Server: ldap_search(sAMAccountName)
        LDAP_Server-->>LoginLdapUsur: User details
        LoginLdapUsur->>Database: Check user exists in Evolusign
        alt User not in Evolusign
            LoginLdapUsur-->>Client: Exception: Not in Evolusign
        else User in Evolusign
            LoginLdapUsur-->>Client: Authentication success
        end
    else Bind failed
        LDAP_Server-->>LoginLdapUsur: Authentication failure
        LoginLdapUsur-->>Client: Exception: Invalid credentials
    end
```

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:335-383]()

### LDAP Configuration

Configuration is read from the `adminconfig` table via `LeerConfigCorp()`:

```php
// From OperacionesHomeCtrl.php:336-340
$cfg = self::LeerConfigCorp();

$adServer = $cfg['ldapurl'];
$ldapdomain = $cfg['ldapdmn'];
$adBase = $cfg['ldap_bse'];
```

**Required Configuration Keys:**
- `ldapurl` - LDAP server URL
- `ldapdmn` - LDAP domain name
- `ldap_bse` - LDAP base DN for searches

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:336-340]()

### LDAP Bind and Search

```php
// From OperacionesHomeCtrl.php:342-357
$ldap = ldap_connect($adServer);
$ldaprdn = $username . "@" . $ldapdomain;

ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

$bind = @ldap_bind($ldap, $ldaprdn, $password);

if ($bind) {
    $filter="(sAMAccountName=$username)";
    $result = ldap_search($ldap,$adBase,$filter);
    $info = ldap_get_entries($ldap, $result);
}
```

**LDAP Options:**
- Protocol Version: 3
- Referrals: Disabled (0)
- Search Filter: `sAMAccountName` attribute

**Sources:** [src/ctrls/OperacionesHomeCtrl.php:342-378]()

## Account Recovery and Activation

The system provides email-based account recovery using temporary activation codes stored in the `codigoactiva` table.

### Password Recovery Flow

```mermaid
sequenceDiagram
    participant User
    participant RecuperarByEmailAjax
    participant Database
    participant EmailSystem
    participant RecuAsignarClaveAjax
    
    User->>RecuperarByEmailAjax: emailactivar
    RecuperarByEmailAjax->>Database: Validate email exists
    
    alt Email exists
        RecuperarByEmailAjax->>Database: Delete old codes for user
        RecuperarByEmailAjax->>RecuperarByEmailAjax: Generate 6-digit code
        loop Max 20 attempts
            RecuperarByEmailAjax->>Database: Insert codigoactiva
            alt Duplicate code
                RecuperarByEmailAjax->>RecuperarByEmailAjax: Generate new code
            else Unique code
                RecuperarByEmailAjax->>RecuperarByEmailAjax: Exit loop
            end
        end
        
        RecuperarByEmailAjax->>EmailSystem: Send code via email template
        EmailSystem-->>User: Email with temporary code
        RecuperarByEmailAjax-->>User: Return md5(user_id)
        
        User->>RecuAsignarClaveAjax: codActiva, key, new password
        RecuAsignarClaveAjax->>Database: Validate code and key
        RecuAsignarClaveAjax->>Database: Check code not used (activo=0)
        RecuAsignarClaveAjax->>Database: Check code not expired (<10 min)
        RecuAsignarClaveAjax->>Database: Mark code as used (activo=1)
        RecuAsignarClaveAjax->>Database: Update user password
        RecuAsignarClaveAjax-->>User: Success
    else Email not exists
        RecuperarByEmailAjax-->>User: Exception: Account not found
    end
```

**Sources:** [src/ctrls/OperacionesCtrl.php:952-1035, 1062-1126]()

### RecuperarByEmailAjax Method

Initiates password recovery by generating and emailing a temporary code:

```php
// From OperacionesCtrl.php:968-989
Singleton::_classicDelete("codigoactiva", "where userselecto_id = " . $usr["id"]);

$ca = new Codigoactiva();
$tmpCl = Utiles::nuevoCl(6);

do{ 
    $ca->setNombre($tmpCl);
    $ca->setActivo(0);
    $ca->setUserselecto_id($usr["id"]);
    $ca->setFecha(date("Y-m-d H:i:s"));
    
    $r = $ca->saveData();
    $i_ctrl++;
    if( $i_ctrl >= 20 ) break;
}while($nuevaClave);
```

**Key Features:**
- Deletes existing codes for user
- Generates 6-digit temporary code via `Utiles::nuevoCl(6)`
- Max 20 attempts to find unique code
- Sets `activo=0` (unused state)

**Sources:** [src/ctrls/OperacionesCtrl.php:973-1001]()

### Email Template Processing

```php
// From OperacionesCtrl.php:1003-1012
$tplCode = file_get_contents( self::GET_BASE_MAIL() . DIRECTORY_SEPARATOR . "nuevaclave.html");
$_aed = array('CLAVE_TMP' => $tmpCl);
$replacement_array = self::ObtenerEtiquetasEmail($_aed);

$mensaje = preg_replace_callback(
    '~\{\$(.*?)\}~si',
    function($match) use ($replacement_array) {
        return str_replace($match[0], isset($replacement_array[$match[1]]) ? $replacement_array[$match[1]] : $match[0], $match[0]);
    },
    $tplCode);
```

**Template Variables:**
- `{$CLAVE_TMP}` - Temporary activation code
- Standard variables from `ObtenerEtiquetasEmail()`

**Sources:** [src/ctrls/OperacionesCtrl.php:1003-1012]()

### RecuAsignarClaveAjax Method

Validates temporary code and assigns new password:

```php
// From OperacionesCtrl.php:1072-1089
$r = Singleton::_readInfo("codigoactiva", "*", 
    "where nombre = '" . $caa . "' and md5(userselecto_id) = '" . $key . "'");

if ($aExist["activo"] > 0) throw new Exception("Código ya utilizado.");

$horaAct = date("Y-m-d H:i:s");
$horaReg = strtotime('+10 minutes', strtotime( $aExist["fecha"] ));

if( $horaAct > date("Y-m-d H:i:s", $horaReg) ){
    throw new Exception("Código inactivo por no usar en los últimos 10 minutos.");
}
```

**Validation Rules:**
- Code must exist with matching user ID hash
- `activo` must be 0 (not yet used)
- Code age must be < 10 minutes
- After validation, marks code `activo=1` (used)

**Sources:** [src/ctrls/OperacionesCtrl.php:1072-1115]()

### Password Update

```php
// From OperacionesCtrl.php:1092-1103
$cifl_1 = new Usuarios();
$cifl = $cifl_1->readInfo("*", "where id = " . $aExist["userselecto_id"]);

if( count($cifl) > 0 ){
    $cifl[0]->setClave( md5($cla) );
    $rUss = $cifl[0]->updateData();
    
    if ($rUss > 0) {
        return array( "ok" => true);
    }
}
```

**Sources:** [src/ctrls/OperacionesCtrl.php:1092-1103]()

## Token Management System

For authenticated API access, GESFINANCIERO uses RSA key pairs stored in the `apibox` table. See [Token Management](#10.2) for complete documentation.

### GenerarToken Overview

Creates or retrieves RSA token for authorized users:

```php
// From OperacionesCtrl.php:686-690
$r = self::AutenticaUsuarioSisAjax( $d, $md5 );

if ( isset( $r['ok']) ) {
    $okI = $r['ok'];
    if ( $okI['estado_id'] == 1 ) {
        if ( $okI['perfil_id'] == 1 || $okI['perfil_id'] == 2 || $okI['perfil_id'] == 7 ) {
            // Generate or retrieve token
        }
    }
}
```

**Authorization Requirements:**
- `estado_id = 1` (active user)
- `perfil_id` in [1, 2, 7] (admin, supervisor, or API user roles)

**Sources:** [src/ctrls/OperacionesCtrl.php:674-787]()

### RSA Key Generation

```php
// From OperacionesCtrl.php:622-642
$config = array(
    "digest_alg" => "sha512",
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
);

$res=openssl_pkey_new( $config );

openssl_pkey_export( $res, $privkey , $d['mail'] . date('YmdHis', strtotime( $fecha )) );
$pubkey=openssl_pkey_get_details($res);
$pubkey=$pubkey["key"];

return array( 'pub' => $pubkey , 'pri' => $privkey, 'fecha' => $fecha );
```

**Key Specifications:**
- Algorithm: RSA 2048-bit
- Digest: SHA512
- Private key passphrase: `{email}{YmdHis}`

**Sources:** [src/ctrls/OperacionesCtrl.php:621-643]()

## Security Considerations

### Critical Security Issues

| Issue | Location | Risk Level | Recommendation |
|-------|----------|-----------|----------------|
| MD5 Password Hashing | `OperacionesCtrl::AutenticaUsuarioSisAjax` | **HIGH** | Migrate to bcrypt/argon2 |
| SQL Injection Vulnerability | Direct string concatenation in queries | **CRITICAL** | Use prepared statements exclusively |
| Hardcoded Credentials | `Corporation.php` (not shown) | **CRITICAL** | Move to environment variables |
| Error Information Leakage | Exception messages expose internal details | **MEDIUM** | Implement generic error messages |

**Sources:** [src/ctrls/OperacionesCtrl.php:567-568](), [src/ctrls/OperacionesHomeCtrl.php:203]()

### Authentication Data Flow

```mermaid
flowchart TB
    subgraph "Input Layer"
        USER_INPUT["User Credentials"]
        API_TOKEN["API Bearer Token"]
    end
    
    subgraph "Validation Layer"
        VALIDATE_FORMAT["Format Validation"]
        VALIDATE_TOKEN["Token Validation"]
    end
    
    subgraph "Database Layer"
        DB_QUERY["Database Query<br/><b>VULNERABLE:</b> String concat"]
        DB_USUARIOS["usuarios table"]
        DB_APIBOX["apibox table"]
    end
    
    subgraph "Security Issues"
        SQL_INJECTION["SQL Injection Risk<br/>No prepared statements"]
        MD5_WEAK["Weak MD5 Hashing<br/>Should use bcrypt"]
    end
    
    USER_INPUT --> VALIDATE_FORMAT
    VALIDATE_FORMAT --> DB_QUERY
    DB_QUERY -.->|"Vulnerable"| SQL_INJECTION
    DB_QUERY --> DB_USUARIOS
    DB_USUARIOS -.->|"Weak hash"| MD5_WEAK
    
    API_TOKEN --> VALIDATE_TOKEN
    VALIDATE_TOKEN --> DB_APIBOX
```

**Sources:** [src/ctrls/OperacionesCtrl.php:560-595](), [src/ctrls/Rest.php:114-163]()

### Recommendations

1. **Password Hashing**: Replace MD5 with bcrypt or Argon2
2. **Prepared Statements**: Eliminate all string concatenation in SQL queries
3. **Token Expiration**: Current default of 60 minutes is reasonable but should be configurable per-client
4. **LDAP Security**: Implement connection encryption (LDAPS)
5. **Rate Limiting**: Add rate limiting to prevent brute force attacks
6. **Session Management**: Implement proper session fixation protection

**Sources:** Analysis of [src/ctrls/OperacionesCtrl.php](), [src/ctrls/OperacionesHomeCtrl.php](), [src/ctrls/Rest.php]()

---

---

## 10.2 Token Management

## Purpose and Scope

This document describes the API token management system in GESFINANCIERO, which provides secure authentication for REST API access. The system uses RSA key pairs (public/private keys) to generate and validate authentication tokens that are transmitted as Bearer tokens in HTTP headers.

For information about general authentication mechanisms (user login, sessions), see [Authentication System](#10.1). For account activation and recovery processes, see [Account Activation and Recovery](#10.3).

---

## System Overview

The token management system provides cryptographic authentication for REST API endpoints using RSA-based tokens. Only users with authorized profiles (Admin, Manager, or API User - profiles 1, 2, or 7) can generate API tokens. Each token consists of a public/private RSA key pair that is stored in the `apibox` database table and validated on every REST API request.

**Key Components:**
- **OperacionesCtrl**: Core business logic for token operations (`GenerarToken`, `CompararToken`, `ObtenerToken`)
- **ApiboxLib**: Data access layer for token CRUD operations
- **Rest**: REST API handler that validates Bearer tokens on each request
- **Apibox Model**: Database entity representing stored tokens

Sources: [src/ctrls/OperacionesCtrl.php:674-862](), [src/libs/Apibox/ApiboxLib.php:1-132](), [src/ctrls/Rest.php:114-275]()

---

## Token Architecture

```mermaid
graph TB
    subgraph "Client Layer"
        CLIENT["API Client"]
    end
    
    subgraph "REST Handler Layer"
        REST["Rest::handler()"]
        BEARER["getBearerToken()"]
        AUTHBASIC["getAuthBasic()"]
    end
    
    subgraph "Business Logic Layer"
        GENTOKEN["OperacionesCtrl::GenerarToken()"]
        COMPTOKEN["OperacionesCtrl::CompararToken()"]
        OBTTOKEN["OperacionesCtrl::ObtenerToken()"]
        GENLLAVES["OperacionesCtrl::GenerarLlavePublica()"]
        AUTHUSR["OperacionesCtrl::AutenticaUsuarioSisAjax()"]
    end
    
    subgraph "Data Access Layer"
        APIBOXLIB["ApiboxLib"]
        CREAR["ApiboxLib::Crear()"]
        ACTUALIZAR["ApiboxLib::Actualizar()"]
        OBTENER["ApiboxLib::Obtener()"]
        COMPARAR["ApiboxLib::Comparar()"]
        ELIMINAR["ApiboxLib::Eliminar()"]
    end
    
    subgraph "Database"
        APIBOX_TABLE[("apibox table<br/>id, usuarios_id<br/>publica, privada<br/>activo, fecha")]
    end
    
    CLIENT -->|"POST /GenerarToken<br/>Basic Auth"| REST
    CLIENT -->|"POST /endpoint<br/>Bearer Token"| REST
    
    REST --> BEARER
    REST --> AUTHBASIC
    REST --> COMPTOKEN
    
    AUTHBASIC --> GENTOKEN
    GENTOKEN --> AUTHUSR
    GENTOKEN --> OBTENER
    GENTOKEN --> GENLLAVES
    GENTOKEN --> CREAR
    GENTOKEN --> ACTUALIZAR
    
    BEARER --> COMPTOKEN
    COMPTOKEN --> COMPARAR
    
    OBTTOKEN --> OBTENER
    
    CREAR --> APIBOX_TABLE
    ACTUALIZAR --> ELIMINAR
    ACTUALIZAR --> CREAR
    OBTENER --> APIBOX_TABLE
    COMPARAR --> APIBOX_TABLE
    ELIMINAR --> APIBOX_TABLE
    
    APIBOXLIB --> CREAR
    APIBOXLIB --> ACTUALIZAR
    APIBOXLIB --> OBTENER
    APIBOXLIB --> COMPARAR
    APIBOXLIB --> ELIMINAR
```

**Token Architecture Components**

| Component | File Location | Responsibility |
|-----------|--------------|----------------|
| `Rest::handler()` | src/ctrls/Rest.php | Entry point for REST API requests, validates Bearer tokens |
| `OperacionesCtrl::GenerarToken()` | src/ctrls/OperacionesCtrl.php | Generates or retrieves RSA token for authenticated users |
| `OperacionesCtrl::CompararToken()` | src/ctrls/OperacionesCtrl.php | Validates a public key against stored tokens |
| `OperacionesCtrl::GenerarLlavePublica()` | src/ctrls/OperacionesCtrl.php | Creates RSA key pair using OpenSSL |
| `ApiboxLib` | src/libs/Apibox/ApiboxLib.php | Provides CRUD operations for token storage |
| `apibox` table | Database | Stores RSA key pairs and metadata |

Sources: [src/ctrls/Rest.php:114-167](), [src/ctrls/OperacionesCtrl.php:621-862](), [src/libs/Apibox/ApiboxLib.php:4-131]()

---

## RSA Key Pair Generation

The system generates 2048-bit RSA key pairs using OpenSSL with SHA-512 digest algorithm. Private keys are protected with a passphrase derived from the user's email and timestamp.

### GenerarLlavePublica Method

[src/ctrls/OperacionesCtrl.php:621-643]()

**Function Signature:**
```php
private static function GenerarLlavePublica( $d )
```

**Parameters:**
- `$d['mail']` (string): User's email address used to generate passphrase

**Returns:**
```php
array(
    'pub' => string,   // Public key in PEM format
    'pri' => string,   // Private key in PEM format (encrypted)
    'fecha' => string  // Creation timestamp (Y-m-d H:i:s)
)
```

**OpenSSL Configuration:**

| Parameter | Value | Purpose |
|-----------|-------|---------|
| `digest_alg` | `sha512` | Hash algorithm for key generation |
| `private_key_bits` | `2048` | Key size in bits |
| `private_key_type` | `OPENSSL_KEYTYPE_RSA` | RSA key type |

**Passphrase Format:**
```
{email}{YmdHis}
```
Example: `user@example.com20231215143022`

**Key Format:**
Both public and private keys are stored in PEM (Privacy Enhanced Mail) format with standard BEGIN/END markers.

Sources: [src/ctrls/OperacionesCtrl.php:621-643]()

---

## Token Generation Process

```mermaid
sequenceDiagram
    participant Client
    participant Rest
    participant GenerarToken
    participant AutenticaUsuarioSisAjax
    participant ApiboxLib_Obtener
    participant GenerarLlavePublica
    participant ApiboxLib_Crear
    participant DB as apibox table
    
    Client->>Rest: POST /GenerarToken<br/>Basic Auth (u, c)
    Rest->>GenerarToken: GenerarToken({u, c})
    
    GenerarToken->>AutenticaUsuarioSisAjax: Validate credentials
    alt Invalid Credentials
        AutenticaUsuarioSisAjax-->>Client: 401 Unauthorized
    end
    
    AutenticaUsuarioSisAjax-->>GenerarToken: User data (estado_id, perfil_id)
    
    alt User disabled (estado_id != 1)
        GenerarToken-->>Client: 500 Usuario inhabilitado
    end
    
    alt Unauthorized profile
        GenerarToken-->>Client: 401 Perfil no autorizado<br/>(must be 1, 2, or 7)
    end
    
    GenerarToken->>ApiboxLib_Obtener: Obtener({id: userId})
    ApiboxLib_Obtener->>DB: SELECT * WHERE usuarios_id = ?
    DB-->>ApiboxLib_Obtener: Existing tokens
    
    alt Token exists & forcenew = false
        ApiboxLib_Obtener-->>Client: Return existing public key
    end
    
    alt Token exists & forcenew = true
        GenerarToken->>GenerarLlavePublica: GenerarLlavePublica({mail})
        GenerarLlavePublica-->>GenerarToken: {pub, pri, fecha}
        GenerarToken->>ApiboxLib_Crear: Actualizar({id, key})
        ApiboxLib_Crear->>DB: DELETE old token
        ApiboxLib_Crear->>DB: INSERT new token
        DB-->>Client: Updated public key
    end
    
    alt No token exists
        GenerarToken->>GenerarLlavePublica: GenerarLlavePublica({mail})
        GenerarLlavePublica-->>GenerarToken: {pub, pri, fecha}
        GenerarToken->>ApiboxLib_Crear: Crear({id, key})
        ApiboxLib_Crear->>DB: INSERT INTO apibox
        DB-->>Client: New public key
    end
```

### Authorization Requirements

**Authorized User Profiles:**

| Profile ID | Profile Name | Can Generate Tokens |
|------------|-------------|---------------------|
| 1 | Administrator | ✓ |
| 2 | Manager | ✓ |
| 7 | API User | ✓ |
| Other | Standard Users | ✗ |

**User Status Requirements:**
- `estado_id` must be `1` (Active)
- Account must not be disabled

### Token Generation Parameters

[src/ctrls/OperacionesCtrl.php:674-787]()

**Input Parameters:**
```php
$d = array(
    'u'        => string,  // Username or email
    'c'        => string,  // Password (optional if md5=true)
    'md5'      => bool,    // Use MD5 hash authentication (default: false)
    'forcenew' => bool     // Force generation of new token (default: false)
)
```

**Response Cases:**

| Scenario | HTTP Code | Response |
|----------|-----------|----------|
| New token created | 200 | Public key string |
| Existing token returned | 200 | Existing public key string |
| Token updated | 200 | New public key string |
| Invalid credentials | 401 | Exception message |
| Unauthorized profile | 401 | "Se requiere perfil con autorizado" |
| User disabled | 500 | "Usuario inhabilitado" |

Sources: [src/ctrls/OperacionesCtrl.php:674-787](), [src/libs/Apibox/ApiboxLib.php:9-41]()

---

## Token Validation and Bearer Authentication

The REST API validates Bearer tokens on every request using a multi-step process that checks token existence, activation status, and expiration.

```mermaid
sequenceDiagram
    participant Client
    participant Rest_handler
    participant getBearerToken
    participant CompararToken
    participant ApiboxLib_Comparar
    participant DB as apibox table
    participant Endpoint
    
    Client->>Rest_handler: API Request<br/>Header: Authorization Bearer {token}
    Rest_handler->>getBearerToken: Extract token from header
    getBearerToken-->>Rest_handler: Bearer token string
    
    alt No Bearer token
        Rest_handler->>Rest_handler: Try Basic Auth
    end
    
    Rest_handler->>CompararToken: CompararToken({pkey})
    CompararToken->>ApiboxLib_Comparar: Comparar({pkey})
    ApiboxLib_Comparar->>DB: SELECT * WHERE publica = ?
    
    alt Token not found
        DB-->>Client: 401 Invalid token
    end
    
    DB-->>ApiboxLib_Comparar: Token records
    ApiboxLib_Comparar-->>CompararToken: Token data
    CompararToken-->>Rest_handler: Token validation result
    
    Rest_handler->>Rest_handler: Check activo = 1
    alt Token disabled
        Rest_handler-->>Client: 401 Disabled token
    end
    
    Rest_handler->>Rest_handler: Check expiration<br/>(fecha + CFG_LGIN_APT minutes)
    alt Token expired
        Rest_handler-->>Client: 401 Expired token
    end
    
    Rest_handler->>Endpoint: Route to endpoint handler
    Endpoint-->>Client: API response
```

### Bearer Token Extraction

The REST handler extracts the Bearer token from the `Authorization` HTTP header. The expected format is:
```
Authorization: Bearer {public_key_in_pem_format}
```

[src/ctrls/Rest.php:123]()

### Token Validation Steps

**Step 1: Token Comparison** [src/ctrls/Rest.php:126]()

The system calls `CompararToken()` which queries the `apibox` table for a matching public key.

**Step 2: Activation Check** [src/ctrls/Rest.php:133]()

The token's `activo` field must be `1` (enabled).

**Step 3: Expiration Check** [src/ctrls/Rest.php:134-142]()

```php
$horaAct = date("Y-m-d H:i:s");
$horaReg = strtotime("+{$time} minutes", strtotime($cptO["fecha"]));
if($horaAct > date("Y-m-d H:i:s", $horaReg)) {
    // Token expired
}
```

The expiration time is determined by the `CFG_LGIN_APT` configuration value (default: 60 minutes).

**Validation Error Responses:**

| Error Condition | HTTP Code | Response Body |
|----------------|-----------|---------------|
| Token not found | 401 | `{"err":"Invalid token"}` |
| Token disabled | 401 | `{"err":"Disabled token"}` |
| Token expired | 401 | `{"err":"Expired token"}` |

Sources: [src/ctrls/Rest.php:114-167](), [src/ctrls/OperacionesCtrl.php:804-817]()

---

## CompararToken Method

[src/ctrls/OperacionesCtrl.php:804-817]()

**Function Signature:**
```php
public static function CompararToken ( $d )
```

**Parameters:**
```php
$d = array(
    'pkey' => string  // Public key in PEM format to validate
)
```

**Returns:**
```php
array(
    array(
        'id'          => int,    // Token ID
        'usuarios_id' => int,    // User ID
        'publica'     => string, // Public key
        'activo'      => int,    // 0=disabled, 1=enabled
        'fecha'       => string  // Creation timestamp
    ),
    // ... additional matching tokens
)
```

**Throws:**
- HTTP 401 with exception message if validation fails

This method wraps `ApiboxLib::Comparar()` and is used internally by the REST handler to validate Bearer tokens without requiring prior authentication.

Sources: [src/ctrls/OperacionesCtrl.php:804-817](), [src/libs/Apibox/ApiboxLib.php:84-99]()

---

## Token Lifecycle Management via ApiboxLib

The `ApiboxLib` class provides comprehensive CRUD operations for token management.

### ApiboxLib Methods Overview

| Method | Purpose | Database Operation |
|--------|---------|-------------------|
| `Crear()` | Create new token | INSERT INTO apibox |
| `Actualizar()` | Update existing token | DELETE + INSERT |
| `Obtener()` | Retrieve token by user ID | SELECT WHERE usuarios_id = ? |
| `Comparar()` | Find token by public key | SELECT WHERE publica = ? |
| `Eliminar()` | Delete token by user ID | DELETE WHERE usuarios_id = ? |
| `EliminarTodo()` | Delete all tokens | DELETE WHERE id > 0 |

### Crear (Create)

[src/libs/Apibox/ApiboxLib.php:9-41]()

**Parameters:**
```php
$d = array(
    'id'  => int,    // User ID
    'key' => array(  // RSA key pair from GenerarLlavePublica()
        'pub'   => string,  // Public key PEM
        'pri'   => string,  // Private key PEM
        'fecha' => string   // Timestamp
    )
)
```

**Returns:** Public key string

**Database Fields Set:**
- `usuarios_id`: User ID
- `publica`: Public key in PEM format
- `privada`: Private key in PEM format (encrypted)
- `activo`: Set to 1 (enabled)
- `fecha`: Creation timestamp

### Actualizar (Update)

[src/libs/Apibox/ApiboxLib.php:43-59]()

**Strategy:** Delete existing token, then create new one

**Parameters:**
```php
$d = array(
    'id'  => int,    // User ID
    'key' => array(  // New RSA key pair
        'pub'   => string,
        'pri'   => string,
        'fecha' => string
    )
)
```

**Returns:** Public key string of new token

### Obtener (Retrieve)

[src/libs/Apibox/ApiboxLib.php:61-82]()

**Parameters:**
```php
$d = array(
    'id'      => int,  // User ID
    'privada' => bool  // Include private key (optional, default: false)
)
```

**Returns:** Array of token records (usually one per user)

**Fields Returned:**
- Always: `id`, `usuarios_id`, `publica`, `activo`, `fecha`
- Conditional: `privada` (only if `$d['privada'] = true`)

**Error Codes:**

| Code | Constant | Description |
|------|----------|-------------|
| 601 | `ERR_COD_ABL_SQLERRADO` | SQL query error |
| 602 | `ERR_COD_ABL_RESPUESTA_VACIA` | No token found |

### Eliminar (Delete)

[src/libs/Apibox/ApiboxLib.php:101-115]()

**Parameters:**
```php
$d = array(
    'id' => int  // User ID
)
```

**Returns:** `true` on success

**SQL Executed:**
```sql
DELETE FROM apibox WHERE usuarios_id = ?
```

Sources: [src/libs/Apibox/ApiboxLib.php:1-132]()

---

## Database Schema: apibox Table

The `apibox` table stores RSA token information for API authentication.

**Table Structure:**

| Column | Type | Description | Nullable |
|--------|------|-------------|----------|
| `id` | INT | Primary key, auto-increment | No |
| `usuarios_id` | INT | Foreign key to usuarios table | No |
| `publica` | TEXT | Public key in PEM format | No |
| `privada` | TEXT | Private key in PEM format (encrypted) | No |
| `activo` | TINYINT | Token status: 0=disabled, 1=enabled | No |
| `fecha` | DATETIME | Token creation timestamp | No |

**Indexes:**
- Primary key on `id`
- Unique constraint on `usuarios_id` (one token per user)
- Index on `publica` for Bearer token lookups
- Index on `activo` for filtering active tokens

**Relationships:**
- `usuarios_id` → `usuarios.id` (foreign key)

**Storage Considerations:**
- Public keys are approximately 450 characters (PEM format)
- Private keys are approximately 1700 characters (encrypted PEM format)
- Total storage per token: ~2.2 KB

Sources: [src/libs/Apibox/ApiboxLib.php:28-33](), [src/libs/Apibox/ApiboxLib.php:66-74]()

---

## Token Expiration Configuration

Token expiration is controlled by the `CFG_LGIN_APT` configuration constant, which defines the lifetime of tokens in minutes.

### Configuration Constant

[src/ctrls/OperacionesCtrl.php:130]()

```php
$cfg = OperacionesCtrl::LeerConfigCorp();
$time = isset($cfg[OperacionesCtrl::CFG_LGIN_APT]) 
    ? $cfg[OperacionesCtrl::CFG_LGIN_APT]["val"] 
    : "60";  // Default: 60 minutes
```

**Configuration Storage:**
- Stored in: `adminconfig` table
- Key: Value from `CFG_LGIN_APT` constant
- Format: String representing minutes (e.g., "60", "120")
- Default: 60 minutes if not configured

### Expiration Calculation

The expiration check is performed on each REST API request:

```php
$horaAct = date("Y-m-d H:i:s");  // Current time
$horaReg = strtotime("+{$time} minutes", strtotime($tokenFecha));  // Expiry time

if ($horaAct > date("Y-m-d H:i:s", $horaReg)) {
    // Token has expired
}
```

**Expiration Behavior:**
- Tokens are NOT automatically deleted on expiration
- Expired tokens remain in database with `activo = 1`
- Validation occurs at request time by comparing timestamps
- Users must generate a new token to continue API access after expiration

Sources: [src/ctrls/Rest.php:129-142]()

---

## REST API Token Endpoints

### GenerarToken Endpoint

**Endpoint:** `POST /GenerarToken`  
**Authentication:** HTTP Basic Authentication (username/password)

**Request Format:**
```
POST /GenerarToken HTTP/1.1
Authorization: Basic base64(username:password)
Content-Type: application/json

{
    "forcenew": false  // Optional: force new token generation
}
```

**Response Format:**
```json
"-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA...
-----END PUBLIC KEY-----"
```

**Usage in Code:**

[src/ctrls/Rest.php:241-243]()

```php
if ($ajax == 'GenerarToken') {
    self::tkn_GenerarToken(array('u' => $ab['u'], 'c' => $ab['c']));
}
```

### Token-Protected Endpoints

All endpoints requiring Bearer token authentication use the prefix `tkn_` in their method names.

**Request Format:**
```
POST /{endpoint} HTTP/1.1
Authorization: Bearer {public_key}
Content-Type: application/json

{request_body}
```

**Endpoint Resolution:** [src/ctrls/Rest.php:246-250]()

```php
if ($auten) {
    $tknN = 'tkn_' . $ajax;
    if (method_exists('Rest', $tknN)) {
        self::{$tknN}($input);
    }
}
```

**Example Protected Endpoint:**
```php
private static function tkn_UsuariosGet($data) {
    // Endpoint implementation
    // Token already validated by Rest::handler()
}
```

Sources: [src/ctrls/Rest.php:114-275](), [src/ctrls/Rest.php:229-268]()

---

## Integration with OperacionesCtrl

The `OperacionesCtrl` class provides high-level wrapper methods for token management that are called by both the REST handler and internal business logic.

### ObtenerToken (Internal Method)

[src/ctrls/OperacionesCtrl.php:839-862]()

**Function Signature:**
```php
private static function ObtenerToken ( $d )
```

**Parameters:**
```php
$d = array(
    'id'      => int,   // User ID
    'privada' => bool   // Include private key (optional)
)
```

**Returns:** Array of token data from `ApiboxLib::Obtener()`

**Error Handling:**
- HTTP 401: Database or ApiboxLib errors
- HTTP 402 (ERR_COD_RESPUESTA_SQL_VACIA): No token exists for user

**Use Case:** Internal method used by other operations that need to retrieve token information for business logic purposes (not for external API calls).

### Token Workflow Summary

```mermaid
graph LR
    subgraph "Public Methods"
        GT["GenerarToken()"]
        CT["CompararToken()"]
    end
    
    subgraph "Private Methods"
        OT["ObtenerToken()"]
        GLP["GenerarLlavePublica()"]
    end
    
    subgraph "ApiboxLib"
        CREAR["Crear()"]
        ACT["Actualizar()"]
        OBT["Obtener()"]
        COMP["Comparar()"]
    end
    
    GT --> OT
    GT --> GLP
    GT --> CREAR
    GT --> ACT
    OT --> OBT
    CT --> COMP
```

Sources: [src/ctrls/OperacionesCtrl.php:621-862]()

---

## Security Considerations

### Private Key Protection

**Passphrase Generation:** [src/ctrls/OperacionesCtrl.php:637]()

Private keys are encrypted with a passphrase combining:
1. User's email address
2. Timestamp in `YmdHis` format

**Example:**
```
user@example.com20231215143022
```

**Storage:** Private keys are stored encrypted in the `privada` column and are only retrieved when explicitly requested via `$d['privada'] = true`.

### Token Transmission

**Best Practices:**
- Bearer tokens (public keys) are transmitted in HTTP headers
- Always use HTTPS/TLS for API requests to prevent token interception
- Public keys in PEM format include BEGIN/END markers for validation

### Authorization Checks

**Profile Restrictions:** [src/ctrls/OperacionesCtrl.php:697]()

```php
if ($okI['perfil_id'] == 1 || $okI['perfil_id'] == 2 || $okI['perfil_id'] == 7) {
    // Authorized to generate tokens
} else {
    throw new Exception('Se requiere perfil con autorizado');
}
```

Only administrators, managers, and API users can generate tokens.

### Rate Limiting

**Note:** The current implementation does NOT include rate limiting for token generation or validation. Consider implementing:
- Maximum token generation attempts per time period
- Failed validation attempt tracking
- Automatic token disabling after suspicious activity

Sources: [src/ctrls/OperacionesCtrl.php:674-787](), [src/ctrls/Rest.php:114-167]()

---

## Error Codes and Handling

### HTTP Status Codes

| Code | Scenario | Response Format |
|------|----------|----------------|
| 200 | Successful token generation/validation | Public key or data object |
| 400 | Invalid endpoint or bad request | `{"err":"message"}` |
| 401 | Authentication failure, invalid/expired token | `{"err":"message"}` |
| 500 | Internal server error, user disabled | `{"err":"message"}` |

### ApiboxLib Error Codes

[src/libs/Apibox/ApiboxLib.php:6-7]()

| Code | Constant | Description | Usage |
|------|----------|-------------|-------|
| 601 | `ERR_COD_ABL_SQLERRADO` | SQL query error | Database operation failed |
| 602 | `ERR_COD_ABL_RESPUESTA_VACIA` | Empty response | No token found for user |

### Token Validation Errors

**Invalid Token:** [src/ctrls/Rest.php:156-162]()
```json
{
    "err": "Invalid token"
}
```

**Disabled Token:** [src/ctrls/Rest.php:147-153]()
```json
{
    "err": "Disabled token"
}
```

**Expired Token:** [src/ctrls/Rest.php:136-142]()
```json
{
    "err": "Expired token"
}
```

Sources: [src/libs/Apibox/ApiboxLib.php:6-7](), [src/ctrls/Rest.php:114-167]()

---

## Example Usage Scenarios

### Scenario 1: Generate New Token

```
# Request
POST /GenerarToken HTTP/1.1
Authorization: Basic dXNlcm5hbWU6cGFzc3dvcmQ=
Content-Type: application/json

{}

# Response (200 OK)
"-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEArXTT...
-----END PUBLIC KEY-----"
```

### Scenario 2: Use Token to Access Protected Endpoint

```
# Request
POST /UsuariosGet HTTP/1.1
Authorization: Bearer -----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEArXTT...
-----END PUBLIC KEY-----
Content-Type: application/json

{
    "id": 123
}

# Response (200 OK)
{
    "id": 123,
    "nombre": "John Doe",
    ...
}
```

### Scenario 3: Force Token Regeneration

```
# Request
POST /GenerarToken HTTP/1.1
Authorization: Basic dXNlcm5hbWU6cGFzc3dvcmQ=
Content-Type: application/json

{
    "forcenew": true
}

# Response (200 OK)
"-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA[new_key]...
-----END PUBLIC KEY-----"
```

### Scenario 4: Token Expiration

```
# Request (token created 61+ minutes ago)
POST /UsuariosGet HTTP/1.1
Authorization: Bearer [expired_token]

# Response (401 Unauthorized)
{
    "err": "Expired token"
}
```

Sources: [src/ctrls/Rest.php:114-275](), [src/ctrls/OperacionesCtrl.php:674-787]()

---

---

## 10.3 Account Activation and Recovery

This document describes the account activation and password recovery mechanisms in GESFINANCIERO. These systems provide secure, email-based workflows for new user account activation and password reset operations using temporary one-time codes.

For general authentication mechanisms, see [Authentication System](#10.1). For API token management, see [Token Management](#10.2).

---

## Purpose and Scope

The account activation and recovery system handles two primary workflows:

1. **Account Activation**: Validates new user accounts via email confirmation with temporary codes
2. **Password Recovery**: Enables users to reset forgotten passwords through email-based verification

Both workflows rely on temporary codes stored in the `codigoactiva` table, email notification templates, and time-based expiration policies.

---

## System Architecture Overview

The activation and recovery system consists of three main components distributed across different controllers based on the application context (authenticated admin vs. public home).

```mermaid
graph TB
    subgraph "Entry Points"
        HOME["home.php<br/>Public Access"]
        INDEX["index.php<br/>Admin Access"]
    end
    
    subgraph "Controller Layer"
        HOMECTRL["HomeCtrl<br/>Public Controller"]
        INDEXCTRL["IndexCtrl<br/>Admin Controller"]
    end
    
    subgraph "Business Logic - Home Operations"
        OPHOME["OperacionesHomeCtrl"]
        ACT_CUENTA["activarCuenta()<br/>Validates activation codes"]
        SEND_MAIL["actviarSendMail()<br/>Sends activation email"]
        LOGIN_COD["LoginUsurCod()<br/>Requests activation code"]
    end
    
    subgraph "Business Logic - Admin Operations"
        OPCTRL["OperacionesCtrl"]
        RECUPERAR["RecuperarByEmailAjax()<br/>Password recovery init"]
        ASIGNAR["RecuAsignarClaveAjax()<br/>Password reset completion"]
        COD_ADD["codigoactiva_Add()<br/>Generic code generator"]
    end
    
    subgraph "Data Layer"
        CODIGOACTIVA["Codigoactiva Model<br/>src/modelo/Codigoactiva.php"]
        SINGLETON["Singleton<br/>Database Access"]
        DB[("codigoactiva table<br/>Temp code storage")]
    end
    
    subgraph "Email System"
        EMAIL_TMPL["Email Templates<br/>nuevaclave.html<br/>nuevaclavehome.phtml"]
        CUSTOM_EMAIL["enviarCustomEmail()<br/>SMTP/External service"]
    end
    
    HOME --> HOMECTRL
    INDEX --> INDEXCTRL
    
    HOMECTRL --> OPHOME
    INDEXCTRL --> OPCTRL
    
    OPHOME --> ACT_CUENTA
    OPHOME --> SEND_MAIL
    OPHOME --> LOGIN_COD
    
    OPCTRL --> RECUPERAR
    OPCTRL --> ASIGNAR
    OPCTRL --> COD_ADD
    
    ACT_CUENTA --> SINGLETON
    SEND_MAIL --> CODIGOACTIVA
    LOGIN_COD --> SEND_MAIL
    
    RECUPERAR --> CODIGOACTIVA
    ASIGNAR --> CODIGOACTIVA
    COD_ADD --> CODIGOACTIVA
    
    CODIGOACTIVA --> SINGLETON
    SINGLETON --> DB
    
    SEND_MAIL --> EMAIL_TMPL
    RECUPERAR --> EMAIL_TMPL
    COD_ADD --> EMAIL_TMPL
    
    EMAIL_TMPL --> CUSTOM_EMAIL
```

**Sources:**
- [src/ctrls/OperacionesCtrl.php:952-1035]()
- [src/ctrls/OperacionesCtrl.php:1062-1126]()
- [src/ctrls/OperacionesHomeCtrl.php:37-68]()
- [src/ctrls/OperacionesHomeCtrl.php:111-185]()

---

## Account Activation Flow

Account activation is used for new user registration to verify email ownership. The process uses longer-lived codes (1 year expiration) suitable for email confirmation links.

### Activation Process Sequence

```mermaid
sequenceDiagram
    actor User
    participant Home as home.php
    participant HomeCtrl
    participant OpHomeCtrl as OperacionesHomeCtrl
    participant Codigoactiva
    participant DB as codigoactiva table
    participant Email as Email System
    
    User->>Home: Access activation form
    User->>HomeCtrl: Submit email for activation
    HomeCtrl->>OpHomeCtrl: actviarSendMail(emailactivar)
    
    OpHomeCtrl->>OpHomeCtrl: Validate email format
    OpHomeCtrl->>DB: Check existing codes
    
    loop Retry up to 20 times
        OpHomeCtrl->>OpHomeCtrl: Generate 6-digit code<br/>Utiles::nuevoCl()
        OpHomeCtrl->>Codigoactiva: saveData()
        Codigoactiva->>DB: INSERT code
        alt Code collision
            DB-->>OpHomeCtrl: Duplicate key error
            OpHomeCtrl->>OpHomeCtrl: Generate new code
        else Success
            DB-->>OpHomeCtrl: Code saved
        end
    end
    
    OpHomeCtrl->>Email: Send activation email<br/>Template: nuevaclavehome.phtml
    Email-->>User: Email with 6-digit code
    
    OpHomeCtrl-->>HomeCtrl: Return MD5(user_id)
    HomeCtrl-->>User: Success message
    
    User->>Home: Enter activation code
    HomeCtrl->>OpHomeCtrl: activarCuenta(code, user_id)
    OpHomeCtrl->>DB: SELECT code WHERE<br/>nombre=code AND<br/>userselecto_id=user_id
    
    alt Code exists and valid
        DB-->>OpHomeCtrl: Code record
        OpHomeCtrl->>OpHomeCtrl: Check expiration<br/>(fecha + 1 year)
        alt Not expired
            OpHomeCtrl-->>HomeCtrl: true
            HomeCtrl-->>User: Account activated
        else Expired
            OpHomeCtrl-->>HomeCtrl: Exception: Code expired
        end
    else Code not found
        OpHomeCtrl-->>HomeCtrl: Exception: Code invalid
    end
```

**Sources:**
- [src/ctrls/OperacionesHomeCtrl.php:111-185]()
- [src/ctrls/OperacionesHomeCtrl.php:37-68]()

### Key Functions: Account Activation

| Function | Location | Purpose |
|----------|----------|---------|
| `actviarSendMail()` | [OperacionesHomeCtrl.php:111-185]() | Generates activation code, stores in DB, sends email |
| `activarCuenta()` | [OperacionesHomeCtrl.php:37-68]() | Validates activation code and expiration time |
| `LoginUsurCod()` | [OperacionesHomeCtrl.php:217-239]() | Requests activation code for existing user |
| `Utiles::nuevoCl()` | Called from activation methods | Generates random numeric codes |

### Activation Code Generation Logic

The code generation process includes retry logic to handle collisions:

```php
// Pseudocode from actviarSendMail
$i_ctrl = 0;
$tmpCl = Utiles::nuevoCl();  // 6-digit code
$nuevaClave = false;

do {
    $ca->setNombre($tmpCl);
    $ca->setActivo(0);
    $ca->setUserselecto_id($usr["id"]);
    $ca->setFecha(date("Y-m-d H:i:s"));
    
    $ca->saveData();
    
    if (error exists) {
        $nuevaClave = true;  // Try again
    } else {
        $nuevaClave = false;  // Success
    }
    
    $i_ctrl++;
    if ($i_ctrl >= 20) break;  // Max 20 attempts
    
} while ($nuevaClave);
```

**Sources:**
- [src/ctrls/OperacionesHomeCtrl.php:132-154]()

---

## Password Recovery Flow

Password recovery allows existing users to reset forgotten passwords. This workflow uses shorter-lived codes (10 minutes) for enhanced security.

### Recovery Process Sequence

```mermaid
sequenceDiagram
    actor User
    participant Index as index.php
    participant IndexCtrl
    participant OpCtrl as OperacionesCtrl
    participant Codigoactiva
    participant DB as codigoactiva table
    participant Usuarios
    participant Email as Email System
    
    User->>Index: Request password reset
    IndexCtrl->>OpCtrl: RecuperarByEmailAjax(emailactivar)
    
    OpCtrl->>OpCtrl: Validate email format
    OpCtrl->>DB: SELECT FROM usuarios<br/>WHERE mail=email
    
    alt User not found
        DB-->>OpCtrl: Empty result
        OpCtrl-->>IndexCtrl: Exception: Account not found
    else User exists
        DB-->>OpCtrl: User record
        
        OpCtrl->>DB: DELETE old codes<br/>WHERE userselecto_id=user_id
        
        loop Generate unique code (max 20 attempts)
            OpCtrl->>OpCtrl: Generate 6-digit code<br/>Utiles::nuevoCl(6)
            OpCtrl->>Codigoactiva: saveData()
            Codigoactiva->>DB: INSERT code with activo=0
            alt Duplicate
                DB-->>OpCtrl: Error
            else Success
                DB-->>OpCtrl: Code saved
            end
        end
        
        OpCtrl->>Email: Send recovery email<br/>Template: nuevaclave.html<br/>Variable: CLAVE_TMP
        Email-->>User: Email with 6-digit code
        
        OpCtrl-->>IndexCtrl: Return MD5(user_id)
        IndexCtrl-->>User: Check your email
    end
    
    User->>Index: Submit code + new password
    IndexCtrl->>OpCtrl: RecuAsignarClaveAjax(<br/>codActiva, key, new_password)
    
    OpCtrl->>DB: SELECT FROM codigoactiva<br/>WHERE nombre=code AND<br/>MD5(userselecto_id)=key
    
    alt Code not found
        OpCtrl-->>IndexCtrl: Exception: Invalid code
    else Code found
        DB-->>OpCtrl: Code record
        
        OpCtrl->>OpCtrl: Check if activo > 0
        alt Already used
            OpCtrl-->>IndexCtrl: Exception: Code already used
        else Not used
            OpCtrl->>OpCtrl: Check expiration<br/>(fecha + 10 minutes)
            alt Expired
                OpCtrl-->>IndexCtrl: Exception: Code expired
            else Valid
                OpCtrl->>Codigoactiva: Set activo=1
                Codigoactiva->>DB: UPDATE activo=1
                
                OpCtrl->>Usuarios: Update password<br/>setClave(MD5(new_password))
                Usuarios->>DB: UPDATE usuarios
                
                OpCtrl-->>IndexCtrl: Success: Password updated
                IndexCtrl-->>User: Password reset complete
            end
        end
    end
```

**Sources:**
- [src/ctrls/OperacionesCtrl.php:952-1035]()
- [src/ctrls/OperacionesCtrl.php:1062-1126]()

### Key Functions: Password Recovery

| Function | Location | Purpose |
|----------|----------|---------|
| `RecuperarByEmailAjax()` | [OperacionesCtrl.php:952-1035]() | Initiates recovery, generates code, sends email |
| `RecuAsignarClaveAjax()` | [OperacionesCtrl.php:1062-1126]() | Validates code, updates password |
| `codigoactiva_Add()` | [OperacionesCtrl.php:1452-1519]() | Generic code generator with email sending |

### Password Reset Code Validation

The validation process for password reset codes includes multiple security checks:

| Check | Implementation | Location |
|-------|---------------|----------|
| **Code exists** | Query `codigoactiva` table with code and user key | [OperacionesCtrl.php:1072]() |
| **Not already used** | Check `activo > 0` | [OperacionesCtrl.php:1076]() |
| **Not expired** | Compare `NOW()` vs `fecha + 10 minutes` | [OperacionesCtrl.php:1078-1082]() |
| **User exists** | Verify user ID in `usuarios` table | [OperacionesCtrl.php:1093]() |

**Sources:**
- [src/ctrls/OperacionesCtrl.php:1062-1126]()

---

## Code Generation and Management

### Temporary Code Structure

The system uses the `codigoactiva` table to store temporary verification codes:

| Field | Type | Purpose |
|-------|------|---------|
| `id` | INT | Primary key |
| `nombre` | VARCHAR | The actual code (6 digits) |
| `activo` | INT | 0=unused, 1=used (prevents reuse) |
| `userselecto_id` | INT | Foreign key to user |
| `fecha` | DATETIME | Code creation timestamp |

**Sources:**
- [src/ctrls/OperacionesCtrl.php:979-989]()
- [src/ctrls/OperacionesHomeCtrl.php:132-140]()

### Code Generation Methods

```mermaid
graph LR
    subgraph "Code Generation Entry Points"
        RECUPERAR["RecuperarByEmailAjax()<br/>Password recovery"]
        ACTIVAR["actviarSendMail()<br/>Account activation"]
        GENERICO["codigoactiva_Add()<br/>Generic generator"]
    end
    
    subgraph "Generation Logic"
        UTILES["Utiles::nuevoCl(6)<br/>Generates random digits"]
        RETRY["Retry Loop<br/>Max 20 attempts"]
        MODEL["Codigoactiva Model<br/>saveData()"]
    end
    
    subgraph "Database"
        DB[("codigoactiva table<br/>Unique constraint on nombre")]
    end
    
    RECUPERAR --> UTILES
    ACTIVAR --> UTILES
    GENERICO --> UTILES
    
    UTILES --> RETRY
    RETRY --> MODEL
    MODEL --> DB
    
    DB -.->|Duplicate key error| RETRY
    DB -.->|Success| RETRY
```

**Sources:**
- [src/ctrls/OperacionesCtrl.php:980-1001]()
- [src/ctrls/OperacionesHomeCtrl.php:132-154]()
- [src/ctrls/OperacionesCtrl.php:1469-1488]()

### Collision Handling Strategy

The code generation implements a retry mechanism to handle duplicates:

1. **Generate Code**: Call `Utiles::nuevoCl(6)` to create 6-digit numeric code
2. **Attempt Save**: Try to insert into `codigoactiva` table
3. **Handle Duplicate**: If unique constraint fails, generate new code
4. **Retry Limit**: Maximum 20 attempts to prevent infinite loops
5. **Failure Response**: Return error after 20 failed attempts

This approach assumes code collisions are rare (1 in 1,000,000 for 6 digits) but handles them gracefully when they occur.

**Sources:**
- [src/ctrls/OperacionesCtrl.php:983-1001]()
- [src/ctrls/OperacionesHomeCtrl.php:135-154]()

---

## Email Notification System

### Email Templates

The system uses HTML templates with variable substitution for activation and recovery emails:

| Template | Path | Used For |
|----------|------|----------|
| `nuevaclave.html` | [src/sistema/email/nuevaclave.html]() | Password recovery (admin context) |
| `nuevaclavehome.phtml` | [src/sistema/email/nuevaclavehome.phtml]() | Account activation (public context) |

### Template Variable System

Variables are embedded in templates using the syntax `{$VARIABLE_NAME}` and replaced at runtime:

```php
// Template processing from RecuperarByEmailAjax
$tplCode = file_get_contents("nuevaclave.html");
$_aed = array('CLAVE_TMP' => $tmpCl);
$replacement_array = self::ObtenerEtiquetasEmail($_aed);

$mensaje = preg_replace_callback(
    '~\{\$(.*?)\}~si',
    function($match) use ($replacement_array) {
        return isset($replacement_array[$match[1]]) 
            ? $replacement_array[$match[1]] 
            : $match[0];
    },
    $tplCode
);
```

**Sources:**
- [src/ctrls/OperacionesCtrl.php:1003-1012]()
- [src/ctrls/OperacionesHomeCtrl.php:156-165]()

### Standard Email Variables

The `ObtenerEtiquetasEmail()` method provides standard variables available in all email templates:

| Variable | Description | Example Value |
|----------|-------------|---------------|
| `{$b}` | Base URL | `https://example.com/` |
| `{$u}` | Home URL | `https://example.com/home.php` |
| `{$i}` | Index URL | `https://example.com/index.php` |
| `{$f}` | Timestamp | `20240115123045` |
| `{$corto}` | Configured short URL | From `Config::URLBASE` |
| `{$logo64}` | Base64 encoded logo | Corporate logo image |
| `{$CLAVE_TMP}` | Temporary code | The 6-digit activation code |

**Sources:**
- [src/ctrls/OperacionesCtrl.php:251-288]()
- [src/ctrls/OperacionesHomeCtrl.php:13-24]()

### Email Delivery

Email delivery uses the `enviarCustomEmail()` method which supports both local SMTP and external email services:

```mermaid
graph TB
    CALL["enviarCustomEmail(para, titulo, mensaje)"]
    CHECK_CFG["Check CFG_SMTP_TFSERVICE config"]
    
    LOCAL["Local SMTP<br/>Correo class<br/>PHPMailer"]
    EXTERNAL["External Service<br/>API call via cURL<br/>Base64 encoded payload"]
    
    SMTP_SERVER["SMTP Server<br/>smtp.ipage.com:25"]
    EXT_API["External Email API<br/>TFServices endpoint"]
    
    CALL --> CHECK_CFG
    CHECK_CFG -->|false| LOCAL
    CHECK_CFG -->|true| EXTERNAL
    
    LOCAL --> SMTP_SERVER
    EXTERNAL --> EXT_API
```

**Sources:**
- [src/ctrls/OperacionesCtrl.php:324-412]()
- [src/ctrls/OperacionesHomeCtrl.php:79-99]()

---

## Security Considerations

### Time-Based Expiration

The system uses different expiration policies based on the security context:

| Use Case | Expiration | Rationale |
|----------|-----------|-----------|
| **Account Activation** | 1 year | Low risk - user already registered, just confirming email |
| **Password Recovery** | 10 minutes | High risk - grants password reset capability |

**Implementation:**
```php
// Password recovery: 10 minute expiration
$horaAct = date("Y-m-d H:i:s");
$horaReg = strtotime('+10 minutes', strtotime($aExist["fecha"]));
if ($horaAct > date("Y-m-d H:i:s", $horaReg)) {
    throw new Exception("Code expired");
}

// Account activation: 1 year expiration  
$horaAct = date("Y-m-d H:i:s");
$horaReg = strtotime('+1 year', strtotime($aExist["fecha"]));
if ($horaAct > date("Y-m-d H:i:s", $horaReg)) {
    throw new Exception("Code expired");
}
```

**Sources:**
- [src/ctrls/OperacionesCtrl.php:1078-1082]()
- [src/ctrls/OperacionesHomeCtrl.php:49-53]()

### Single-Use Code Enforcement

Password recovery codes can only be used once, enforced via the `activo` field:

1. **Initial State**: `activo = 0` when code is created
2. **Check Before Use**: Validate `activo = 0` before accepting code
3. **Mark Used**: Set `activo = 1` after successful password reset
4. **Reject Reuse**: Throw exception if `activo > 0`

**Sources:**
- [src/ctrls/OperacionesCtrl.php:1076]()
- [src/ctrls/OperacionesCtrl.php:1086-1089]()

### User Identity Validation

Both workflows use MD5 hashes of user IDs as keys to prevent user enumeration:

```php
// Return MD5 of user ID instead of actual ID
return array("ok" => md5($usr["id"]));

// Validate using MD5 in subsequent requests
$extra = "where nombre = '" . $code . "' and md5(userselecto_id) = '" . $key . "'";
```

This prevents attackers from determining valid user IDs through timing attacks or response analysis.

**Sources:**
- [src/ctrls/OperacionesCtrl.php:1021]()
- [src/ctrls/OperacionesCtrl.php:1072]()

### Old Code Cleanup

Before generating new recovery codes, the system deletes all existing codes for the user:

```php
// Delete old codes before creating new one
Singleton::_classicDelete("codigoactiva", "where userselecto_id = " . $usr["id"]);
```

This prevents accumulation of multiple valid codes and ensures only the most recent code works.

**Sources:**
- [src/ctrls/OperacionesCtrl.php:974]()

---

## Integration with MagicPages System

The activation system can optionally integrate with the MagicPages temporary page system for creating time-limited access links. While not directly called in the provided activation code, the integration point exists through `codigoactiva_Add()`.

### MagicPages Overview

| Feature | Implementation |
|---------|---------------|
| **Temporary URLs** | UUID-based codes for secure temporary pages |
| **Expiration** | 10 minute default expiration |
| **Email Association** | Links tied to specific email addresses |
| **Auto-cleanup** | Expired pages automatically invalid |

**Sources:**
- [src/libs/MagicPages/MagicPagesLib.php:22-60]()
- [src/libs/MagicPages/MagicPagesLib.php:114-132]()

---

## API Endpoints

### Password Recovery Endpoints

| Endpoint | Method | Controller | Function |
|----------|--------|------------|----------|
| `/RecuperarByEmailAjax` | POST | IndexCtrl → OperacionesCtrl | `RecuperarByEmailAjax()` |
| `/RecuAsignarClaveAjax` | POST | IndexCtrl → OperacionesCtrl | `RecuAsignarClaveAjax()` |

**Request Format - Initiate Recovery:**
```json
{
    "emailactivar": "user@example.com",
    "gnrtk": false
}
```

**Response - Initiate Recovery:**
```json
{
    "ok": "5d41402abc4b2a76b9719d911017c592"
}
```

**Request Format - Complete Recovery:**
```json
{
    "codActiva": "123456",
    "key": "5d41402abc4b2a76b9719d911017c592",
    "c": "newpassword123"
}
```

**Response - Complete Recovery:**
```json
{
    "ok": true
}
```

**Sources:**
- [src/ctrls/OperacionesCtrl.php:952-1035]()
- [src/ctrls/OperacionesCtrl.php:1062-1126]()

### Account Activation Endpoints

| Endpoint | Method | Controller | Function |
|----------|--------|------------|----------|
| `/LoginUsurCod` | POST | HomeCtrl → OperacionesHomeCtrl | `LoginUsurCod()` |
| `/activarCuenta` | POST | HomeCtrl → OperacionesHomeCtrl | `activarCuenta()` |

**Request Format - Request Code:**
```json
{
    "u": "user@example.com"
}
```

**Request Format - Activate Account:**
```json
{
    "c": "123456",
    "u": "12"
}
```

**Sources:**
- [src/ctrls/OperacionesHomeCtrl.php:217-239]()
- [src/ctrls/OperacionesHomeCtrl.php:37-68]()

---

## Error Handling

### Common Exception Messages

| Exception | Trigger Condition | HTTP Code |
|-----------|------------------|-----------|
| `"Correo inválido"` | Email fails `FILTER_VALIDATE_EMAIL` | 500 |
| `"Cuenta inexistente"` | User not found in database | 500 |
| `"Código inexistente"` | Code not found in `codigoactiva` table | 500 |
| `"Código ya utilizado"` | Code has `activo > 0` | 500 |
| `"Código inactivo por no usar en los últimos 10 minutos"` | Code expired (password recovery) | 500 |
| `"Usuario no existe en evolusign"` | User ID invalid during password update | 500 |
| `"No es posible actualizar la clave"` | Database update failed | 500 |

### Error Response Format

All activation and recovery methods throw exceptions on error, which are caught by the controller layer and returned as JSON:

```json
{
    "error": "Exception message text",
    "code": 500
}
```

**Sources:**
- [src/ctrls/OperacionesCtrl.php:957-1034]()
- [src/ctrls/OperacionesCtrl.php:1064-1125]()
- [src/ctrls/OperacionesHomeCtrl.php:39-67]()

---

## Database Schema

### codigoactiva Table

```sql
CREATE TABLE codigoactiva (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) UNIQUE NOT NULL,
    activo INT DEFAULT 0,
    userselecto_id INT NOT NULL,
    fecha DATETIME NOT NULL,
    FOREIGN KEY (userselecto_id) REFERENCES userselecto(id)
);
```

**Field Purposes:**
- `nombre`: Stores the 6-digit activation code (must be unique)
- `activo`: 0 = unused, 1 = used (prevents code reuse)
- `userselecto_id`: Links code to specific user
- `fecha`: Creation timestamp for expiration calculation

**Indexes:**
- Primary key on `id`
- Unique index on `nombre` (prevents duplicate codes)
- Foreign key index on `userselecto_id`

**Sources:**
- [src/ctrls/OperacionesCtrl.php:979-989]()
- [src/ctrls/OperacionesHomeCtrl.php:132-140]()

---

## Configuration Dependencies

The activation and recovery system relies on these configuration settings:

| Configuration | Constant | Purpose |
|--------------|----------|---------|
| SMTP Authentication | `CFG_SMTP_AUTHSMTP` | Enable/disable SMTP auth |
| SMTP Host | `CFG_SMTP_HOST` | SMTP server address |
| SMTP Port | `CFG_SMTP_PORT` | SMTP server port |
| SMTP User | `CFG_SMTP_USER` | SMTP authentication username |
| SMTP Password | `CFG_SMTP_PASS` | SMTP authentication password |
| External Service | `CFG_SMTP_TFSERVICE` | Enable external email service |
| Service URL | `CFG_SMTP_TFSERVICEURL` | External service API URL |
| Service Token | `CFG_SMTP_TFSAPITOKEN` | External service auth token |

These settings are retrieved via `OperacionesCtrl::LeerConfigCorp()` from the `adminconfig` table.

**Sources:**
- [src/ctrls/OperacionesCtrl.php:326-330]()
- [src/ctrls/OperacionesCtrl.php:1149-1235]()

---

---

## 11. Deployment and Configuration

This document provides comprehensive guidance for deploying and configuring GESFINANCIERO in production and development environments. It covers system requirements, installation procedures, configuration management, web server setup, and critical security recommendations.

For environment-specific configuration details (database, SMTP, LDAP), see [Environment Configuration](#11.1). For security hardening procedures, see [Security Hardening](#11.2).

---

## Purpose and Scope

This page documents the complete deployment lifecycle of GESFINANCIERO, from initial server setup through production deployment. Key topics include:

- System requirements and prerequisites
- Installation and initial setup procedures
- Configuration management through `Corporation.php`
- Web server configuration for Apache/Nginx
- Module system deployment patterns
- Database initialization and migrations
- Security considerations and hardening steps

---

## System Requirements

### Server Environment

GESFINANCIERO requires the following server environment:

| Component | Requirement | Notes |
|-----------|-------------|-------|
| **PHP** | 7.4 or higher | Required extensions: `mysqli`, `mbstring`, `json`, `ldap` (optional) |
| **Database** | MySQL 5.7+ or MariaDB 10.2+ | Database name: `nuevapp_apps` |
| **Web Server** | Apache 2.4+ or Nginx 1.18+ | Must support URL rewriting |
| **Operating System** | Linux (Ubuntu 20.04+, CentOS 7+) | Windows/macOS supported for development only |
| **Memory** | 512 MB minimum, 2 GB recommended | Depends on concurrent user load |
| **Storage** | 5 GB minimum | Additional space required for file uploads in `repo/` modules |

### PHP Extensions

The application requires the following PHP extensions:

```
- mysqli (database connectivity)
- mbstring (multibyte string handling)
- json (JSON encoding/decoding)
- openssl (encryption and token generation)
- ldap (optional, for LDAP authentication)
- gd or imagick (image processing for avatars)
```

**Sources:** [README.md:19-27](), [repo/corp/Corporation.php:17-20]()

---

## Installation Overview

### Deployment Architecture Diagram

```mermaid
graph TB
    subgraph "Server Environment"
        WEB["Web Server<br/>(Apache/Nginx)"]
        PHP["PHP 7.4+<br/>FastCGI/PHP-FPM"]
        DB["MySQL Database<br/>nuevapp_apps"]
    end
    
    subgraph "Application Files"
        APP["Application Root<br/>/var/www/gesfinanciero"]
        ENTRY["Entry Points<br/>index.php<br/>home.php"]
        CORP["Configuration<br/>repo/corp/Corporation.php"]
        MODULES["Module Directories<br/>repo/anexos/<br/>repo/avatar/<br/>repo/usuarios/<br/>etc."]
        LIBS["Libraries<br/>src/libs/*"]
    end
    
    subgraph "Runtime Data (Ignored by Git)"
        UPLOADS["File Uploads<br/>repo/anexos/*<br/>repo/avatar/*<br/>repo/usuarios/*"]
        TEMP["Temporary Files<br/>repo/proc/*<br/>repo/recursos/*"]
    end
    
    subgraph "External Services (Optional)"
        SMTP["SMTP Server<br/>smtp.ipage.com:25"]
        LDAP["LDAP Directory<br/>Corporate Auth"]
    end
    
    WEB --> PHP
    PHP --> ENTRY
    ENTRY --> CORP
    ENTRY --> MODULES
    ENTRY --> LIBS
    
    PHP --> DB
    PHP --> UPLOADS
    PHP --> TEMP
    
    PHP -.->|sends email| SMTP
    PHP -.->|authenticates| LDAP
    
    CORP -.->|credentials| DB
    CORP -.->|credentials| SMTP
```

**Deployment Architecture**

This diagram shows the relationship between server components, application files, runtime data, and external services.

**Sources:** [README.md:19-27](), [.gitignore:16-29](), [repo/corp/Corporation.php:1-22]()

---

## Installation Steps

### 1. Clone Repository

```bash
# Clone from GitHub
git clone https://github.com/JARDIN-BOTANICO-JCM/gesfinanciero.git /var/www/gesfinanciero

# Set ownership (assuming www-data is the web server user)
sudo chown -R www-data:www-data /var/www/gesfinanciero

# Set appropriate permissions
sudo chmod -R 755 /var/www/gesfinanciero
```

### 2. Create Runtime Directories

The `.gitignore` file tracks only module entry points. Runtime data directories must be created during deployment:

```bash
cd /var/www/gesfinanciero/repo

# Create runtime directories for each module
mkdir -p anexos/uploads
mkdir -p avatar/images
mkdir -p proc/temp
mkdir -p com/data
mkdir -p recursos/files
mkdir -p usuarios/data

# Set write permissions for web server
sudo chown -R www-data:www-data .
sudo chmod -R 775 anexos avatar proc com recursos usuarios
```

**Sources:** [.gitignore:16-29]()

### 3. Install Composer Dependencies

```bash
cd /var/www/gesfinanciero

# Install Composer if not present
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install dependencies (PHPMailer and other libraries)
composer install --no-dev --optimize-autoloader
```

### 4. Database Setup

#### Create Database

```sql
CREATE DATABASE nuevapp_apps CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'rootapps'@'localhost' IDENTIFIED BY 'rootapps';
GRANT ALL PRIVILEGES ON nuevapp_apps.* TO 'rootapps'@'localhost';
FLUSH PRIVILEGES;
```

#### Import Schema

The application requires the following core tables (refer to [Data Models](#5.3) for complete schema):

- `userselecto` - User authentication
- `perfilselecto` - User profiles and roles
- `estadoselecto` - Status tracking
- `apibox` - API token storage
- `codigoactiva` - Account activation codes
- `magicpages` - Temporary secure pages
- `docsestados` - Document status
- `adjuntosflujos` - Workflow attachments

**Sources:** [repo/corp/Corporation.php:17-20]()

---

## Configuration Management

### Corporation Configuration File

The `Corporation` class contains all system-wide configuration constants. This file is located at [repo/corp/Corporation.php]().

```mermaid
graph LR
    CORP["Corporation.php<br/>Configuration Constants"]
    
    subgraph "Database Configuration"
        DB_HOST["HOST = 'db'"]
        DB_USER["DBUSER = 'rootapps'"]
        DB_PASS["DBPASS = 'rootapps'"]
        DB_NAME["DBNAME = 'nuevapp_apps'"]
    end
    
    subgraph "SMTP Configuration"
        SMTP_HOST["MAIL_HOST = 'smtp.ipage.com'"]
        SMTP_PORT["MAIL_PORT = 25"]
        SMTP_USER["MAIL_USERNAME = 'admin@nuevapp.com'"]
        SMTP_PASS["MAIL_PASSWORD = '73cn0l0g1@Info.'"]
        SMTP_AUTH["MAIL_SMTPAUTHE = true"]
        SMTP_SECURE["MAIL_SMTPSECURE = ''"]
    end
    
    subgraph "Email Defaults"
        MAIL_FROM["MAIL_REMITENTE"]
        MAIL_LABEL["MAIL_LABEL_REMITENTE"]
        MAIL_SUBJ["MAIL_SUBJECT"]
    end
    
    CORP --> DB_HOST
    CORP --> DB_USER
    CORP --> DB_PASS
    CORP --> DB_NAME
    
    CORP --> SMTP_HOST
    CORP --> SMTP_PORT
    CORP --> SMTP_USER
    CORP --> SMTP_PASS
    CORP --> SMTP_AUTH
    CORP --> SMTP_SECURE
    
    CORP --> MAIL_FROM
    CORP --> MAIL_LABEL
    CORP --> MAIL_SUBJ
```

**Corporation Configuration Structure**

**Sources:** [repo/corp/Corporation.php:1-22]()

### Configuration Constants Reference

| Constant | Purpose | Default Value | Security Impact |
|----------|---------|---------------|-----------------|
| `CONFIG` | Application configuration flag | `false` | Low |
| `HOST` | Database host address | `'db'` | **Critical** - Hardcoded |
| `DBUSER` | Database username | `'rootapps'` | **Critical** - Hardcoded |
| `DBPASS` | Database password | `'rootapps'` | **Critical** - Hardcoded |
| `DBNAME` | Database name | `'nuevapp_apps'` | **Critical** - Hardcoded |
| `MAIL_HOST` | SMTP server address | `'smtp.ipage.com'` | **High** - Hardcoded |
| `MAIL_PORT` | SMTP server port | `25` | Medium |
| `MAIL_USERNAME` | SMTP authentication username | `'admin@nuevapp.com'` | **High** - Hardcoded |
| `MAIL_PASSWORD` | SMTP authentication password | `'73cn0l0g1@Info.'` | **Critical** - Hardcoded |
| `MAIL_SMTPAUTHE` | SMTP authentication enabled | `true` | Medium |
| `MAIL_SMTPSECURE` | SMTP encryption (TLS/SSL) | `''` (none) | **High** - No encryption |
| `MAIL_REMITENTE` | Default sender email | `'admin@nuevapp.com'` | Low |
| `MAIL_LABEL_REMITENTE` | Default sender name | `'Nuevapp Notify'` | Low |
| `MAIL_SUBJECT` | Default email subject | `''` (empty) | Low |

**Sources:** [repo/corp/Corporation.php:4-15]()

### Modifying Configuration for Deployment

⚠️ **Security Warning:** The default `Corporation.php` contains hardcoded credentials. You **must** modify these for production deployment.

#### Recommended Approach: Environment Variables

While the current implementation uses hardcoded constants, you should create a deployment-specific version that reads from environment variables:

```php
<?php
class Corporation {
    
    const CONFIG = false;
    
    // SMTP Configuration - Read from environment
    const MAIL_SMTPAUTHE = true;
    const MAIL_PORT = 587; // Use TLS port
    const MAIL_HOST = "smtp.yourdomain.com";
    const MAIL_USERNAME = getenv('SMTP_USERNAME') ?: "admin@yourdomain.com";
    const MAIL_PASSWORD = getenv('SMTP_PASSWORD') ?: "";
    const MAIL_SMTPSECURE = "tls"; // Enable TLS encryption
    
    const MAIL_REMITENTE = "noreply@yourdomain.com";
    const MAIL_LABEL_REMITENTE = "GESFINANCIERO Notify";
    const MAIL_SUBJECT = "";
 
    // Database Configuration - Read from environment
    const HOST = getenv('DB_HOST') ?: 'localhost';
    const DBUSER = getenv('DB_USER') ?: 'gesfinanciero_user';
    const DBPASS = getenv('DB_PASS') ?: '';
    const DBNAME = getenv('DB_NAME') ?: 'gesfinanciero_db';
    
}
?>
```

#### Setting Environment Variables

**Apache (.htaccess or VirtualHost):**
```apache
SetEnv DB_HOST "localhost"
SetEnv DB_USER "gesfinanciero_user"
SetEnv DB_PASS "your_secure_password"
SetEnv DB_NAME "gesfinanciero_db"
SetEnv SMTP_USERNAME "smtp_user@domain.com"
SetEnv SMTP_PASSWORD "smtp_secure_password"
```

**Nginx (fastcgi_params):**
```nginx
fastcgi_param DB_HOST "localhost";
fastcgi_param DB_USER "gesfinanciero_user";
fastcgi_param DB_PASS "your_secure_password";
fastcgi_param DB_NAME "gesfinanciero_db";
fastcgi_param SMTP_USERNAME "smtp_user@domain.com";
fastcgi_param SMTP_PASSWORD "smtp_secure_password";
```

**Docker (.env file):**
```env
DB_HOST=db
DB_USER=gesfinanciero_user
DB_PASS=your_secure_password
DB_NAME=gesfinanciero_db
SMTP_USERNAME=smtp_user@domain.com
SMTP_PASSWORD=smtp_secure_password
```

**Sources:** [repo/corp/Corporation.php:1-22]()

---

## Web Server Configuration

### Apache Configuration

#### Virtual Host Configuration

```apache
<VirtualHost *:80>
    ServerName gesfinanciero.yourdomain.com
    DocumentRoot /var/www/gesfinanciero
    
    <Directory /var/www/gesfinanciero>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
        
        # Enable URL rewriting
        RewriteEngine On
        
        # Redirect to HTTPS (recommended for production)
        RewriteCond %{HTTPS} off
        RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
    </Directory>
    
    # Protect sensitive directories
    <DirectoryMatch "^/var/www/gesfinanciero/(repo/corp|src/modelo)">
        Require all denied
    </DirectoryMatch>
    
    ErrorLog ${APACHE_LOG_DIR}/gesfinanciero-error.log
    CustomLog ${APACHE_LOG_DIR}/gesfinanciero-access.log combined
</VirtualHost>

<VirtualHost *:443>
    ServerName gesfinanciero.yourdomain.com
    DocumentRoot /var/www/gesfinanciero
    
    SSLEngine on
    SSLCertificateFile /etc/ssl/certs/gesfinanciero.crt
    SSLCertificateKeyFile /etc/ssl/private/gesfinanciero.key
    
    <Directory /var/www/gesfinanciero>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    # Protect sensitive directories
    <DirectoryMatch "^/var/www/gesfinanciero/(repo/corp|src/modelo)">
        Require all denied
    </DirectoryMatch>
    
    ErrorLog ${APACHE_LOG_DIR}/gesfinanciero-ssl-error.log
    CustomLog ${APACHE_LOG_DIR}/gesfinanciero-ssl-access.log combined
</VirtualHost>
```

#### Required Apache Modules

```bash
sudo a2enmod rewrite
sudo a2enmod ssl
sudo a2enmod headers
sudo systemctl restart apache2
```

### Nginx Configuration

```nginx
server {
    listen 80;
    server_name gesfinanciero.yourdomain.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name gesfinanciero.yourdomain.com;
    
    root /var/www/gesfinanciero;
    index index.php home.php;
    
    ssl_certificate /etc/ssl/certs/gesfinanciero.crt;
    ssl_certificate_key /etc/ssl/private/gesfinanciero.key;
    
    # Security headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    
    # Main entry point routing
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    # Home entry point routing
    location /home {
        try_files $uri $uri/ /home.php?$query_string;
    }
    
    # PHP processing
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
        
        # Pass environment variables
        fastcgi_param DB_HOST $db_host;
        fastcgi_param DB_USER $db_user;
        fastcgi_param DB_PASS $db_pass;
        fastcgi_param DB_NAME $db_name;
    }
    
    # Deny access to sensitive directories
    location ~ ^/(repo/corp|src/modelo) {
        deny all;
        return 403;
    }
    
    # Deny access to .git and other hidden files
    location ~ /\. {
        deny all;
        return 403;
    }
    
    access_log /var/log/nginx/gesfinanciero-access.log;
    error_log /var/log/nginx/gesfinanciero-error.log;
}
```

**Sources:** [README.md:26](), [repo/corp/Corporation.php:17-20]()

---

## Module System Deployment

### Module Directory Structure

The module system uses a pattern where only entry points are tracked in version control, while runtime data is ignored:

```mermaid
graph TB
    subgraph "Tracked in Git"
        ANEXOS_E["repo/anexos/index.php"]
        AVATAR_E["repo/avatar/index.php"]
        PROC_E["repo/proc/index.php"]
        COM_E["repo/com/index.php"]
        RECURSOS_E["repo/recursos/index.php"]
        USUARIOS_E["repo/usuarios/index.php"]
    end
    
    subgraph "Generated at Runtime (Ignored)"
        ANEXOS_D["repo/anexos/*<br/>Attachment uploads"]
        AVATAR_D["repo/avatar/*<br/>User avatar images"]
        PROC_D["repo/proc/*<br/>Processing temp files"]
        COM_D["repo/com/*<br/>Communication data"]
        RECURSOS_D["repo/recursos/*<br/>Resource files"]
        USUARIOS_D["repo/usuarios/*<br/>User-specific data"]
    end
    
    ANEXOS_E -.->|creates| ANEXOS_D
    AVATAR_E -.->|creates| AVATAR_D
    PROC_E -.->|creates| PROC_D
    COM_E -.->|creates| COM_D
    RECURSOS_E -.->|creates| RECURSOS_D
    USUARIOS_E -.->|creates| USUARIOS_D
```

**Module Deployment Pattern**

**Sources:** [.gitignore:16-29]()

### Module Directory Permissions

Each module directory requires specific permissions for runtime operation:

| Module | Directory | Purpose | Required Permissions | Owner |
|--------|-----------|---------|---------------------|-------|
| `anexos` | `repo/anexos/` | Document attachments | `775` (rwxrwxr-x) | `www-data:www-data` |
| `avatar` | `repo/avatar/` | User profile images | `775` (rwxrwxr-x) | `www-data:www-data` |
| `proc` | `repo/proc/` | Processing temp files | `775` (rwxrwxr-x) | `www-data:www-data` |
| `com` | `repo/com/` | Communication data | `775` (rwxrwxr-x) | `www-data:www-data` |
| `recursos` | `repo/recursos/` | Resource files | `775` (rwxrwxr-x) | `www-data:www-data` |
| `usuarios` | `repo/usuarios/` | User-specific data | `775` (rwxrwxr-x) | `www-data:www-data` |

### Deployment Script for Module Directories

```bash
#!/bin/bash
# setup_modules.sh - Initialize module runtime directories

REPO_DIR="/var/www/gesfinanciero/repo"
WEB_USER="www-data"
WEB_GROUP="www-data"

# Array of module names
MODULES=("anexos" "avatar" "proc" "com" "recursos" "usuarios")

for MODULE in "${MODULES[@]}"; do
    MODULE_DIR="$REPO_DIR/$MODULE"
    
    # Create module directory if it doesn't exist
    if [ ! -d "$MODULE_DIR" ]; then
        echo "Creating $MODULE_DIR"
        mkdir -p "$MODULE_DIR"
    fi
    
    # Set ownership
    chown -R "$WEB_USER:$WEB_GROUP" "$MODULE_DIR"
    
    # Set permissions
    chmod 775 "$MODULE_DIR"
    
    echo "✓ Module $MODULE initialized"
done

echo "All modules initialized successfully"
```

**Sources:** [.gitignore:16-29]()

---

## Docker Deployment

### Docker Compose Configuration

For containerized deployment, create a `docker-compose.yml`:

```yaml
version: '3.8'

services:
  web:
    image: php:7.4-apache
    container_name: gesfinanciero-web
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - ./:/var/www/html
      - ./docker/apache/vhost.conf:/etc/apache2/sites-available/000-default.conf
    environment:
      - DB_HOST=db
      - DB_USER=${DB_USER}
      - DB_PASS=${DB_PASS}
      - DB_NAME=${DB_NAME}
      - SMTP_USERNAME=${SMTP_USERNAME}
      - SMTP_PASSWORD=${SMTP_PASSWORD}
    depends_on:
      - db
    networks:
      - gesfinanciero-network

  db:
    image: mysql:8.0
    container_name: gesfinanciero-db
    environment:
      MYSQL_ROOT_PASSWORD: ${MYSQL_ROOT_PASSWORD}
      MYSQL_DATABASE: ${DB_NAME}
      MYSQL_USER: ${DB_USER}
      MYSQL_PASSWORD: ${DB_PASS}
    volumes:
      - db-data:/var/lib/mysql
      - ./docker/mysql/init.sql:/docker-entrypoint-initdb.d/init.sql
    ports:
      - "3306:3306"
    networks:
      - gesfinanciero-network

networks:
  gesfinanciero-network:
    driver: bridge

volumes:
  db-data:
```

### Docker Environment File (.env)

```env
# Database Configuration
DB_HOST=db
DB_USER=gesfinanciero_user
DB_PASS=secure_password_here
DB_NAME=nuevapp_apps
MYSQL_ROOT_PASSWORD=root_password_here

# SMTP Configuration
SMTP_USERNAME=smtp_user@domain.com
SMTP_PASSWORD=smtp_password_here
```

**Sources:** [repo/corp/Corporation.php:17-20](), [README.md:19-27]()

---

## Post-Deployment Verification

### Verification Checklist

After deployment, verify the following:

```mermaid
graph TD
    START["Deployment Complete"]
    
    CHECK1["Verify PHP Version<br/>php -v >= 7.4"]
    CHECK2["Verify Database Connection<br/>Test Corporation::HOST"]
    CHECK3["Verify Module Permissions<br/>Check repo/* directories"]
    CHECK4["Verify Web Server<br/>Access index.php"]
    CHECK5["Verify SMTP<br/>Test email sending"]
    CHECK6["Verify REST API<br/>Test token authentication"]
    CHECK7["Verify File Uploads<br/>Test avatar upload"]
    
    COMPLETE["Deployment Verified"]
    
    START --> CHECK1
    CHECK1 --> CHECK2
    CHECK2 --> CHECK3
    CHECK3 --> CHECK4
    CHECK4 --> CHECK5
    CHECK5 --> CHECK6
    CHECK6 --> CHECK7
    CHECK7 --> COMPLETE
```

**Post-Deployment Verification Flow**

### Database Connection Test

Create a test script `test_db.php` in the application root:

```php
<?php
require_once 'repo/corp/Corporation.php';

try {
    $conn = new mysqli(
        Corporation::HOST,
        Corporation::DBUSER,
        Corporation::DBPASS,
        Corporation::DBNAME
    );
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    echo "Database connection successful!\n";
    echo "Database name: " . Corporation::DBNAME . "\n";
    
    $conn->close();
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
```

### Module Permissions Test

```bash
#!/bin/bash
# test_permissions.sh - Test module directory permissions

REPO_DIR="/var/www/gesfinanciero/repo"
MODULES=("anexos" "avatar" "proc" "com" "recursos" "usuarios")

for MODULE in "${MODULES[@]}"; do
    MODULE_DIR="$REPO_DIR/$MODULE"
    
    if [ -w "$MODULE_DIR" ]; then
        echo "✓ $MODULE is writable"
    else
        echo "✗ $MODULE is NOT writable"
    fi
done
```

**Sources:** [repo/corp/Corporation.php:17-20](), [.gitignore:16-29]()

---

## Security Considerations

### Critical Security Issues

⚠️ **WARNING:** The default configuration has several critical security issues:

| Issue | Location | Severity | Recommendation |
|-------|----------|----------|----------------|
| Hardcoded DB credentials | `Corporation::DBUSER`, `Corporation::DBPASS` | **CRITICAL** | Use environment variables |
| Hardcoded SMTP credentials | `Corporation::MAIL_USERNAME`, `Corporation::MAIL_PASSWORD` | **CRITICAL** | Use environment variables |
| No SMTP encryption | `Corporation::MAIL_SMTPSECURE = ''` | **HIGH** | Enable TLS/SSL |
| Insecure SMTP port | `Corporation::MAIL_PORT = 25` | **HIGH** | Use port 587 (TLS) or 465 (SSL) |
| Configuration in Git | `repo/corp/Corporation.php` tracked | **HIGH** | Externalize configuration |
| Weak database password | `DBPASS = 'rootapps'` | **CRITICAL** | Use strong, random passwords |

### Recommended Security Hardening

See [Security Hardening](#11.2) for detailed security recommendations including:

- Externalizing credentials to environment variables
- Enabling HTTPS/TLS for all connections
- Implementing prepared statements throughout codebase
- Restricting file permissions on sensitive directories
- Configuring firewall rules
- Implementing rate limiting
- Enabling security headers

**Sources:** [repo/corp/Corporation.php:6-20]()

---

## Production Deployment Checklist

### Pre-Deployment

- [ ] Review and update `Corporation.php` with production credentials
- [ ] Test database connectivity
- [ ] Configure SMTP with TLS/SSL encryption
- [ ] Set up SSL certificates for HTTPS
- [ ] Configure firewall rules
- [ ] Set appropriate file permissions
- [ ] Create backup strategy

### Deployment

- [ ] Clone repository to production server
- [ ] Run `composer install --no-dev --optimize-autoloader`
- [ ] Create module runtime directories
- [ ] Import database schema
- [ ] Configure web server (Apache/Nginx)
- [ ] Set environment variables
- [ ] Test all entry points (`index.php`, `home.php`)

### Post-Deployment

- [ ] Verify database connection
- [ ] Verify SMTP email sending
- [ ] Test REST API authentication
- [ ] Test file upload functionality
- [ ] Review error logs
- [ ] Configure monitoring and alerts
- [ ] Document environment-specific settings
- [ ] Create rollback plan

### Security Verification

- [ ] Verify HTTPS is enforced
- [ ] Verify sensitive directories are protected
- [ ] Verify environment variables are set
- [ ] Test API token authentication
- [ ] Review file permissions
- [ ] Audit access logs
- [ ] Test rate limiting (if implemented)

**Sources:** [README.md:1-92](), [repo/corp/Corporation.php:1-22](), [.gitignore:1-30]()

---

## Troubleshooting Common Issues

### Database Connection Errors

**Symptom:** "Connection failed: Access denied for user"

**Causes:**
- Incorrect credentials in `Corporation::DBUSER` or `Corporation::DBPASS`
- Database user not granted privileges
- MySQL not accepting connections from host

**Solution:**
```sql
-- Grant privileges to user
GRANT ALL PRIVILEGES ON nuevapp_apps.* TO 'rootapps'@'localhost';
FLUSH PRIVILEGES;

-- Verify user exists
SELECT User, Host FROM mysql.user WHERE User='rootapps';
```

### Module Permission Errors

**Symptom:** "Failed to write file to repo/avatar/"

**Causes:**
- Incorrect directory ownership
- Insufficient permissions

**Solution:**
```bash
# Fix ownership and permissions
sudo chown -R www-data:www-data /var/www/gesfinanciero/repo
sudo chmod -R 775 /var/www/gesfinanciero/repo/anexos
sudo chmod -R 775 /var/www/gesfinanciero/repo/avatar
sudo chmod -R 775 /var/www/gesfinanciero/repo/usuarios
```

### SMTP Errors

**Symptom:** "SMTP Error: Could not authenticate"

**Causes:**
- Incorrect SMTP credentials
- SMTP server blocking connection
- Missing TLS/SSL configuration

**Solution:**
- Verify `Corporation::MAIL_USERNAME` and `Corporation::MAIL_PASSWORD`
- Enable `Corporation::MAIL_SMTPSECURE = 'tls'`
- Change `Corporation::MAIL_PORT` to `587` (TLS) or `465` (SSL)
- Check firewall allows outbound SMTP connections

### PHP Extension Errors

**Symptom:** "Call to undefined function mysqli_connect()"

**Causes:**
- Missing PHP extensions

**Solution:**
```bash
# Install required PHP extensions
sudo apt-get install php7.4-mysqli php7.4-mbstring php7.4-json php7.4-ldap php7.4-gd
sudo systemctl restart apache2  # or php7.4-fpm for Nginx
```

**Sources:** [repo/corp/Corporation.php:6-20](), [.gitignore:16-29]()

---

## Maintenance and Updates

### Updating the Application

```bash
cd /var/www/gesfinanciero

# Backup current installation
tar -czf ../gesfinanciero-backup-$(date +%Y%m%d).tar.gz .

# Pull latest changes
git pull origin main

# Update dependencies
composer install --no-dev --optimize-autoloader

# Clear application cache (if applicable)
# ...

# Restart web server
sudo systemctl restart apache2  # or nginx
```

### Database Backups

```bash
#!/bin/bash
# backup_database.sh - Daily database backup

BACKUP_DIR="/var/backups/gesfinanciero"
DATE=$(date +%Y%m%d_%H%M%S)
DB_NAME="nuevapp_apps"
DB_USER="rootapps"
DB_PASS="rootapps"

mkdir -p "$BACKUP_DIR"

mysqldump -u"$DB_USER" -p"$DB_PASS" "$DB_NAME" | gzip > "$BACKUP_DIR/db_backup_$DATE.sql.gz"

# Keep only last 7 days of backups
find "$BACKUP_DIR" -name "db_backup_*.sql.gz" -mtime +7 -delete

echo "Database backup completed: db_backup_$DATE.sql.gz"
```

### Log Rotation

Configure log rotation for application and web server logs:

```
/var/log/nginx/gesfinanciero-*.log {
    daily
    missingok
    rotate 14
    compress
    delaycompress
    notifempty
    create 0640 www-data adm
    sharedscripts
    postrotate
        [ -f /var/run/nginx.pid ] && kill -USR1 `cat /var/run/nginx.pid`
    endscript
}
```

**Sources:** [repo/corp/Corporation.php:17-20](), [README.md:31-46]()

---

This completes the deployment and configuration guide for GESFINANCIERO. For environment-specific details, proceed to [Environment Configuration](#11.1). For security hardening procedures, see [Security Hardening](#11.2).

---

---

## 11.1 Environment Configuration

## Purpose and Scope

This document describes the environment-specific configuration requirements for GESFINANCIERO, including database credentials, SMTP email settings, application constants, and deployment setup. It covers the current configuration architecture (centralized in `Corporation.php`), available configuration parameters, and recommended practices for different deployment environments.

For security recommendations regarding credential externalization and configuration hardening, see [Security Hardening](#11.2). For details on the authentication and token systems that depend on this configuration, see [Authentication System](#10.1) and [Token Management](#10.2).

---

## Configuration Architecture Overview

GESFINANCIERO uses a centralized configuration approach where all system-wide settings are defined as constants in the `Corporation` class.

### Configuration Flow Diagram

```mermaid
graph TB
    subgraph "Configuration Source"
        CORP_FILE["repo/corp/Corporation.php"]
        CORP_CLASS["Corporation Class<br/>Static Constants"]
    end
    
    subgraph "Configuration Categories"
        DB_CONFIG["Database Configuration<br/>HOST, DBUSER, DBPASS, DBNAME"]
        MAIL_CONFIG["SMTP Configuration<br/>MAIL_HOST, MAIL_PORT<br/>MAIL_USERNAME, MAIL_PASSWORD"]
        APP_CONFIG["Application Constants<br/>CONFIG flag<br/>Mail labels"]
    end
    
    subgraph "Consumers"
        SINGLETON["Singleton Class<br/>Database Connections"]
        PHPMAILER["PHPMailer Library<br/>Email Operations"]
        OPCTRL["OperacionesCtrl<br/>Business Logic"]
        OPHOMECTRL["OperacionesHomeCtrl<br/>Home Operations"]
    end
    
    CORP_FILE --> CORP_CLASS
    
    CORP_CLASS --> DB_CONFIG
    CORP_CLASS --> MAIL_CONFIG
    CORP_CLASS --> APP_CONFIG
    
    DB_CONFIG --> SINGLETON
    MAIL_CONFIG --> PHPMAILER
    MAIL_CONFIG --> OPCTRL
    MAIL_CONFIG --> OPHOMECTRL
    APP_CONFIG --> OPCTRL
    
    SINGLETON -.->|"reads Corporation::HOST<br/>Corporation::DBUSER<br/>Corporation::DBPASS<br/>Corporation::DBNAME"| CORP_CLASS
    PHPMAILER -.->|"reads MAIL_* constants"| CORP_CLASS
```

**Sources:** [repo/corp/Corporation.php:1-23]()

---

## Corporation Class Structure

The `Corporation` class serves as the central configuration registry for the entire application. All settings are defined as public constants, making them globally accessible throughout the codebase.

### Configuration Constants Reference

| Constant | Type | Purpose | Current Value |
|----------|------|---------|---------------|
| `CONFIG` | boolean | Application configuration flag | `false` |
| `MAIL_SMTPAUTHE` | boolean | Enable SMTP authentication | `true` |
| `MAIL_PORT` | integer | SMTP server port | `25` |
| `MAIL_HOST` | string | SMTP server hostname | `smtp.ipage.com` |
| `MAIL_USERNAME` | string | SMTP authentication username | `admin@nuevapp.com` |
| `MAIL_PASSWORD` | string | SMTP authentication password | *(sensitive)* |
| `MAIL_SMTPSECURE` | string | SMTP security protocol (TLS/SSL) | `""` (empty) |
| `MAIL_REMITENTE` | string | Default sender email address | `admin@nuevapp.com` |
| `MAIL_LABEL_REMITENTE` | string | Display name for sender | `Nuevapp Notify` |
| `MAIL_SUBJECT` | string | Default email subject | `""` (empty) |
| `HOST` | string | Database server hostname | `db` |
| `DBUSER` | string | Database username | `rootapps` |
| `DBPASS` | string | Database password | *(sensitive)* |
| `DBNAME` | string | Database name | `nuevapp_apps` |

**Sources:** [repo/corp/Corporation.php:4-21]()

---

## Database Configuration

### Connection Parameters

The database connection is configured through four constants in the `Corporation` class:

```
Corporation::HOST     = 'db'              // Database server hostname
Corporation::DBUSER   = 'rootapps'        // Database username  
Corporation::DBPASS   = 'rootapps'        // Database password
Corporation::DBNAME   = 'nuevapp_apps'    // Database name
```

These constants are consumed by the `Singleton` class when establishing database connections.

### Database Connection Flow

```mermaid
graph LR
    CORP["Corporation::HOST<br/>Corporation::DBUSER<br/>Corporation::DBPASS<br/>Corporation::DBNAME"]
    
    SINGLETON["Singleton::__construct()"]
    MYSQLI["MySQLi Connection<br/>new mysqli()"]
    DB[("MySQL Database<br/>nuevapp_apps")]
    
    CORP --> SINGLETON
    SINGLETON --> MYSQLI
    MYSQLI --> DB
    
    SINGLETON -.->|"Reads constants<br/>Creates connection"| CORP
```

### Database Server Requirements

| Component | Requirement |
|-----------|-------------|
| **Database Engine** | MySQL 5.7+ or MariaDB 10.3+ |
| **Character Set** | UTF-8 (utf8mb4 recommended) |
| **Storage Engine** | InnoDB (default) |
| **Required Privileges** | SELECT, INSERT, UPDATE, DELETE, CREATE, ALTER, INDEX |
| **Network Access** | Connection from application server to database server |

### Hostname Configuration

The `HOST` constant is set to `'db'`, which indicates a Docker container environment where services are accessed by their container name. For different deployment scenarios:

- **Docker/Docker Compose:** Use service name (e.g., `'db'`)
- **Local Development:** Use `'localhost'` or `'127.0.0.1'`
- **Remote Database:** Use FQDN or IP address (e.g., `'mysql.example.com'` or `'10.0.1.5'`)
- **Cloud Managed Database:** Use provider's connection string hostname

**Sources:** [repo/corp/Corporation.php:17-20](), README context

---

## SMTP Email Configuration

### Mail Server Parameters

GESFINANCIERO uses PHPMailer for email delivery, configured through the `Corporation` class constants:

```
Corporation::MAIL_HOST         = "smtp.ipage.com"
Corporation::MAIL_PORT         = 25
Corporation::MAIL_USERNAME     = "admin@nuevapp.com"
Corporation::MAIL_PASSWORD     = "73cn0l0g1@Info."
Corporation::MAIL_SMTPAUTHE    = true
Corporation::MAIL_SMTPSECURE   = ""
```

### SMTP Configuration Mapping

```mermaid
graph TB
    subgraph "Corporation Constants"
        MAIL_HOST["MAIL_HOST<br/>smtp.ipage.com"]
        MAIL_PORT["MAIL_PORT<br/>25"]
        MAIL_AUTH["MAIL_SMTPAUTHE<br/>true"]
        MAIL_USER["MAIL_USERNAME<br/>admin@nuevapp.com"]
        MAIL_PASS["MAIL_PASSWORD<br/>(sensitive)"]
        MAIL_SECURE["MAIL_SMTPSECURE<br/>(empty)"]
    end
    
    subgraph "PHPMailer Properties"
        PHP_HOST["PHPMailer->Host"]
        PHP_PORT["PHPMailer->Port"]
        PHP_AUTH["PHPMailer->SMTPAuth"]
        PHP_USER["PHPMailer->Username"]
        PHP_PASS["PHPMailer->Password"]
        PHP_SECURE["PHPMailer->SMTPSecure"]
    end
    
    subgraph "SMTP Server"
        SMTP["smtp.ipage.com:25<br/>External Mail Server"]
    end
    
    MAIL_HOST --> PHP_HOST
    MAIL_PORT --> PHP_PORT
    MAIL_AUTH --> PHP_AUTH
    MAIL_USER --> PHP_USER
    MAIL_PASS --> PHP_PASS
    MAIL_SECURE --> PHP_SECURE
    
    PHP_HOST --> SMTP
    PHP_PORT --> SMTP
    PHP_USER --> SMTP
    PHP_PASS --> SMTP
```

### Email Configuration Parameters

| Parameter | Purpose | Configuration Options |
|-----------|---------|----------------------|
| **MAIL_HOST** | SMTP server hostname | Provider-specific (Gmail: `smtp.gmail.com`, Office365: `smtp.office365.com`) |
| **MAIL_PORT** | SMTP connection port | `25` (unencrypted), `465` (SSL), `587` (TLS) |
| **MAIL_SMTPAUTHE** | Enable authentication | `true` (required for most providers), `false` (open relays) |
| **MAIL_USERNAME** | SMTP account username | Usually the full email address |
| **MAIL_PASSWORD** | SMTP account password | Account password or app-specific password |
| **MAIL_SMTPSECURE** | Security protocol | `""` (none), `"ssl"` (SSL/TLS), `"tls"` (STARTTLS) |
| **MAIL_REMITENTE** | Default sender address | Must be authorized by SMTP account |
| **MAIL_LABEL_REMITENTE** | Sender display name | User-visible name in email clients |

### Common SMTP Provider Configurations

#### Gmail Configuration

```
MAIL_HOST       = "smtp.gmail.com"
MAIL_PORT       = 587
MAIL_SMTPSECURE = "tls"
MAIL_USERNAME   = "your-email@gmail.com"
MAIL_PASSWORD   = "app-specific-password"
```

#### Office 365 Configuration

```
MAIL_HOST       = "smtp.office365.com"
MAIL_PORT       = 587
MAIL_SMTPSECURE = "tls"
MAIL_USERNAME   = "your-email@company.com"
MAIL_PASSWORD   = "account-password"
```

#### AWS SES Configuration

```
MAIL_HOST       = "email-smtp.us-east-1.amazonaws.com"
MAIL_PORT       = 587
MAIL_SMTPSECURE = "tls"
MAIL_USERNAME   = "SMTP-USERNAME"
MAIL_PASSWORD   = "SMTP-PASSWORD"
```

**Security Warning:** The current configuration at [repo/corp/Corporation.php:6-14]() contains plaintext SMTP credentials. This is a critical security vulnerability. Credentials should be externalized to environment variables or secure configuration management systems.

**Sources:** [repo/corp/Corporation.php:6-15]()

---

## Application Constants

### CONFIG Flag

The `CONFIG` constant at [repo/corp/Corporation.php:4]() is a boolean flag currently set to `false`. Based on the codebase analysis, this flag's purpose is not immediately evident from its usage pattern, but it likely controls application-wide configuration or debugging behavior.

**Current Value:** `false`

**Potential Uses:**
- Development vs. production mode switching
- Feature flag for configuration management
- Debug mode toggle

### Email Default Values

The `Corporation` class defines default values for email operations:

```
Corporation::MAIL_SUBJECT          = ""
Corporation::MAIL_LABEL_REMITENTE  = "Nuevapp Notify"
Corporation::MAIL_REMITENTE        = "admin@nuevapp.com"
```

These defaults are used when email operations don't specify custom values. The empty `MAIL_SUBJECT` indicates that email subjects must be provided at send-time.

**Sources:** [repo/corp/Corporation.php:4-15]()

---

## Environment-Specific Setup

### Development Environment

For local development, configure the following settings:

#### Database Configuration

```php
const HOST     = 'localhost';
const DBUSER   = 'dev_user';
const DBPASS   = 'dev_password';
const DBNAME   = 'nuevapp_apps_dev';
```

#### SMTP Configuration (Development)

Option 1 - Use local mail catcher (Mailhog, MailDev):
```php
const MAIL_HOST       = 'localhost';
const MAIL_PORT       = 1025;
const MAIL_SMTPAUTHE  = false;
const MAIL_USERNAME   = '';
const MAIL_PASSWORD   = '';
const MAIL_SMTPSECURE = '';
```

Option 2 - Use real SMTP for integration testing:
```php
const MAIL_HOST       = 'smtp.gmail.com';
const MAIL_PORT       = 587;
const MAIL_SMTPAUTHE  = true;
const MAIL_USERNAME   = 'dev@example.com';
const MAIL_PASSWORD   = 'app-specific-password';
const MAIL_SMTPSECURE = 'tls';
```

### Docker Environment

The current configuration at [repo/corp/Corporation.php:17]() uses `HOST = 'db'`, which is appropriate for Docker Compose where database services are accessed by their service name.

#### Docker Compose Example

```yaml
services:
  web:
    build: .
    ports:
      - "80:80"
    depends_on:
      - db
    environment:
      - DB_HOST=db
      
  db:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: rootapps
      MYSQL_DATABASE: nuevapp_apps
      MYSQL_USER: rootapps
      MYSQL_PASSWORD: rootapps
    volumes:
      - mysql_data:/var/lib/mysql
```

### Production Environment

Production deployments should:

1. **Use separate database server** with restricted access
2. **Enable SMTP security** (TLS/SSL on port 587 or 465)
3. **Use strong, unique passwords** for all services
4. **Implement credential rotation** policies
5. **Enable connection encryption** for all external services

#### Recommended Production Settings

```php
// Production database - use environment variables
const HOST     = getenv('DB_HOST') ?: 'production-db.internal';
const DBUSER   = getenv('DB_USER') ?: 'prod_user';
const DBPASS   = getenv('DB_PASS') ?: '';
const DBNAME   = getenv('DB_NAME') ?: 'nuevapp_apps';

// Production SMTP - use environment variables
const MAIL_HOST       = getenv('SMTP_HOST') ?: 'smtp.example.com';
const MAIL_PORT       = getenv('SMTP_PORT') ?: 587;
const MAIL_SMTPAUTHE  = true;
const MAIL_USERNAME   = getenv('SMTP_USER') ?: '';
const MAIL_PASSWORD   = getenv('SMTP_PASS') ?: '';
const MAIL_SMTPSECURE = 'tls';
```

**Sources:** [repo/corp/Corporation.php:1-23](), README technology stack

---

## Configuration Loading and Access Patterns

### How Configuration is Consumed

```mermaid
graph TB
    subgraph "Configuration Definition"
        CORP_CLASS["Corporation Class<br/>repo/corp/Corporation.php"]
    end
    
    subgraph "Direct Constant Access"
        SINGLETON_ACCESS["Singleton->__construct()<br/>Reads Corporation::HOST<br/>Corporation::DBUSER<br/>Corporation::DBPASS<br/>Corporation::DBNAME"]
        
        EMAIL_ACCESS["OperacionesCtrl->enviar_Notificacion()<br/>OperacionesHomeCtrl->actviarSendMail()<br/>Read Corporation::MAIL_* constants"]
    end
    
    subgraph "Runtime Usage"
        DB_CONN["Database Connection<br/>new mysqli(HOST, USER, PASS, NAME)"]
        MAIL_SEND["PHPMailer Configuration<br/>Set Host, Port, Auth, Credentials"]
    end
    
    CORP_CLASS --> SINGLETON_ACCESS
    CORP_CLASS --> EMAIL_ACCESS
    
    SINGLETON_ACCESS --> DB_CONN
    EMAIL_ACCESS --> MAIL_SEND
```

### Code Access Pattern

Throughout the codebase, configuration values are accessed directly using the static constant syntax:

```php
// Database configuration access
$host = Corporation::HOST;
$user = Corporation::DBUSER;
$pass = Corporation::DBPASS;
$name = Corporation::DBNAME;

// SMTP configuration access
$mail->Host       = Corporation::MAIL_HOST;
$mail->Port       = Corporation::MAIL_PORT;
$mail->SMTPAuth   = Corporation::MAIL_SMTPAUTHE;
$mail->Username   = Corporation::MAIL_USERNAME;
$mail->Password   = Corporation::MAIL_PASSWORD;
$mail->SMTPSecure = Corporation::MAIL_SMTPSECURE;
```

**Sources:** [repo/corp/Corporation.php:1-23](), Singleton and OperacionesCtrl classes

---

## LDAP Configuration

GESFINANCIERO supports LDAP authentication for corporate directory integration. Currently, LDAP configuration is not stored in the `Corporation` class but is managed through database records or hardcoded in the `OperacionesHomeCtrl` class.

### LDAP Configuration Requirements

For LDAP integration to function, the following parameters must be configured:

| Parameter | Description | Example |
|-----------|-------------|---------|
| **LDAP Server** | Directory server hostname | `ldap.company.com` |
| **LDAP Port** | Connection port | `389` (unencrypted), `636` (LDAPS) |
| **Base DN** | Search base distinguished name | `dc=company,dc=com` |
| **Bind DN** | Service account DN (if required) | `cn=service,dc=company,dc=com` |
| **Bind Password** | Service account password | *(sensitive)* |
| **User DN Pattern** | User search pattern | `uid=%s,ou=users,dc=company,dc=com` |

### LDAP Integration Pattern

```mermaid
graph LR
    USER["User Login Attempt"]
    APP["OperacionesHomeCtrl<br/>LoginLdapUsur()"]
    LDAP["LDAP Directory<br/>Corporate Authentication"]
    DB["Local Database<br/>User Records"]
    
    USER --> APP
    APP --> LDAP
    LDAP --> APP
    APP --> DB
    
    APP -.->|"1. Authenticate credentials"| LDAP
    APP -.->|"2. Create/update local user"| DB
```

### LDAP Configuration Location

LDAP settings are typically configured at the organizational level in the database and accessed through the `OperacionesHomeCtrl::LoginLdapUsur()` method. To externalize LDAP configuration, consider adding constants to the `Corporation` class:

```php
// Recommended LDAP constants
const LDAP_ENABLED       = false;
const LDAP_HOST          = 'ldap.company.com';
const LDAP_PORT          = 389;
const LDAP_BASE_DN       = 'dc=company,dc=com';
const LDAP_BIND_DN       = '';
const LDAP_BIND_PASSWORD = '';
const LDAP_USER_PATTERN  = 'uid=%s,ou=users,dc=company,dc=com';
```

**Sources:** OperacionesHomeCtrl class reference, authentication flow analysis

---

## Configuration Migration Path

### Current State: Hardcoded Credentials

The current implementation at [repo/corp/Corporation.php:1-23]() stores all sensitive credentials as hardcoded constants. This approach has significant security implications:

**Security Risks:**
- Credentials stored in version control history
- No separation between environments
- Difficult credential rotation
- Potential exposure through repository access
- Violation of twelve-factor app principles

### Recommended Migration: Environment Variables

To improve security and deployment flexibility, migrate to environment variable-based configuration:

#### Step 1: Create Environment Variable Loader

```php
class Corporation {
    // Database configuration
    const HOST   = self::getEnv('DB_HOST', 'localhost');
    const DBUSER = self::getEnv('DB_USER', 'rootapps');
    const DBPASS = self::getEnv('DB_PASS', '');
    const DBNAME = self::getEnv('DB_NAME', 'nuevapp_apps');
    
    // SMTP configuration
    const MAIL_HOST       = self::getEnv('SMTP_HOST', 'smtp.ipage.com');
    const MAIL_PORT       = self::getEnv('SMTP_PORT', 25);
    const MAIL_USERNAME   = self::getEnv('SMTP_USER', '');
    const MAIL_PASSWORD   = self::getEnv('SMTP_PASS', '');
    const MAIL_SMTPSECURE = self::getEnv('SMTP_SECURE', '');
    
    private static function getEnv($key, $default = null) {
        $value = getenv($key);
        return $value !== false ? $value : $default;
    }
}
```

#### Step 2: Environment File Structure

Create `.env` file (add to `.gitignore`):

```ini
# Database Configuration
DB_HOST=localhost
DB_USER=rootapps
DB_PASS=secure_password_here
DB_NAME=nuevapp_apps

# SMTP Configuration
SMTP_HOST=smtp.gmail.com
SMTP_PORT=587
SMTP_USER=notifications@company.com
SMTP_PASS=app_specific_password
SMTP_SECURE=tls

# Application Configuration
APP_ENV=production
APP_DEBUG=false
```

#### Step 3: Docker Environment Variables

Update Docker Compose configuration:

```yaml
services:
  web:
    environment:
      DB_HOST: db
      DB_USER: ${DB_USER}
      DB_PASS: ${DB_PASS}
      DB_NAME: ${DB_NAME}
      SMTP_HOST: ${SMTP_HOST}
      SMTP_PORT: ${SMTP_PORT}
      SMTP_USER: ${SMTP_USER}
      SMTP_PASS: ${SMTP_PASS}
      SMTP_SECURE: ${SMTP_SECURE}
    env_file:
      - .env
```

#### Step 4: Apache/Nginx Environment Variables

For Apache with mod_env:

```apache
<VirtualHost *:80>
    SetEnv DB_HOST "production-db.internal"
    SetEnv DB_USER "prod_user"
    SetEnv DB_PASS "secure_password"
    SetEnv DB_NAME "nuevapp_apps"
    
    SetEnv SMTP_HOST "smtp.company.com"
    SetEnv SMTP_PORT "587"
    SetEnv SMTP_USER "notify@company.com"
    SetEnv SMTP_PASS "secure_password"
    SetEnv SMTP_SECURE "tls"
</VirtualHost>
```

**Sources:** [repo/corp/Corporation.php:1-23](), security best practices

---

## Configuration Validation

### Pre-Deployment Checklist

Before deploying to any environment, verify the following configuration items:

#### Database Configuration Validation

| Check | Validation Method |
|-------|-------------------|
| **Database connectivity** | Test connection from application server |
| **User privileges** | Verify CREATE, ALTER, SELECT, INSERT, UPDATE, DELETE |
| **Character set** | Confirm UTF-8 (utf8mb4) encoding |
| **Timezone compatibility** | Ensure server and database timezone alignment |
| **Connection limits** | Verify max_connections sufficient for load |

#### SMTP Configuration Validation

| Check | Validation Method |
|-------|-------------------|
| **SMTP connectivity** | Test connection to SMTP host:port |
| **Authentication** | Verify username/password credentials |
| **Security protocol** | Confirm TLS/SSL configuration |
| **Sender authorization** | Test email sending with configured sender |
| **Rate limits** | Check provider's sending limits |

#### Security Configuration Validation

| Check | Validation Method |
|-------|-------------------|
| **No hardcoded credentials** | Audit code for plaintext passwords |
| **Environment isolation** | Separate dev/staging/production configs |
| **Secure transmission** | HTTPS for web, TLS for SMTP, SSL for DB |
| **Access controls** | Firewall rules, network segmentation |
| **Audit logging** | Enable database and application logs |

**Sources:** Best practices, deployment requirements

---

## Troubleshooting Configuration Issues

### Database Connection Errors

**Error:** `mysqli_connect(): (HY000/2002): Connection refused`

**Causes and Solutions:**
1. **Wrong hostname** - Verify `Corporation::HOST` matches actual database server
2. **Firewall blocking** - Check firewall rules allow connection on MySQL port (3306)
3. **Database not running** - Verify MySQL service is active
4. **Wrong credentials** - Confirm `Corporation::DBUSER` and `Corporation::DBPASS`

**Error:** `mysqli_connect(): (HY000/1045): Access denied for user`

**Causes and Solutions:**
1. **Invalid credentials** - Verify username and password in `Corporation` class
2. **Insufficient privileges** - Grant required privileges to database user
3. **Host restrictions** - Update MySQL user host permissions

### SMTP Connection Errors

**Error:** `SMTP Error: Could not connect to SMTP host`

**Causes and Solutions:**
1. **Wrong hostname/port** - Verify `Corporation::MAIL_HOST` and `Corporation::MAIL_PORT`
2. **Firewall blocking** - Allow outbound connections on SMTP port
3. **TLS/SSL mismatch** - Set `Corporation::MAIL_SMTPSECURE` correctly
4. **Port not open** - Common ports: 25, 465 (SSL), 587 (TLS)

**Error:** `SMTP Error: Authentication failed`

**Causes and Solutions:**
1. **Invalid credentials** - Verify `Corporation::MAIL_USERNAME` and `Corporation::MAIL_PASSWORD`
2. **2FA enabled** - Use app-specific password for Gmail/Office365
3. **Less secure apps** - Enable "less secure app access" if using Gmail
4. **Account locked** - Check email provider for security alerts

### Configuration File Not Found

**Error:** `Class 'Corporation' not found`

**Causes and Solutions:**
1. **Missing include** - Ensure [repo/corp/Corporation.php]() is included in bootstrap
2. **Wrong file path** - Verify file exists at expected location
3. **Autoloader issue** - Check autoload configuration includes repo/corp directory

**Sources:** Common error patterns, troubleshooting experience

---

## Summary

GESFINANCIERO's environment configuration is centralized in the `Corporation` class at [repo/corp/Corporation.php](). This class defines all system-wide constants including database credentials, SMTP settings, and application flags.

**Key Configuration Areas:**
- **Database:** MySQL connection parameters (host, username, password, database name)
- **SMTP:** Email server configuration for notification delivery
- **Application:** System-wide constants and feature flags

**Current Implementation Status:**
- Configuration is hardcoded as class constants
- All environments share the same configuration file
- Credentials are stored in plaintext in version control

**Recommended Actions:**
1. Externalize credentials to environment variables
2. Implement environment-specific configuration
3. Remove sensitive data from version control
4. Use secret management systems for production deployments

For implementing these security improvements, see [Security Hardening](#11.2).

**Sources:** [repo/corp/Corporation.php:1-23](), [README.md:19-27]()

---

---

## 11.2 Security Hardening

This page documents security vulnerabilities in the GESFINANCIERO system and provides actionable recommendations for hardening the application before production deployment. It covers credential management, SQL injection prevention, authentication enforcement, and transport security.

For information about the authentication system architecture, see [Authentication System](#10.1). For token management implementation details, see [Token Management](#10.2). For general deployment configuration, see [Environment Configuration](#11.1).

---

## Overview of Security Concerns

The GESFINANCIERO system contains several critical security vulnerabilities that must be addressed before production deployment. These issues fall into four main categories:

| Category | Severity | Impact |
|----------|----------|--------|
| Hardcoded Credentials | **CRITICAL** | Database and SMTP credentials exposed in source code |
| SQL Injection | **HIGH** | Classic query methods vulnerable to injection attacks |
| Authentication Bypass | **MEDIUM** | No-token endpoints accessible without authentication |
| Transport Security | **HIGH** | No HTTPS enforcement in application code |

**Sources:** [repo/corp/Corporation.php:1-23](), [src/datos/Singleton.php:263-353](), [src/ctrls/Rest.php:73-102]()

---

## Critical Issue: Hardcoded Credentials

### Current Implementation

The `Corporation` class contains all system credentials hardcoded as PHP constants:

```mermaid
graph TB
    Corp["Corporation.php<br/>Constants Class"]
    
    subgraph "Exposed Credentials"
        SMTP["SMTP Credentials<br/>MAIL_USERNAME<br/>MAIL_PASSWORD<br/>MAIL_HOST"]
        DB["Database Credentials<br/>DBUSER: rootapps<br/>DBPASS: rootapps<br/>DBNAME: nuevapp_apps<br/>HOST: db"]
    end
    
    Singleton["Singleton<br/>__construct()"]
    PHPMailer["PHPMailer<br/>Email Configuration"]
    Git["Git Repository<br/>PUBLIC ACCESS"]
    
    Corp --> SMTP
    Corp --> DB
    
    DB --> Singleton
    SMTP --> PHPMailer
    
    Corp -.->|"COMMITTED TO"| Git
    
    style Corp fill:#ffcccc
    style Git fill:#ffcccc
```

**Diagram: Hardcoded Credentials Exposure Path**

The credentials are directly embedded in [repo/corp/Corporation.php:6-20]():

- **SMTP Password:** `73cn0l0g1@Info.` on line 10
- **Database User:** `rootapps` on line 18
- **Database Password:** `rootapps` on line 19
- **SMTP Username:** `admin@nuevapp.com` on line 9

These values are loaded by `Singleton` in [src/datos/Singleton.php:24-42]() and referenced throughout the application. Any developer with repository access has full database and email server access.

**Sources:** [repo/corp/Corporation.php:1-23](), [src/datos/Singleton.php:24-42]()

### Recommended Solution

**Step 1: Create Environment Configuration File**

Create a `.env` file (excluded from version control via `.gitignore`) with the following structure:

```
# Database Configuration
DB_HOST=db
DB_NAME=nuevapp_apps
DB_USER=rootapps
DB_PASS=your_secure_password_here

# SMTP Configuration
MAIL_HOST=smtp.ipage.com
MAIL_PORT=25
MAIL_USERNAME=admin@nuevapp.com
MAIL_PASSWORD=your_secure_password_here
MAIL_SMTPAUTH=true
MAIL_SMTPSECURE=
```

**Step 2: Modify Corporation Class**

Replace constant definitions with environment variable reads:

```php
class Corporation {
    const HOST = getenv('DB_HOST') ?: 'db';
    const DBUSER = getenv('DB_USER') ?: 'rootapps';
    const DBPASS = getenv('DB_PASS') ?: '';
    const DBNAME = getenv('DB_NAME') ?: 'nuevapp_apps';
    
    const MAIL_HOST = getenv('MAIL_HOST') ?: 'smtp.ipage.com';
    const MAIL_USERNAME = getenv('MAIL_USERNAME') ?: '';
    const MAIL_PASSWORD = getenv('MAIL_PASSWORD') ?: '';
    // ... etc
}
```

**Step 3: Update .gitignore**

Add to `.gitignore`:
```
.env
repo/corp/Corporation.php
```

**Step 4: Create Template File**

Commit `repo/corp/Corporation.php.template` with placeholder values for deployment reference.

**Sources:** [repo/corp/Corporation.php:1-23]()

---

## SQL Injection Vulnerabilities

### Vulnerable Query Methods

The `Singleton` class exposes both safe (prepared statements) and classic (string concatenation) query methods:

```mermaid
graph LR
    subgraph "UNSAFE - Classic Methods"
        CR["_classicRead<br/>Line 314"]
        CU["_classicUpdate<br/>Line 288"]
        CI["_classicInsert<br/>Line 364"]
        CD["_classicDelete<br/>Line 263"]
    end
    
    subgraph "SAFE - Prepared Statements"
        SS["_safeSelect<br/>Line 786"]
        SU["_safeUpdate<br/>Line 696"]
        SI["_safeInsert<br/>Line 759"]
        SD["_safeDelete<br/>Line 735"]
    end
    
    UserInput["User Input<br/>$_POST, $_GET"]
    SQLQuery["SQL Query"]
    
    UserInput -->|"Direct Concatenation"| CR
    UserInput -->|"Direct Concatenation"| CU
    UserInput -->|"Direct Concatenation"| CI
    UserInput -->|"Direct Concatenation"| CD
    
    CR -->|"VULNERABLE"| SQLQuery
    CU -->|"VULNERABLE"| SQLQuery
    CI -->|"VULNERABLE"| SQLQuery
    CD -->|"VULNERABLE"| SQLQuery
    
    UserInput -->|"Parameter Binding"| SS
    UserInput -->|"Parameter Binding"| SU
    UserInput -->|"Parameter Binding"| SI
    UserInput -->|"Parameter Binding"| SD
    
    SS -->|"PROTECTED"| SQLQuery
    SU -->|"PROTECTED"| SQLQuery
    SI -->|"PROTECTED"| SQLQuery
    SD -->|"PROTECTED"| SQLQuery
```

**Diagram: Query Method Security Comparison**

### Classic Method Vulnerabilities

**Example 1: _classicUpdate** [src/datos/Singleton.php:288-303]()

```php
public static function _classicUpdate($tb, $set, $extra){
    $query = "UPDATE " . strtolower($tb) . " set " . $set . " " . $extra;
    $result = $s::$lnk->query($query);
    // ...
}
```

This method directly concatenates the `$set` and `$extra` parameters into the SQL query. An attacker could inject:

```php
$set = "email='hacker@example.com' WHERE id=1; --";
```

**Example 2: _classicDelete** [src/datos/Singleton.php:263-277]()

```php
public static function _classicDelete($tb, $extra){
    $query = "DELETE FROM " . strtolower($tb) . " " . $extra;
    $result = $s::$lnk->query($query);
    // ...
}
```

The `$extra` parameter is directly concatenated, allowing arbitrary SQL injection.

**Example 3: _classicInsertUniqQuery** [src/datos/Singleton.php:364-378]()

```php
public static function _classicInsertUniqQuery($tb, $vls, $fld = ""){
    $query = "INSERT INTO " . strtolower($tb) . " " . $fld . " VALUES " . $vls;
    $result = $s::$lnk->query($query);
    // ...
}
```

Both `$fld` and `$vls` parameters are directly concatenated without sanitization.

**Sources:** [src/datos/Singleton.php:263-378]()

### Safe Method Implementation

The safe methods use prepared statements with parameter binding:

**Example: _safeUpdate** [src/datos/Singleton.php:696-722]()

```php
public static function _safeUpdate($table, $data, $where, $params = []) {
    $sets = [];
    $values = [];
    
    foreach ($data as $key => $value) {
        $sets[] = "`$key` = ?";  // Placeholder
        $values[] = $value;
    }
    
    $sql = "UPDATE `$table` SET " . implode(', ', $sets) . " WHERE $where";
    $stmt = $s::$lnk->prepare($sql);
    
    $types = str_repeat('s', count($values) + count($params));
    $stmt->bind_param($types, ...array_merge($values, $params));
    
    $stmt->execute();
    // ...
}
```

**Example: _safeSelect** [src/datos/Singleton.php:786-805]()

```php
public static function _safeSelect($table, $fields = '*', $where = '', $params = []) {
    $sql = "SELECT $fields FROM `$table`" . ($where ? " WHERE $where" : "");
    $stmt = $s::$lnk->prepare($sql);
    
    if (!empty($params)) {
        $types = str_repeat('s', count($params));
        $stmt->bind_param($types, ...$params);
    }
    
    $stmt->execute();
    // ...
}
```

**Sources:** [src/datos/Singleton.php:686-844]()

### Migration Strategy

```mermaid
graph TB
    Audit["Step 1: Audit Codebase<br/>Search for _classic* calls"]
    Map["Step 2: Create Migration Map<br/>Document all usages"]
    Replace["Step 3: Replace Calls<br/>Convert to _safe* equivalents"]
    Test["Step 4: Test Thoroughly<br/>Verify functionality"]
    Deprecate["Step 5: Deprecate Classic Methods<br/>Mark @deprecated"]
    Remove["Step 6: Remove Classic Methods<br/>Delete after migration period"]
    
    Audit --> Map
    Map --> Replace
    Replace --> Test
    Test --> Deprecate
    Deprecate --> Remove
```

**Diagram: SQL Injection Remediation Process**

**Action Items:**

1. **Immediate:** Add `@deprecated` tags to all `_classic*` methods in [src/datos/Singleton.php:263-378]()
2. **Short-term:** Conduct codebase audit to identify all `_classic*` method calls
3. **Medium-term:** Systematically replace with `_safe*` equivalents
4. **Long-term:** Remove deprecated methods after migration period

**Migration Example:**

Before:
```php
Singleton::_classicUpdate('users', "email='$email'", "WHERE id=$id");
```

After:
```php
Singleton::_safeUpdate('users', 
    ['email' => $email], 
    'id = ?', 
    [$id]
);
```

**Sources:** [src/datos/Singleton.php:263-844]()

---

## Authentication Bypass Points

### No-Token REST Endpoints

The `Rest` class defines several endpoints prefixed with `notkn_` that bypass authentication:

```mermaid
graph TB
    Request["HTTP Request"]
    Handler["Rest::handler()<br/>Line 114"]
    
    subgraph "Authentication Decision"
        CheckToken["Check Bearer Token<br/>Line 123"]
        CheckBasic["Check Basic Auth<br/>Line 165"]
        NoAuth["No Authentication"]
    end
    
    subgraph "Token Required Endpoints"
        TKN1["tkn_* methods<br/>Line 248"]
        TKN2["Authenticated Operations"]
    end
    
    subgraph "No-Token Endpoints"
        NOTKN1["notkn_CheckComm<br/>Line 73"]
        NOTKN2["notkn_Revisar<br/>Line 84"]
        NOTKN3["notkn_GestorDocumental<br/>Line 94"]
        AuthOff["OperacionesCtrl::authRequOff()<br/>Line 74"]
    end
    
    subgraph "Hash-Based Endpoints"
        HASH1["AutenticaUsuarioSis<br/>md5 hash"]
        HASH2["RecuperarByEmail<br/>md5 hash"]
        HASH3["RecuAsignarClave<br/>md5 hash"]
    end
    
    Request --> Handler
    Handler --> CheckToken
    CheckToken -->|"Valid Token"| TKN1
    CheckToken -->|"No Token"| CheckBasic
    CheckBasic -->|"Basic Auth"| HASH3
    CheckBasic -->|"No Auth"| NoAuth
    
    NoAuth --> NOTKN1
    NoAuth --> NOTKN2
    NoAuth --> NOTKN3
    
    NOTKN1 --> AuthOff
    
    TKN1 --> TKN2
    NoAuth --> HASH1
    NoAuth --> HASH2
```

**Diagram: REST API Authentication Flow**

### Vulnerable Endpoints

**1. notkn_CheckComm** [src/ctrls/Rest.php:73-82]()

```php
private static function notkn_CheckComm($data) {
    OperacionesCtrl::authRequOff();  // Disables authentication!
    try{
        OperacionesCtrl::comunicaciones_CheckForSend($data);
    }catch (Exception $ex){
        $er = array("err" => $ex->getMessage());
        echo json_encode($er);
    }
    die("");
}
```

This method explicitly calls `authRequOff()` to disable authentication checks before processing communications.

**2. notkn_Revisar** [src/ctrls/Rest.php:84-92]()

Allows unauthenticated access to `firmaspro_Revisar` functionality.

**3. notkn_GestorDocumental** [src/ctrls/Rest.php:94-102]()

Provides unauthenticated access to document management helper functions.

**Sources:** [src/ctrls/Rest.php:73-102]()

### Security Recommendations

**For no-token endpoints:**

1. **Document Business Justification:** Each `notkn_*` method should have clear documentation explaining why authentication is bypassed
2. **Implement Rate Limiting:** Add request throttling to prevent abuse
3. **Add IP Whitelisting:** Restrict access to known IP ranges if possible
4. **Implement Secondary Authentication:** Use API keys, shared secrets, or HMAC signatures
5. **Audit Logs:** Log all no-token endpoint access for security monitoring

**Example Enhanced Implementation:**

```php
private static function notkn_CheckComm($data) {
    // Add rate limiting
    if (!RateLimiter::check($_SERVER['REMOTE_ADDR'], 'check_comm', 10, 60)) {
        http_response_code(429);
        echo json_encode(['err' => 'Too many requests']);
        die();
    }
    
    // Validate request signature
    if (!self::validateHMAC($data)) {
        http_response_code(401);
        echo json_encode(['err' => 'Invalid signature']);
        die();
    }
    
    // Log access
    error_log("notkn_CheckComm accessed from " . $_SERVER['REMOTE_ADDR']);
    
    OperacionesCtrl::authRequOff();
    OperacionesCtrl::comunicaciones_CheckForSend($data);
    die("");
}
```

**Sources:** [src/ctrls/Rest.php:73-102]()

---

## Token Authentication Security

### Current Token Validation

The REST handler validates Bearer tokens in [src/ctrls/Rest.php:114-163]():

```mermaid
sequenceDiagram
    participant Client
    participant Rest
    participant OpCtrl as OperacionesCtrl
    participant DB as Database
    
    Client->>Rest: "Request with Bearer Token"
    Rest->>Rest: "getBearerToken()<br/>Extract from header"
    Rest->>OpCtrl: "CompararToken(pkey)<br/>Line 126"
    OpCtrl->>DB: "Query apibox table"
    DB-->>OpCtrl: "Token record(s)"
    
    alt Token exists
        OpCtrl-->>Rest: "Token data array"
        Rest->>Rest: "Check activo=1<br/>Line 133"
        
        alt Token active
            Rest->>Rest: "Check expiration<br/>Line 134-142"
            
            alt Not expired
                Rest->>Rest: "auten = true<br/>Line 144"
                Rest->>Client: "Process request"
            else Expired
                Rest->>Client: "401 Expired token<br/>Line 140"
            end
        else Token inactive
            Rest->>Client: "401 Disabled token<br/>Line 151"
        end
    else Token not found
        Rest->>Client: "401 Invalid token<br/>Line 160"
    end
```

**Diagram: Bearer Token Validation Sequence**

### Token Security Issues

**Issue 1: Time-Based Token Expiration** [src/ctrls/Rest.php:134-142]()

```php
$time = (isset($cfg[OperacionesCtrl::CFG_LGIN_APT]) 
    ? $cfg[OperacionesCtrl::CFG_LGIN_APT]["val"] 
    : "60");

$horaAct = date("Y-m-d H:i:s");
$horaReg = strtotime("+{$time} minutes", strtotime($cptO["fecha"]));
if($horaAct > date("Y-m-d H:i:s", $horaReg)){
    // Expired
}
```

**Vulnerabilities:**
- Token expiration time is configurable in database, default 60 minutes
- No mechanism to invalidate compromised tokens before expiration
- No refresh token mechanism for long-lived sessions

**Issue 2: MD5 Hash-Based Endpoint Routing** [src/ctrls/Rest.php:230-237]()

```php
if($ajax == md5('wsdl')){
    $metodos_clase = get_class_methods('Rest');
    foreach ($metodos_clase as $nombre_metodo) {
        echo $nombre_metodo . " = " . md5("Api/Servidor/" . $nombre_metodo) . "\n";
    }
}
```

Endpoint names are hashed with MD5, which provides security through obscurity but not true security. MD5 collisions are possible and hashes can be reverse-engineered.

**Sources:** [src/ctrls/Rest.php:114-275]()

### Recommended Token Security Enhancements

**1. Implement Token Revocation**

Add a revocation mechanism to the `apibox` table:

| Enhancement | Implementation |
|-------------|----------------|
| Revocation List | Add `revoked` boolean column to `apibox` table |
| Immediate Invalidation | Set `revoked=1` when token compromised |
| Revocation Checking | Check revocation status before expiration check |

**2. Implement Refresh Tokens**

Add separate short-lived access tokens and long-lived refresh tokens:

- Access tokens: 15-minute expiration
- Refresh tokens: 30-day expiration
- Separate API endpoint to exchange refresh token for new access token

**3. Replace MD5 with Secure Routing**

Replace MD5 hashing with explicit endpoint registration:

```php
private static $endpoints = [
    'autenticar' => 'AutenticaUsuarioSis',
    'recuperar_email' => 'RecuperarByEmail',
    'asignar_clave' => 'RecuAsignarClave',
];

// In handler()
if (isset(self::$endpoints[$ajax])) {
    $method = self::$endpoints[$ajax];
    self::{$method}($input);
}
```

**4. Add Request Signing**

Implement HMAC-SHA256 request signing for critical operations:

```php
$expectedSignature = hash_hmac('sha256', 
    $requestBody, 
    $clientSecret
);

if (!hash_equals($expectedSignature, $providedSignature)) {
    throw new Exception('Invalid signature');
}
```

**Sources:** [src/ctrls/Rest.php:114-275]()

---

## Transport Security

### HTTPS Enforcement

**Current State:** No HTTPS enforcement in application code.

**Required Actions:**

**1. Web Server Configuration**

Configure Apache/Nginx to redirect HTTP to HTTPS:

**Apache (.htaccess):**
```apache
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

**Nginx:**
```nginx
server {
    listen 80;
    server_name example.com;
    return 301 https://$server_name$request_uri;
}
```

**2. Application-Level HTTPS Check**

Add to [index.php]() and [home.php]() bootstrap:

```php
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
    if (!in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
        header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
        exit();
    }
}
```

**3. Set Security Headers**

Add to all response headers:

```php
header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('Referrer-Policy: strict-origin-when-cross-origin');
```

**4. Secure Cookie Configuration**

Ensure session cookies are secure:

```php
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => true,      // HTTPS only
    'httponly' => true,    // No JavaScript access
    'samesite' => 'Strict' // CSRF protection
]);
```

**Sources:** [index.php:1-1](), [home.php:1-1]()

---

## Security Hardening Checklist

### Pre-Deployment Checklist

| Priority | Task | Status | Reference |
|----------|------|--------|-----------|
| 🔴 CRITICAL | Externalize database credentials | ☐ | [Corporation.php:17-20]() |
| 🔴 CRITICAL | Externalize SMTP credentials | ☐ | [Corporation.php:6-14]() |
| 🔴 CRITICAL | Remove `.env` from version control | ☐ | N/A |
| 🔴 CRITICAL | Enforce HTTPS in production | ☐ | N/A |
| 🟠 HIGH | Migrate all `_classic*` to `_safe*` queries | ☐ | [Singleton.php:263-378]() |
| 🟠 HIGH | Audit `notkn_*` endpoint security | ☐ | [Rest.php:73-102]() |
| 🟠 HIGH | Implement token revocation | ☐ | [Rest.php:126-154]() |
| 🟠 HIGH | Configure secure session cookies | ☐ | N/A |
| 🟡 MEDIUM | Replace MD5 endpoint routing | ☐ | [Rest.php:230-237]() |
| 🟡 MEDIUM | Add rate limiting | ☐ | [Rest.php:114-275]() |
| 🟡 MEDIUM | Implement request logging | ☐ | N/A |
| 🟡 MEDIUM | Add security headers | ☐ | N/A |

### Testing Procedures

**1. SQL Injection Testing**

Test all user input endpoints with payloads:
```
' OR '1'='1
'; DROP TABLE users; --
' UNION SELECT NULL, username, password FROM users--
```

**2. Authentication Bypass Testing**

Attempt to access protected endpoints:
- Without Bearer token
- With expired token
- With disabled token
- With invalid token

**3. HTTPS Enforcement Testing**

Verify:
- HTTP requests redirect to HTTPS
- Cookies have `secure` flag
- HSTS header present
- No mixed content warnings

**4. Token Expiration Testing**

Verify:
- Tokens expire after configured time
- Expired tokens rejected with 401
- Token refresh mechanism works (if implemented)

### Monitoring and Logging

**Required Log Events:**

| Event | Priority | Log Location |
|-------|----------|--------------|
| Failed authentication attempts | HIGH | Application log |
| SQL errors | HIGH | Application log |
| `notkn_*` endpoint access | MEDIUM | Security log |
| Token generation | LOW | Audit log |
| Token expiration/revocation | MEDIUM | Audit log |
| Configuration changes | HIGH | Audit log |

**Log Format:**
```
[TIMESTAMP] [LEVEL] [IP] [USER] [ENDPOINT] [MESSAGE]
```

**Example:**
```
[2024-01-15 10:30:45] [WARN] [192.168.1.100] [anonymous] [notkn_CheckComm] Unauthenticated access to communications endpoint
```

**Sources:** [src/ctrls/Rest.php:114-275](), [src/datos/Singleton.php:1-845]()

---

## Long-Term Security Roadmap

```mermaid
graph TB
    subgraph "Phase 1: Immediate (Days)"
        P1A["Externalize Credentials"]
        P1B["Enforce HTTPS"]
        P1C["Add Security Headers"]
    end
    
    subgraph "Phase 2: Short-term (Weeks)"
        P2A["Audit SQL Injection Points"]
        P2B["Begin Classic→Safe Migration"]
        P2C["Implement Token Revocation"]
        P2D["Add Rate Limiting"]
    end
    
    subgraph "Phase 3: Medium-term (Months)"
        P3A["Complete SQL Migration"]
        P3B["Replace MD5 Routing"]
        P3C["Add Request Signing"]
        P3D["Implement Refresh Tokens"]
    end
    
    subgraph "Phase 4: Long-term (6+ Months)"
        P4A["Security Audit by External Firm"]
        P4B["Penetration Testing"]
        P4C["Security Training"]
        P4D["Remove Classic Methods"]
    end
    
    P1A --> P2A
    P1B --> P2C
    P1C --> P2D
    
    P2A --> P3A
    P2B --> P3A
    P2C --> P3D
    
    P3A --> P4D
    P3B --> P4A
    P3C --> P4B
```

**Diagram: Security Hardening Implementation Roadmap**

### Key Performance Indicators (KPIs)

| Metric | Target | Measurement |
|--------|--------|-------------|
| Classic query method usage | 0% | Code scan |
| Failed authentication rate | <5% | Log analysis |
| Token revocation lag | <1 minute | Monitoring |
| Security header coverage | 100% | HTTP response inspection |
| Credential exposure score | 0 | Static analysis |

**Sources:** [repo/corp/Corporation.php:1-23](), [src/datos/Singleton.php:1-845](), [src/ctrls/Rest.php:1-277]()

---
