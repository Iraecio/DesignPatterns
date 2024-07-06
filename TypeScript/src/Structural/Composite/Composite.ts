export abstract class Component {
  protected parent!: Component | null;

  public add(component: Component): void {}
  public remove(component: Component): void {}

  public getParent(): Component | null {
    return this.parent;
  }

  public setParent(parent: Component): void {
    this.parent = parent;
  }

  public abstract getPrice(): number;
}

export class Product extends Component {
  private price: number;

  constructor(price: number) {
    super();
    this.price = price;
  }

  public getPrice(): number {
    return this.price;
  }
}

export class Composite extends Component {
  private children: Component[] = [];

  public add(component: Component): void {
    this.children.push(component);
    component.setParent(this);
  }

  public remove(component: Component): void {
    const index = this.children.indexOf(component);
    if (index !== -1) {
      this.children.splice(index, 1);
    }
  }

  public getPrice(): number {
    let total = 0;
    for (const child of this.children) {
      total += child.getPrice();
    }
    return total;
  }
}

export class ShoppingCart {
  private root: Composite;

  constructor() {
    this.root = new Composite();
  }

  public addProduct(product: Product | Composite): void {
    this.root.add(product);
  }

  public removeProduct(product: Product | Composite): void {
    this.root.remove(product);
  }

  public getTotalPrice(): number {
    return this.root.getPrice();
  }
}

export class Demo {
  public static main(): void {
    const shoppingCart = new ShoppingCart();

    const product1 = new Product(10);
    const product2 = new Product(20);
    const product3 = new Product(30);

    shoppingCart.addProduct(product1);
    shoppingCart.addProduct(product2);
    shoppingCart.addProduct(product3);

    const composite = new Composite();
    composite.add(product1);
    composite.add(product2);

    shoppingCart.addProduct(composite);

    console.log('Total price:', shoppingCart.getTotalPrice());

    shoppingCart.removeProduct(product2);

    console.log('Total price after removing product2:', shoppingCart.getTotalPrice());
  }
}

Demo.main();
