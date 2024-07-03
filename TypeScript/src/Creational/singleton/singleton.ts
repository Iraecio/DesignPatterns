import './dados.interface';

// Classe Singleton
export class Singleton {
  private static instancia: Singleton | null = null;
  private dados: IDados[] = [];

  private constructor() {
    // Esconde o construtor padrão
  }

  static obterInstancia() {
    if (this.instancia === null) {
      this.instancia = new Singleton();
    }
    return this.instancia;
  }

  criaDado(id: number, nome: string): void {
    this.dados.push({ id, nome });
  }

  removeDado(index: number): void {
    this.dados.splice(index, 1);
  }

  mostraDados(): IDados[] {
    return this.dados;
  }
}
