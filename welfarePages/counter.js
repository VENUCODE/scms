

const data = {
  config: {
    min: 0,
    max: 100,
    speed: 100,
    increment: 1,
    delay: 0
  },
  attributes: {
    min: "data-counter-min",
    max: "data-counter-max",
    speed: "data-counter-speed",
    increment: "data-counter-increment",
    delay: "data-counter-delay"
  }
};


class Screen {

  render(value) {
    this.element.innerHTML = value;
  }
}



class Counter extends Screen {

  constructor(selector, min, max, speed, increment, delay) {
    super();
    this.selector = selector;
    this.element = document.querySelector(this.selector);
    this.min =
      parseInt(this.element.getAttribute(data.attributes.min)) ||
      data.config.min;
    this.max =
      parseInt(this.element.getAttribute(data.attributes.max)) ||
      data.config.max;
    this.speed =
      parseInt(this.element.getAttribute(data.attributes.speed)) ||
      data.config.speed;
    this.increment =
      parseInt(this.element.getAttribute(data.attributes.increment)) ||
      data.config.increment;
    this.delay =
      parseInt(this.element.getAttribute(data.attributes.delay)) ||
      data.config.delay;
    this.current = this.min;
    this.interval;
    this.initialize();
  }


  die() {
    clearTimeout(this.interval);
    return;
  }


  count() {
    if (this.current < this.max) {
      this.current += this.increment;
      this.render(this.current);
    } else if (this.current > this.max) {
      this.render(this.max);
      this.die();
    }
  }



  initialize() {
    if (this.delay > 0) {
      setTimeout(() => {
        this.interval = setInterval(this.count.bind(this), this.speed);
      }, this.delay);
    } else {
      this.interval = setInterval(this.count.bind(this), this.speed);
    }
    this.render(this.min);
  }
}

