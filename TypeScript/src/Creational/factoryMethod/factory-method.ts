export abstract class ProductFactory {
  abstract createProduct(): Product;

  public deliverProduct(): string {
    const product = this.createProduct();
    return `Delivering ${product.deliver()}`;
  }
}

export class TechProductFactory extends ProductFactory {
  public createProduct(): Product {
    return new TechProduct();
  }
}

export class FoodProductFactory extends ProductFactory {
  public createProduct(): Product {
    return new FoodProduct();
  }
}

export interface Product {
  deliver(): string;
}

export class TechProduct implements Product {
  public deliver(): string {
    return 'Tech product delivery with postal';
  }
}

export class FoodProduct implements Product {
  public deliver(): string {
    return 'Food product delivery with motoboy';
  }
}

export class Demo {
  public static main(): void {
    const factories: ProductFactory[] = [new TechProductFactory(), new FoodProductFactory()];

    factories.forEach((factory) => {
      console.log(factory.deliverProduct());
    });
  }
}

Demo.main();
