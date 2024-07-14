export interface PricingStrategy {
  calculatePrice(basePrice: number): number;
}

export class RegularPricingStrategy implements PricingStrategy {
  calculatePrice(basePrice: number): number {
    return basePrice;
  }
}

export class DiscountPricingStrategy implements PricingStrategy {
  private discountPercentage: number;

  constructor(discountPercentage: number) {
    this.discountPercentage = discountPercentage;
  }

  calculatePrice(basePrice: number): number {
    return basePrice * (1 - this.discountPercentage / 100);
  }
}

export class PromotionalPricingStrategy implements PricingStrategy {
  private promotionAmount: number;

  constructor(promotionAmount: number) {
    this.promotionAmount = promotionAmount;
  }

  calculatePrice(basePrice: number): number {
    return basePrice - this.promotionAmount;
  }
}

export class Produto {
  private name: string;
  private basePrice: number;
  private pricingStrategy: PricingStrategy;

  constructor(name: string, basePrice: number, pricingStrategy: PricingStrategy) {
    this.name = name;
    this.basePrice = basePrice;
    this.pricingStrategy = pricingStrategy;
  }

  setPricingStrategy(pricingStrategy: PricingStrategy): void {
    this.pricingStrategy = pricingStrategy;
  }

  calculatePrice(): number {
    return this.pricingStrategy.calculatePrice(this.basePrice);
  }

  getName(): string {
    return this.name;
  }
}

const regularPricing = new RegularPricingStrategy();
const discountPricing = new DiscountPricingStrategy(10);
const promotionalPricing = new PromotionalPricingStrategy(5);

const produto1 = new Produto('Produto 1', 100, regularPricing);
console.log(`${produto1.getName()} preço: ${produto1.calculatePrice()}`);

const produto2 = new Produto('Produto 2', 100, discountPricing);
console.log(`${produto2.getName()} preço: ${produto2.calculatePrice()}`);

const produto3 = new Produto('Produto 3', 100, promotionalPricing);
console.log(`${produto3.getName()} preço: ${produto3.calculatePrice()}`);

produto1.setPricingStrategy(discountPricing);
console.log(`${produto1.getName()} preço com desconto: ${produto1.calculatePrice()}`);
