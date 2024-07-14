export interface Product {
  getName(): string;
  getPrice(): number;
}

export class RealProduct implements Product {
  private name: string;
  private price: number;

  constructor(name: string, price: number) {
    this.name = name;
    this.price = price;
  }

  getName(): string {
    console.log('Chamando getName do RealProduct');
    return this.name;
  }

  getPrice(): number {
    console.log('Chamando getPrice do RealProduct');
    return this.price;
  }
}

export class ProductProxy implements Product {
  private realProduct: RealProduct;
  private cachedName: string | null = null;
  private cachedPrice: number | null = null;

  constructor(realProduct: RealProduct) {
    this.realProduct = realProduct;
  }

  getName(): string {
    if (this.cachedName === null) {
      console.log('Cache vazio, chamando getName do RealProduct');
      this.cachedName = this.realProduct.getName();
    } else {
      console.log('Retornando nome do cache');
    }
    return this.cachedName;
  }

  getPrice(): number {
    if (this.cachedPrice === null) {
      console.log('Cache vazio, chamando getPrice do RealProduct');
      this.cachedPrice = this.realProduct.getPrice();
    } else {
      console.log('Retornando preço do cache');
    }
    return this.cachedPrice;
  }
}

const realProduct = new RealProduct('Produto A', 100);

const productProxy = new ProductProxy(realProduct);

console.log(productProxy.getName());
console.log(productProxy.getPrice());

console.log(productProxy.getName());
console.log(productProxy.getPrice());
