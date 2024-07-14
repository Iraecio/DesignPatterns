class Produto {
  private nome: string;
  private preco: number;

  constructor(nome: string, preco: number) {
    this.nome = nome;
    this.preco = preco;
  }

  public clone(): Produto {
    return new Produto(this.nome, this.preco);
  }

  public getNome(): string {
    return this.nome;
  }

  public setNome(nome: string): void {
    this.nome = nome;
  }

  public getPreco(): number {
    return this.preco;
  }

  public setPreco(preco: number): void {
    this.preco = preco;
  }
}

const produtoOriginal = new Produto('Camiseta', 50.0);
const produtoClone = produtoOriginal.clone();

produtoClone.setNome('Camiseta com estampa');
produtoClone.setPreco(60.0);

console.log(`Produto Original: ${produtoOriginal.getNome()} - ${produtoOriginal.getPreco()} Reais`);
console.log(`Produto Clone: ${produtoClone.getNome()} - ${produtoClone.getPreco()} Reais`);
