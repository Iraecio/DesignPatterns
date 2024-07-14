export interface Product {
  getCategory(): string;
  getManufacturer(): string;
  getName(): string;
  getPrice(): number;
}

export class ProductFlyweight {
  constructor(private category: string, private manufacturer: string) {}

  getCategory(): string {
    return this.category;
  }

  getManufacturer(): string {
    return this.manufacturer;
  }
}

export class ConcreteProduct implements Product {
  private name: string;
  private price: number;
  private flyweight: ProductFlyweight;

  constructor(name: string, price: number, flyweight: ProductFlyweight) {
    this.name = name;
    this.price = price;
    this.flyweight = flyweight;
  }

  getCategory(): string {
    return this.flyweight.getCategory();
  }

  getManufacturer(): string {
    return this.flyweight.getManufacturer();
  }

  getName(): string {
    return this.name;
  }

  getPrice(): number {
    return this.price;
  }
}

export class FlyweightFactory {
  private flyweights: { [key: string]: ProductFlyweight } = {};

  getFlyweight(category: string, manufacturer: string): ProductFlyweight {
    const key = `${category}_${manufacturer}`;
    if (!(key in this.flyweights)) {
      this.flyweights[key] = new ProductFlyweight(category, manufacturer);
    }
    return this.flyweights[key];
  }

  getCount(): number {
    return Object.keys(this.flyweights).length;
  }
}
const flyweightFactory = new FlyweightFactory();

const product1 = new ConcreteProduct('Produto A', 100, flyweightFactory.getFlyweight('Eletrônicos', 'Samsung'));
const product2 = new ConcreteProduct('Produto B', 200, flyweightFactory.getFlyweight('Eletrônicos', 'Samsung'));
const product3 = new ConcreteProduct('Produto C', 150, flyweightFactory.getFlyweight('Eletrodomésticos', 'LG'));

console.log(
  `${product1.getName()} - Categoria: ${product1.getCategory()}, Fabricante: ${product1.getManufacturer()}, Preço: R$${product1.getPrice()}`,
);
console.log(
  `${product2.getName()} - Categoria: ${product2.getCategory()}, Fabricante: ${product2.getManufacturer()}, Preço: R$${product2.getPrice()}`,
);
console.log(
  `${product3.getName()} - Categoria: ${product3.getCategory()}, Fabricante: ${product3.getManufacturer()}, Preço: R$${product3.getPrice()}`,
);

console.log(`Quantidade de flyweights criados: ${flyweightFactory.getCount()}`);
