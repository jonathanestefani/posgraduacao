# Gestor de Consultas Médicas

## Sobre

Com o avanço das tecnologias, a internet teve uma grande evolução nos últimos anos, muitas oportunidades foram aparecendo e novas ainda vão surgir. Nos dias atuais o celular juntamente com a internet são uns dos meios de trabalho da população que está muito em alta. Há diversas formas de trabalhos pela internet e fazem diversos outros serviços usando um celular e a internet. Muitas empresas novas acabam nascendo nessa área, simultaneamente surgem dificuldades e soluções que aparecem na medida com os avanços das tecnologias.  

Com muitos sistemas online disponíveis na internet, também foi possível identificar poucos sistemas que oferecem praticidade ao procurar por serviços de clínicas com horários disponíveis de forma centralizada, independente a clínica que se procure. A razão desse trabalho, tem o objetivo de buscar a solução para agilizar o dia a dia das pessoas, que hoje devem fazer várias pesquisas e envio de mensagens para procurar um horário e um profissional, sendo da área da saúde ou estética. Através de um aplicativo de celular, a gestão centralizada visa oferecer recursos mais agrupados em um só lugar, de forma simples, as pessoas podem procurar uma área específica, profissionais e horários com mais agilidade sem se preocupar em baixar vários aplicativos de várias clínicas para esse fim.  

Existe muitas soluções no mercado, porém as vezes difícil de encontrar algo que facilite e seja de fácil acesso, o diferencial deste aplicativo é automatizar e fazer o usuário ganhar tempo, evitando instalar vários aplicativos de clínicas só para encontrar um profissional específico. Nesse sentido, o aplicativo irá proporcionar uma concorrência mais leal para os clientes, podendo oferecer serviços e preços mais acessíveis. 

Com este aplicativo no celular, basta a pessoa se cadastrar, e já pode buscar um profissional de uma determinada área específica, e cidade se assim desejar. Pesquisar horários disponíveis e por fim agendar. 

## Instação

Para facilitar a instalação do projeto, toda a estrutura construído em docker, trouxe uma flexibilidade ao gerenciar os micro serviços.

O projeto foi destinado para ambientes Linux, pois com o grande crescimento do S.O, é muito fácil trabalhar com projetos principalmente usando o docker.

### Passo 1 

    Com o docker e docker-compose instalado em seu computador, basta seguir as seguintes instruções:

    ```
        docker-compose up -d --build 
    ```

    Após subir todo o ambiente, execute esse shell script no linux:

    ```
        ./Setup
    ```

## Ionic

    Dependências: node-v16, ionic 5.16, Android Sdk, Gradle 6.5, Imagem do Android Sdk 33.0.3.

    Para a instalação do aplicativo, deixe habilitado o modo desenvolvedor no Android, depuração USB, instalaçaõ de softwares de terceiros.

    Acesse a pasta 'mobile' e dentro dela execute os seguintes comandos:

    *Obs: Deixe seu celular conectado no usb do computador, algumas versões do Android ao executar os comandos abaixo, irá solicitar permissão para instalar aplicativos.

    ``` 
        npm install

        ionic cordova run android
    ```

## Banco de dados Postgres

Foi adicionado no docker o software pgadmin4 para você ter acesso ao banco de dados do Postgres através do navegador pela url http://localhost:5050.

Usuário: jonathan.estefani@gmail.com
Senha: admin

