export interface Iterator<T> {
  next(): T;
  hasNext(): boolean;
}

export interface IterableCollection<T> {
  createIterator(): Iterator<T>;
}

export class ProductIterator implements Iterator<Product> {
  private collection: Product[];
  private position: number;

  constructor(collection: Product[]) {
    this.collection = collection;
    this.position = 0;
  }

  next(): Product {
    const product = this.collection[this.position];
    this.position++;
    return product;
  }

  hasNext(): boolean {
    return this.position < this.collection.length;
  }
}

export class ProductCollection implements IterableCollection<Product> {
  private products: Product[];

  constructor() {
    this.products = [];
  }

  addProduct(product: Product): void {
    this.products.push(product);
  }

  createIterator(): Iterator<Product> {
    return new ProductIterator(this.products);
  }
}

export class Product {
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
}

const collection = new ProductCollection();

collection.addProduct(new Product('Produto A', 100));
collection.addProduct(new Product('Produto B', 150));
collection.addProduct(new Product('Produto C', 200));

const iterator = collection.createIterator();

console.log('Iterando sobre os produtos:');
while (iterator.hasNext()) {
  const product = iterator.next();
  console.log(`${product.getName()} - Preço: ${product.getPrice()}`);
}
