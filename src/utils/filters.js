import * as util from './removerAcentos';

/**
 *
 * @param {list} lista Lista a ser filtrada
 * @param {type} termo Termo a ser utiilizado para filtrar
 * @returns {list} Lista filtrada
 */
export function filtrarPorMunicipio(lista, termo) {
  //Caso termo esteja em branco, retorna lista sem filtro
  if (!termo.length) return lista
  //Realiza filtro
  let listaFiltrada = lista.filter(item => contem(item.no_municipio, termo))
  //Ordena a lista filtrada
  return listaFiltrada.sort(
    function(obj1, obj2) {
      let _obj1 = util.removerAcentos(obj1.no_municipio);
      let _obj2 = util.removerAcentos(obj2.no_municipio);
      return _obj1 < _obj2 ? -1 : (_obj1 > _obj2 ? 1 : 0);
    }
  );
}
/**
 *
 * @param {string} str String
 * @param {string} sub String a ser procurada
 * @returns {boolean} Retorna verdadeiro caso a string contenha a substring
 */
export function contem(str, sub) {
  //Retira espaço em branco no inicio e fim, transforma e minúsculo, remove acentos
  const s = util.removerAcentos(str.trim()
    .toLowerCase());
  //Retira espaço em branco no inicio e fim, transforma e minúsculo, remove acentos
  const t = util.removerAcentos(sub.trim()
    .toLowerCase());
  return s.match(t);
}
