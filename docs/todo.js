//TODO: Classe dbconection deve ser revista(tirar configuração do banco)
//TODO: Classe util / backup deve ser revista(tirar configuração do banco / Funcionar no linux e windows)
//TODO: usar post no login html, senha visivel no get
//TODO: Controlar Exception e PDOException de maneira mais simplificada



/*
 * ########## REALIZA O DOWNLOAD DE UM ARQUIVO
 * @function download => Função que realiza o download de um arquivo
 * @param src => Recebe o destino de solicitação do arquivo
 * @param valor => Recebe o nome do arquivo ou informação a ser manipulada pelo servidor
 * encontrar o arquivo
 * ---------------------------------------------------------------------- */
function download(src, valor) {
  if (document.getElementById('frame_down')) {
    elemento.setAttribute('src', src + valor);
  } else {
    //elemento pai, onde o elemento criado será adicionado
    pai = document.body;
    //definimos qual elemento queremos criar
    elemento = document.createElement("iframe");
    //adicionamos estilo css
    elemento.style.display = 'none';
    //adicionamos um nome
    elemento.setAttribute("id", "frame_down");
    //adicionamos um destino para solicitação do arquivo
    elemento.setAttribute('src', src + valor);
    //adicionamos o elemento criado ao elemento pai
    pai.appendChild(elemento);
  }
}




//REVIEW: Gradiente muito bom
/*
background: #111;
background: -moz-linear-gradient(45deg, # 111 0 % , #555 66%, # f7f179 100 % );
background: -webkit - linear - gradient(45 deg, #398235 0%,# 8 ab66b 66 % , #f7f179 100 % );
background: linear - gradient(45 deg, #111 0%,# 444408 66 % , red 100 % );
filter: progid: DXImageTransform.Microsoft.gradient(startColorstr = '#398235', endColorstr = '#f7f179', GradientType = 1);
*/


//REVIEW: Substituir top portal
/*
background - image: url("http://www.saojosedodivino.mg.gov.br/wp-content/uploads/2017/07/portal-atualizacao.svg");
background - size: 100 % 100 % ;
background - repeat: no - repeat;
*/
