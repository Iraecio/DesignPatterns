export interface Memento {
  getState(): any;
  getName(): string;
  getDate(): string;
}

export class ProductMemento implements Memento {
  private state: any;
  private date: string;

  constructor(state: any) {
    this.state = { ...state };
    this.date = new Date().toISOString();
  }

  getState(): any {
    return this.state;
  }

  getName(): string {
    return `Memento (${this.date})`;
  }

  getDate(): string {
    return this.date;
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

  setName(name: string): void {
    this.name = name;
  }

  setPrice(price: number): void {
    this.price = price;
  }

  setStock(stock: number): void {
    this.stock = stock;
  }

  save(): Memento {
    return new ProductMemento({
      name: this.name,
      price: this.price,
      stock: this.stock,
    });
  }

  restore(memento: Memento): void {
    const state = memento.getState();
    this.name = state.name;
    this.price = state.price;
    this.stock = state.stock;
  }

  getName(): string {
    return this.name;
  }

  getPrice(): number {
    return this.price;
  }

  getStock(): number {
    return this.stock;
  }

  getDetails(): string {
    return `Produto: ${this.name}, Preço: ${this.price}, Estoque: ${this.stock}`;
  }
}

export class Caretaker {
  private mementos: Memento[] = [];
  private originator: any;

  constructor(originator: any) {
    this.originator = originator;
  }

  backup(): void {
    console.log('Caretaker: Salvando o estado do Originator...');
    this.mementos.push(this.originator.save());
  }

  undo(): void {
    if (!this.mementos.length) {
      return;
    }
    const memento = this.mementos.pop();
    console.log('Caretaker: Restaurando o estado para:', memento?.getName());
    this.originator.restore(memento);
  }

  showHistory(): void {
    console.log('Caretaker: Aqui está o histórico de mementos:');
    for (const memento of this.mementos) {
      console.log(memento.getName());
    }
  }
}

const product = new Product('Produto A', 100, 50);

const caretaker = new Caretaker(product);

caretaker.backup();
console.log(product.getDetails());

product.setName('Produto B');
product.setPrice(150);
product.setStock(30);
console.log(product.getDetails());

caretaker.backup();

product.setName('Produto C');
product.setPrice(200);
product.setStock(20);
console.log(product.getDetails());

caretaker.undo();
console.log(product.getDetails());

caretaker.undo();
console.log(product.getDetails());
