export interface Visitor {
  visitProductA(product: ProductA): void;
  visitProductB(product: ProductB): void;
}

export interface Element {
  accept(visitor: Visitor): void;
}

export class ProductA implements Element {
  private name: string;
  private price: number;

  constructor(name: string, price: number) {
    this.name = name;
    this.price = price;
  }

  getName(): string {
    return this.name;
  }

  getPrice(): number {
    return this.price;
  }

  accept(visitor: Visitor): void {
    visitor.visitProductA(this);
  }
}

export class ProductB implements Element {
  private name: string;
  private stock: number;

  constructor(name: string, stock: number) {
    this.name = name;
    this.stock = stock;
  }

  getName(): string {
    return this.name;
  }

  getStock(): number {
    return this.stock;
  }

  accept(visitor: Visitor): void {
    visitor.visitProductB(this);
  }
}

export class ConcreteVisitor implements Visitor {
  visitProductA(product: ProductA): void {
    console.log(`Visitor está processando ${product.getName()} com preço ${product.getPrice()}`);
  }

  visitProductB(product: ProductB): void {
    console.log(`Visitor está processando ${product.getName()} com estoque ${product.getStock()}`);
  }
}

const productA = new ProductA('Produto A', 100);
const productB = new ProductB('Produto B', 50);
const visitor = new ConcreteVisitor();

productA.accept(visitor);
productB.accept(visitor);
