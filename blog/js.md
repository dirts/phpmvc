#在javascript中继承是一个非常复杂的问题，比其他任何面香对象语言中的继承都复杂的多。在大多数其他面向对象语言中，继承一个类只需要使用一个关键字即可。与他们不同，在javascript中要想达到传承公共成员的目的，需要采取一系列措施。更有甚者，javascript属于使用原型继承（我们会向你证明这其实是一个极大的有点）的少数语言之一。得益于这种语言的灵活性，你即可以使用标准的基于类的继承，也可以更微妙一些（但也可以更有效一些）的原型式继承。


本章将讨论在javascript中创建子类的各种计数以及他们的适用场合。

## 为什么需要继承

在开始实际摆弄代码之前，我们先得搞清使用继承能带来什么好处，一般来说，在射击类的时候，我们希望能减少重复性的代码，并且尽量弱化对象间的耦合。使用继承符合前一个设计原则的需要。借助这种机制，你可以在现有类的基础上进行设计并充分利用他们已经具备的各种方法。而对设计进行修改也更为轻松。假设你需要让你几个类都拥有一个特定方式输出类结构的toString方法，当然可以用复制加粘贴的方法把定义toString方法的代码添加到每一个类中，但这样做的话，每当需要改变这个方法的工作方式时，你将不得不在每一个类中重复同样的修改。反之，如果你先创建一个ToStringProvider类，然后让那些类继承这个类，那么toString这个方法只需要在一个地方声明即可，

让一个类继承另一个类可能会导致二者产生强耦合，也即一个类以来与雷一个类的内部实现。我们将讨论一些有助于避免这种问题的技术，其中包含用掺元类为其他类提供方法这种技术。

## 类式继承

javascript可以被装扮成使用类式继承的语言。通过用函数来声明类、用关键字new来创建实例，javascript中的对象也能惟妙惟肖的模仿java或C++中的对象。下面是javascript中一个简单的类声明：

	/* Class Person */
	function Person(name){
    		this.name = name;
	}

	Person.prototype.getName = function(){
    		return this.name;
	}

首先要左的是创建构造函数。按照惯例，其名称就是类名，首字母应大写。在构造函数中，创建实例属性要使用关键字this。类的方法则被添加到其prototype对象中，就像例中的Person.prototype.getName那样。要创建该类的实例，只需要结合关键字new调用这个构造函数即可：

	var reader = new Person('Jhon Smith');
	reader.getName();

然后你可以访问所有的实例属性，也可以调用所有的实例方法。这是javascript中一个非常简单的类的例子。

## 原型链

创建继承Person的类则要复杂一些:

	/* Class Author */

	function Author(name,books){
    		Person.call(this,name); //Call the superclass's constructor in the scope of this.
    		this.books = books; //Add an attrbute to Author.
	}

	Author.prototype = new Person();
	Author.prototype.constructor = Author;
	Author.prototype.getBooks = function(){
    		return this.books;
	}

让一个类继承另一个类需要用到许多行代码（不像大多数别的面向对象语言中那样只用一个关键字extend即可)。首先要做的是像前一个实例中那样创建一个构造函数。在构造函数中，调用超类的构造函数，并将name参数传给它。这行代码需要解释一下。在使用new 运算符的时候，系统会为你做一些事。它先创建一个空对象，然后调用构造函数，在此过程中这个空对象处于作用域链的最前端。而在Author函数中调用超类的构造函数时，你必须手工完成同样的任务。
Person.call(this,name)这条语句调用了Person构造函数，并且在此过程中让那个空对象（用this代表）处于作用域链的最前端，而name则被作为参数传入。

下一步是设置原型链。尽管相关代码比较简单，但实际上是一个副厂复杂的话题。前面已经说过，javascript没有extend 关键字。但是在javascript中每个对象都有一个名为prototype的属性，这个属性要么指向一个对象，要么是null。在访问对象的某个成员时（比如reader.getName），如果这个成员为见于当前对象，那么javascript会在prototype属性所指的对象中查找他，如果在那个对象中也没有找到，那么javascript会沿着原型链向上逐一访问每个原型对象，知道找到这个成员（或已经查国原型链最顶端的Object.prototype对象）。这意味着为了让一个类继承另一个类，只需将子类的prototype设置为指向超类的一个实例即可。这与其他语言中的继承机制迥然不同，可能会非常费解，而且有违直觉。
