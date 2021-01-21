# NODE JS


## Para rodar este projeto
```bash
$ npm install
$ node run start
```
Acesssar pela url: http://localhost:8000/ #neste caso a porta esta a padrão, mais pode ser alterada se necessário, PS: o link para acesso é mostrado quando o comardo anterior é executado.



## Acesso
- Utilizando o POSTMAN, Insomnia ou alguma outra ferramente do tipo, deve ser feita uma requisição 'POST'.
- url: http://localhost:3000, passando como parametro obrigatório uma matriz quadrada.
- Variável referente a matriz que deve ser passada na requisição deve-se chamar 'matrix'.

## Exemplo da Variável
{
  "matrix": [
			[1, 2, 3, 6],
			[4, 5, 6, 3],
			[9, 5, 7, 0],
			[4, 8, 9, 0]
		]
}

## Observação
- A aplicação esta mapeada para a porta 3000.
