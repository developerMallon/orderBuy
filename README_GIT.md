PREPARAÇÃO DO REPOSITÓRIO GIT
#Iniciar um repositório git:
git init

#Ver o status:
git status

#Adicionar os arquivos para serem monitorados pelo git:
git add .

#Fazer um commit para "guardar" o estado do arquivo:
git commit -m "primeiro commit após baixar sistema do servidor de hospedagem"

#Entrar na pasta usuario/.ssh
cd ~/.ssh

#Gerar uma chave ssh no computador:
INICIA O SSH...............: ssh-agent bash
GERA A CHAVE..........: ssh-keygen -t ed25519 -C "timafra4@mallon.com.br"
ADICIONA A CHAVE: ssh-add ~/.ssh/id_ed25519

#Listar chaves
ls -al ~/.ssh

#Copiar a chave para a área de transferência:
clip < ~/.ssh/id_ed25519.pub

===> Adicionar a chave copiada no github:

#Adicionar username e email
git config --global user.name "developerMallon"
git config --global user.email "timafra4@mallon.com.br"

#Adicionar um repositório no github:
git remote add origin git@github.com:developerMallon/recapadora

#Enviar os arquivos para o repositório on-line
git push -u origin master




## OR create a new repository on the command line
echo "# orderBuy" >> README.md
git init
git add README.md
git commit -m "first commit"
git branch -M main
git remote add origin git@github.com:developerMallon/orderBuy.git
git push -u origin main