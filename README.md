<p align="center"><a href="https://laravel.com" target="_blank"><img width="196" height="52" alt="Logo" src="https://github.com/claudiamachado27/gestao-inventario/blob/main/public/images/logo.png" />


# 💰 Gestão de Inventário (Partilha de Bens)

Sistema premium de gestão de inventário desenvolvido em **Laravel**, focado na simplicidade, eficiência e uma experiência de utilizador moderna.

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)

## ✨ Diferenciais do Projeto

Este sistema foi transformado recentemente com uma nova identidade visual **Light Premium**:
- **Interface Minimalista:** Fundo branco com destaques em azul royal.
- **Feedback Visual:** Receitas destacadas em verde esmeralda e despesas em vermelho.
- **Moeda Nacional:** Sistema ajustado para o Real (R$).
- **Experiência Fluida:** Modais intuitivos para inserção, edição e remoção de dados sem distrações.

---

## 🚀 Funcionalidades Principais

- 📊 **Dashboard Inteligente:** Visualização rápida do Saldo Anterior, Total de Receitas, Total de Despesas e Saldo Atual.
- 💸 **Controle de Movimentações:** Cadastro completo com descrição, valor, categoria e data.
- � **Filtros Avançados:** Filtre por mês, ano e tipo (Receira/Despesa) para uma análise precisa.
- �️ **Relatórios Prontos:** Função de impressão otimizada para extratos físicos ou PDF.
- 🔐 **Segurança:** Sistema de autenticação completo (Login, Registo, Recuperação de Senha).
- 📁 **Organização por Categorias:** Ícones intuitivos para identificar cada tipo de gasto.

---

## 🛠️ Tecnologias Utilizadas

- **Backend:** Laravel 11 (PHP 8.4)
- **Frontend:** Blade Templates, Bootstrap 5, CSS3 (Custom Design)
- **Ícones:** Bootstrap Icons
- **Tipografia:** Google Fonts (Inter)
- **Base de Dados:** MySQL / SQLite

---

## 📋 Como Instalar e Rodar

### Pré-requisitos
- PHP = 8.4
- Composer
- Node.js & NPM
- Servidor de base de dados (MySQL ou compatível)

### Passo a Passo

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/claudiamachado27/gestao-inventario.git
   cd Inventario
   ```

2. **Instale as dependências:**
   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Configure o ambiente:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Nota: Configure as suas credenciais de base de dados no ficheiro `.env`.*

4. **Prepare a base de dados:**
   ```bash
   php artisan migrate --seed
   ```

5. **Inicie o servidor:**
   ```bash
   php artisan serve
   ```
   Aceda a: `http://localhost:8000`

---

## 🎨 Design System

O projeto utiliza um sistema de cores personalizado para garantir acessibilidade e beleza:
- **Primária:** Blue Royal (`#3b82f6`)
- **Sucesso:** Emerald Green (`#10b981`)
- **Erro:** Error Red (`#ef4444`)
- **Fundo:** Pure White (`#ffffff`)

---

## 🛡️ License

O framework Laravel é um software de código aberto licenciado sob a licença [MIT license](https://opensource.org/licenses/MIT).

---
<p align="center">
  <b>© 2026 Design e Desenvolvimento com ❤️ por Claudia Machado</b><br>
  <i>Todos os direitos reservados</i>
</p>
