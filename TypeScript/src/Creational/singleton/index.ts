import { Singleton } from './singleton';
import './singleton_a';
import './singleton_b';

var dados = Singleton.obterInstancia().mostraDados();
console.log(dados); // [ { id: 1, nome: 'dado1' }, { id: 1, nome: 'dado2' } ]

// conclusao
