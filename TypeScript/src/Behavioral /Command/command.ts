export interface Command {
  execute(): void;
}

export class ChangePriceCommand implements Command {
  private product: Product;
  private newPrice: number;

  constructor(product: Product, newPrice: number) {
    this.product = product;
    this.newPrice = newPrice;
  }

  execute(): void {
    console.log(`Alterando o preço do produto ${this.product.getName()} para ${this.newPrice}`);
    this.product.setPrice(this.newPrice);
  }
}

export class AddStockCommand implements Command {
  private product: Product;
  private quantity: number;

  constructor(product: Product, quantity: number) {
    this.product = product;
    this.quantity = quantity;
  }

  execute(): void {
    console.log(`Adicionando ${this.quantity} unidades ao estoque do produto ${this.product.getName()}`);
    this.product.addStock(this.quantity);
  }
}

export class Product {
  private name: string;
  private price: number;
  private stock: number;

  constructor(name: string, price: number, stock: number) {
    this.name = name;
    this.price = price;
    this.stock = stock;
  }

  getName(): string {
    return this.name;
  }

  setPrice(newPrice: number): void {
    this.price = newPrice;
    console.log(`Novo preço definido para ${this.price}`);
  }

  getPrice(): number {
    return this.price;
  }

  addStock(quantity: number): void {
    this.stock += quantity;
    console.log(`Estoque atualizado para ${this.stock}`);
  }
}

const product = new Product('Produto A', 100, 50);

const changePriceCommand = new ChangePriceCommand(product, 120);
const addStockCommand = new AddStockCommand(product, 20);

changePriceCommand.execute();
addStockCommand.execute();
