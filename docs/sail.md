# Configurando um Alias de Shell

Por padrão, os comandos do `Sail` são invocados usando o script `vendor/bin/sail` que é incluído em todas as novas aplicações Laravel:

`./vendor/bin/sail up`

No entanto, em vez de digitar repetidamente `vendor/bin/sail` para executar comandos do <b>Sail</b>, você pode configurar um apelido de <b>shell</b> que permita executar os comandos do <b>Sail</b> mais facilmente

Para garantir que isso esteja sempre disponível, você pode adicionar essa linha ao arquivo de configuração do seu <b>shell</b> no diretório home, como `~/.zshrc` ou `~/.bashrc`, e então reiniciar o <b>shell:</b>

`alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'`

Uma vez que o alias de <b>shell</b> tenha sido configurado, você poderá executar os comandos do Sail simplesmente digitando sail. O restante dos exemplos desta documentação assumirá que você configurou esse alias:

`sail up`

## Para mais dúvidas consulte a [documentação oficial](https://laravel.com/docs/12.x/sail#configuring-a-shell-alias)
