# 📋 CRUD PHP - Sistema de Cadastro de Usuários

> Projeto de aprendizagem para entender os fundamentos de operações CRUD (Create, Read, Update, Delete) com PHP e MySQL.

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)

---

## 📖 Sobre o Projeto

Este é um projeto simples de **CRUD** desenvolvido para fins de aprendizagem. Ele demonstra como criar um sistema completo de cadastro de usuários utilizando PHP com PDO para conexão segura com o banco de dados MySQL.

### O que você vai aprender:

- ✅ Conexão com banco de dados usando **PDO**
- ✅ Operações **CRUD** (Criar, Ler, Atualizar, Deletar)
- ✅ **Prepared Statements** para prevenir SQL Injection
- ✅ Validação de formulários com PHP
- ✅ Estrutura básica de um projeto PHP
- ✅ Estilização com CSS puro

---

## 🚀 Funcionalidades

| Funcionalidade | Descrição |
|----------------|-----------|
| ➕ **Criar** | Adicionar novos usuários com nome, email e telefone |
| 📋 **Listar** | Visualizar todos os usuários cadastrados |
| ✏️ **Editar** | Atualizar informações de usuários existentes |
| 🗑️ **Deletar** | Remover usuários do sistema (com confirmação) |

---

## 📁 Estrutura do Projeto

```
crudphp/
├── config.php      # Configuração de conexão com o banco de dados
├── index.php       # Página principal (lista de usuários)
├── create.php      # Formulário para criar novo usuário
├── edit.php        # Formulário para editar usuário
├── delete.php      # Script para deletar usuário
├── database.sql    # Script SQL para criar o banco e tabela
├── css/
│   └── style.css   # Estilos da aplicação
└── README.md       # Este arquivo
```

---

## ⚙️ Pré-requisitos

Antes de começar, você precisa ter instalado:

- [XAMPP](https://www.apachefriends.org/pt_br/index.html) (ou qualquer servidor Apache + MySQL + PHP)
- Navegador web (Chrome, Firefox, Edge, etc.)

---

## 🔧 Instalação e Configuração

### 1️⃣ Clone ou baixe o projeto

Coloque a pasta `crudphp` dentro do diretório `htdocs` do XAMPP:
```
C:\xampp\htdocs\crudphp
```

### 2️⃣ Inicie o XAMPP

1. Abra o **XAMPP Control Panel**
2. Clique em **Start** no **Apache**
3. Clique em **Start** no **MySQL**

### 3️⃣ Crie o banco de dados

1. Acesse o phpMyAdmin: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
2. Crie um novo banco de dados chamado `crud_php`
3. Execute o script SQL abaixo:

```sql
CREATE TABLE IF NOT EXISTS usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Dados de exemplo (opcional)
INSERT INTO usuarios (nome, email, telefone) VALUES
('João Silva', 'joao@email.com', '(11) 99999-1111'),
('Maria Santos', 'maria@email.com', '(11) 99999-2222'),
('Pedro Oliveira', 'pedro@email.com', '(11) 99999-3333');
```

### 4️⃣ Acesse o projeto

Abra no navegador: [http://localhost/crudphp](http://localhost/crudphp)

---

## 🗃️ Configuração do Banco de Dados

O arquivo `config.php` contém as configurações de conexão:

```php
$host = 'localhost';     // Servidor do banco
$dbname = 'crud_php';    // Nome do banco de dados
$username = 'root';      // Usuário (padrão do XAMPP)
$password = '';          // Senha (vazia por padrão no XAMPP)
```

> ⚠️ **Atenção**: Em produção, sempre use senhas fortes e nunca deixe as credenciais expostas!

---

## 📸 Screenshots

### Lista de Usuários
A página principal exibe todos os usuários cadastrados em uma tabela organizada.

### Formulário de Cadastro
Formulário simples e intuitivo para adicionar novos usuários.

---

## 🧠 Conceitos Aprendidos

### PDO (PHP Data Objects)
```php
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
```
O PDO é uma extensão do PHP que fornece uma interface leve e consistente para acessar bancos de dados.

### Prepared Statements
```php
$stmt = $pdo->prepare("INSERT INTO usuarios (nome, email) VALUES (:nome, :email)");
$stmt->execute([':nome' => $nome, ':email' => $email]);
```
Previne SQL Injection separando a query dos dados.

### Sanitização de Dados
```php
echo htmlspecialchars($usuario['nome']);
```
Previne ataques XSS convertendo caracteres especiais em entidades HTML.

---

## 🐛 Erros Comuns

### "Nenhuma conexão pôde ser feita porque a máquina de destino as recusou ativamente"
**Solução**: O MySQL não está rodando. Inicie o MySQL no XAMPP Control Panel.

### "Unknown database 'crud_php'"
**Solução**: Crie o banco de dados `crud_php` no phpMyAdmin antes de usar o sistema.

### "Table 'usuarios' doesn't exist"
**Solução**: Execute o script SQL para criar a tabela de usuários.

---

## 📚 Próximos Passos

Depois de dominar este projeto, você pode evoluir aprendendo:

- [ ] Autenticação de usuários (login/logout)
- [ ] Upload de imagens
- [ ] Paginação de resultados
- [ ] API RESTful
- [ ] Frameworks PHP (Laravel, Symfony)

---

## 🤝 Contribuindo

Este é um projeto de aprendizagem! Sinta-se à vontade para:

1. Fazer um fork do projeto
2. Criar uma branch para sua feature (`git checkout -b feature/NovaFeature`)
3. Commit suas mudanças (`git commit -m 'Adiciona nova feature'`)
4. Push para a branch (`git push origin feature/NovaFeature`)
5. Abrir um Pull Request

---

## 📝 Licença

Este projeto é livre para uso educacional. Use, modifique e aprenda! 🎓

---

<p align="center">
  Feito com ❤️ para aprender PHP
</p>
