# agenda-compromissos
Agenda de compromissos

Procedimentos de configuração para execução no ambiente local

1. Forka o repositório
2. Clona o repositório forkado

No diretório raiz do Apache

Linux: _/var/www/html_

Windows com XAMPP: _c:/xampp/htdocs_

`git clone https://github.com/SEU-USUARIO/agenda-compromissos.git`

3. Acesse o diretório do projeto onde fez o clone do projeto

Linux: _/var/www/html/agenda-compromissos_

Windows: _c:/xampp/htdocs/agenda-compromissos_

4. Crie o banco de dados chamado agendacompromissos
No terminal do mysql digite:

```
CREATE DATABASE agendacompromissos charset set utf8;
```

5. Crie o usuário e aplique o Grantt do usuário
```
CREATE USER `usuario`@`127.0.0.1` IDENTIFIED BY `password`;
GRANT select, insert, update, delete, create, drop, alter ON agendacompromissos.* TO `usuario`@`127.0.0.1` WITH GRANT OPTION; 
```

6. Execute `composer install` 

7. Após o termino da instalação do Phinx via composer
`vendor/bin/phinx init`

Irá gerar um arquivo phinx.yml, o qual você deve alterar na directiva development
Conforme o exemplo abaixo
```
development:
        adapter: mysql
        host: localhost
        name: agendacompromissos
        user: usuario
        pass: 'senha'
        port: 3306
        charset: utf8
```
8. Renomear o arquivo config/config-exemplo.php para config/config.php e coloque o usuário/senha do banco de dados
`mv config/config-exemplo.php config/config.php`

Em DB_USER e DB_PASS deve ser colocado o usuário e senha do banco de dados

9. Estando com o banco de dados criado com nome agendacompromissos, o usuário com os privilégios conforme no item 5 e adicionado as credencias do usuário/senha do banco de dados no arquivo phinx.yml conforme item 7, pode executar o migrations para criar as tabelas.
`vendor/bin/phinx migrate`

**Criação do Vhost**

No GNU/Linux(Debian e Ubuntu), acesse até o diretório _/etc/apache2/sites-available/_ e crie o arquivo agenda.conf com o conteúdo abaixo
```
<VirtualHost *:80>
    #ServerAdmin root@localhost
    ServerName agenda.localhost
    DocumentRoot "/var/www/html/agenda-compromissos"
    ErrorLog ${APACHE_LOG_DIR}/agenda-error.log
    CustomLog ${APACHE_LOG_DIR}/agenda-access.log combined
    <Directory "/var/www/html/agenda-compromissos">
	#DirectoryIndex index.php index.html index.htm
	Options -Indexes
	AllowOverride All
	Order allow,deny
	Allow from all
    </Directory>
</VirtualHost>
```
**Ativar Vhost**

`# a2ensite agenda.conf`

**Reload do Apache**

`# systemctl reload apache2`

No Windows com XAMPP instalado, segue:

Editar o arquivo _C:\xampp\apache\conf\extra\httpd-vhosts.conf_
```
<VirtualHost *:80>
    ServerName default
    DocumentRoot "C:/xampp/htdocs"
    ErrorLog "logs/default-error.log"
    CustomLog "logs/default-access.log" common
    <Directory "C:/xampp/htdocs">
        DirectoryIndex index.php index.html index.htm
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>

<VirtualHost *:80>
    ServerName agenda.localhost
    DocumentRoot "C:/xampp/htdocs/agenda-compromissos"
    ErrorLog "logs/agenda-compromissos-error.log"
    CustomLog "logs/agenda-compromissos-access.log" common
    <Directory "C:/xampp/htdocs/agenda-compromissos">
        DirectoryIndex index.php index.html index.htm
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
```

**Adicionar o Vhost no arquivo hosts**

No GNU/Linux qualquer distro, editar o arquivo: _/etc/hosts_
```
127.0.0.1 agenda.localhost
```
No Windows, editar o arquivo _C:\Windows\System32\drivers\etc\hosts_ como Administrador
```
127.0.0.1   agenda.localhost
```

Após seguir corretamente os procedimentos conforme acima, no browser digite http://agenda.localhost 
No primeiro acesso, cadastra um usuário para pode agendar um evento, é por usuário.

Caso queira fazer melhorias, envie o Pull Request

Feito!
