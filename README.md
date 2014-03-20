# EXIBIÇÃO DE JPG'S

Usado para a exibição online de peças no formato JPG para clientes.


### Utilização
Basta inserir as imagens no diretório `/images/`.<br>
As imagens devem ser renomeadas da sehuinte forma:
```
	nome-do-cliente_01.jpg
	nome-do-cliente_02.jpg
	nome-do-cliente_03.jpg
	[...]
```
<br>
Esse padrão de nomenclatura é necessário porque arquivo index.php buscará automaticamente o diretório `/images/`, e utilizará o nome do arquivo para ordenar a exibição das imagens e inserir o título da página.<br><br>
O exemplo de nomenclatura mostrado acima resultará em uma página chamada NOME DO CLIENTE, e as imagens estarão em sequência, bastando clicar na mesma para visualizar a próxima imagem.

