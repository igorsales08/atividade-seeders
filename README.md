# Povoamento de Banco de Dados com Seeders no Laravel

Este repositório contém a implementação prática do povoamento de banco de dados (*Database Seeding*) em uma aplicação desenvolvida com o framework **Laravel**. 

O objetivo principal desta atividade é demonstrar a persistência massiva e estruturada de dados respeitando relacionamentos entre tabelas (1:N), garantindo o versionamento e integridade do banco de dados até a geração do script de exportação (`.sql`).

---

## Tecnologias e Ferramentas Utilizadas

- **Linguagem:** PHP (v8.2+)
- **Framework:** Laravel (v11+)
- **Gerenciador de Dependências:** Composer
- **SGBD / Banco de Dados:** MySQL / MariaDB (via phpMyAdmin)
- **Versionamento:** Git & GitHub

---

## Estrutura e Modelagem do Banco de Dados

A aplicação foi estruturada em torno de duas entidades principais relacionadas entre si:

1. **`categories` (Categorias):** Tabela pai que agrupa os tipos de produtos.
   - `id`: Chave primária (BigIncrement).
   - `name`: Nome da categoria (String).
   - `description`: Descrição detalhada da categoria (Text, opcional).
   - `created_at` / `updated_at`: Controle de timestamps do Laravel.

2. **`products` (Produtos):** Tabela filho que armazena os produtos e possui dependência relacional com categorias.
   - `id`: Chave primária (BigIncrement).
   - `category_id`: Chave estrangeira que referencia `categories(id)` com regra de deleção em cascata (`onDelete('cascade')`).
   - `name`: Nome do produto (String).
   - `price`: Preço do produto (Decimal 8,2).
   - `stock`: Quantidade em estoque (Integer).
   - `created_at` / `updated_at`: Controle de timestamps do Laravel.

---

## Etapas de Desenvolvimento

### Etapa 1: Criação e Configuração dos Models e Migrations

A estrutura das tabelas no banco de dados foi definida utilizando as **Migrations** do Laravel.

1. **Geração das entidades:**
   ```bash
   php artisan make:model Category -m
   php artisan make:model Product -m
   ```

2. **Definição dos Schemas:**
   - Em `database/migrations/..._create_categories_table.php`, definiu-se a estrutura da tabela de categorias.
   - Em `database/migrations/..._create_products_table.php`, definiu-se a estrutura de produtos e o vínculo da chave estrangeira (`foreignId('category_id')->constrained()`).

3. **Mapeamento dos Relacionamentos nos Models:**
   - `App\Models\Category`: Método `products()` implementando `hasMany(Product::class)`.
   - `App\Models\Product`: Método `category()` implementando `belongsTo(Category::class)`.

---

### Etapa 2: Implementação e Execução dos Seeders

Para realizar o povoamento das tabelas sem o uso de Factories, os dados foram mapeados diretamente nas classes de Seeder utilizando o *Query Builder* (`Illuminate\Support\Facades\DB`).

1. **Criação das classes de Seeder:**
   ```bash
   php artisan make:seeder CategorySeeder
   php artisan make:seeder ProductSeeder
   ```

2. **Lógica do `CategorySeeder` (`database/seeders/CategorySeeder.php`):**
   Foram inseridos registros fixos para criar as categorias base:
   - *Eletrônicos* (ID 1)
   - *Periféricos* (ID 2)
   - *Hardware* (ID 3)

3. **Lógica do `ProductSeeder` (`database/seeders/ProductSeeder.php`):**
   Foram inseridos registros de produtos associados explicitamente às categorias criadas, garantindo a integridade referencial:
   - Categoria 1: Smartphone Galaxy, Notebook Pro
   - Categoria 2: Mouse Gamer RGB, Teclado Mecânico
   - Categoria 3: Placa de Vídeo RTX 4060, Processador Intel i7

4. **Orquestração no `DatabaseSeeder` (`database/seeders/DatabaseSeeder.php`):**
   As seeders foram chamadas na ordem correta para evitar erros de chave estrangeira:
   ```php
   $this->call([
       CategorySeeder::class,
       ProductSeeder::class,
   ]);
   ```

5. **Execução das Migrations e Seeders:**
   No terminal, executou-se o comando para reconstruir as tabelas e aplicar o povoamento automático:
   ```bash
   php artisan migrate:fresh --seed
   ```

---

### Etapa 3: Validação dos Dados e Exportação SQL (Dump)

1. **Validação:** A integridade das tabelas e o correto preenchimento dos registros e chaves estrangeiras foram confirmados acessando o cliente do banco de dados (phpMyAdmin na base `atividades_seeders`).
2. **Exportação:** Após a validação, foi realizada a exportação completa do banco de dados para um arquivo `.sql` (`atividades_seeders.sql`), assegurando a preservação da estrutura e dos dados inseridos.

---

## Como Executar este Projeto Localmente

1. **Clone este repositório:**
   ```bash
   git clone https://github.com/igorsales08/atividade-seeders.git
   cd atividade-seeders
   ```

2. **Instale as dependências do Composer:**
   ```bash
   composer install
   ```

3. **Configure as variáveis de ambiente:**
   Copie o arquivo `.env.example` para `.env`:
   ```bash
   cp .env.example .env
   ```
   Ajuste as configurações do banco de dados no seu `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=atividades_seeders
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Gere a chave da aplicação:**
   ```bash
   php artisan key:generate
   ```

5. **Crie o banco de dados** `atividades_seeders` no seu gerenciador MySQL (phpMyAdmin/MySQL Workbench).

6. **Execute as Migrations com os Seeders:**
   ```bash
   php artisan migrate:fresh --seed
   ```

---

## Arquivo SQL Final
O script exportado com toda a estrutura e os dados inseridos pelas Seeders pode ser encontrado na raiz do projeto ou importado diretamente pelo banco de dados.
