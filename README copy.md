## ORDERBUY - API COM LARAVEL

cd d:\devs\htdocs
laravel new orderBuy
cd orderBuy
chmod -R guo+w ./storage

# Criar SCHEMA no banco de dados
CREATE SCHEMA IF NOT EXISTS `orderBuy` DEFAULT CHARACTER SET utf8;

# Criar as MIGRATIONS das tabelas (Manter a ORDEM de criação para não dar erro nos relacionamentos)
php artisan make:migration create_tbDepartamento --create=tbDepartamento
php artisan make:migration create_tbFilial --create=tbFilial
php artisan make:migration create_tbNivel --create=tbNivel
php artisan make:migration create_tbUsuarios --create=tbUsuarios
php artisan make:migration create_tbClientes --create=tbClientes
php artisan make:migration create_tbTipos --create=tbTipos
php artisan make:migration create_tbVeiculos --create=tbVeiculos
php artisan make:migration create_tbOrdemCompra --create=tbOrdemCompra
php artisan make:migration create_tbFilialDepartamento --create=tbFilialDepartamento

# Criar os MODELS (nome tem que ser igual ao da tabela)
php artisan make:model tbClientes
php artisan make:model tbDepartamentos
php artisan make:model tbFiliais
php artisan make:model tbFiliaisDepartamentos
php artisan make:model tbNiveis
php artisan make:model tbOrdemCompras
php artisan make:model tbTipos
php artisan make:model tbUsuarios
php artisan make:model tbVeiculos

# Rodar todas as MIGRATIONS para criar as tabelas no banco de dados
php artisan migrate

# Rodar uma MIGRATION específica
php artisan migrate --path=/database/migrations/2021_07_19_204140_create_tb_usuarios.php

# Criar os CONTROLLERS
php artisan make:controller ClientesController --resource
php artisan make:controller DepartamentosController --resource
php artisan make:controller FiliaisController --resource
php artisan make:controller FiliaisDepartamentosController --resource
php artisan make:controller NiveisController --resource
php artisan make:controller OrdemComprasController --resource
php artisan make:controller TiposController --resource
php artisan make:controller UsuariosController --resource
php artisan make:controller VeiculosController --resource

# Criar e definir RESOURCE
php artisan make:resource Cliente
php artisan make:resource Departamento
php artisan make:resource Filial
php artisan make:resource FilialDepartamento
php artisan make:resource Nivel
php artisan make:resource OrdemCompra
php artisan make:resource Tipo
php artisan make:resource Usuario
php artisan make:resource Veiculo
