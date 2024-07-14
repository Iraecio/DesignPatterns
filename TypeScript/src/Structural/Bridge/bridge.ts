export interface Discount {
  apply(price: number): number;
}

export class PercentageDiscount implements Discount {
  private percentage: number;

  constructor(percentage: number) {
    this.percentage = percentage;
  }

  apply(price: number): number {
    return price - (price * this.percentage) / 100;
  }
}

export class FixedDiscount implements Discount {
  private amount: number;

  constructor(amount: number) {
    this.amount = amount;
  }

  apply(price: number): number {
    return price - this.amount;
  }
}

export abstract class Product {
  protected discount: Discount;
  protected name: string;
  protected price: number;

  constructor(name: string, price: number, discount: Discount) {
    this.name = name;
    this.price = price;
    this.discount = discount;
  }

  abstract getPrice(): number;

  getName(): string {
    return this.name;
  }

  setDiscount(discount: Discount): void {
    this.discount = discount;
  }
}

export class PhysicalProduct extends Product {
  getPrice(): number {
    return this.discount.apply(this.price);
  }
}

export class DigitalProduct extends Product {
  getPrice(): number {
    return this.discount.apply(this.price);
  }
}

const fixedDiscount = new FixedDiscount(20);
const percentageDiscount = new PercentageDiscount(10);

const physicalProduct = new PhysicalProduct('Produto Físico', 100, fixedDiscount);
const digitalProduct = new DigitalProduct('Produto Digital', 50, percentageDiscount);

console.log(`${physicalProduct.getName()} - Preço com desconto: ${physicalProduct.getPrice()}`);
console.log(`${digitalProduct.getName()} - Preço com desconto: ${digitalProduct.getPrice()}`);

physicalProduct.setDiscount(percentageDiscount);
console.log(`${physicalProduct.getName()} - Preço com novo desconto: ${physicalProduct.getPrice()}`);
