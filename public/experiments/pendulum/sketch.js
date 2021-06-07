// The Nature of Code
// Daniel Shiffman
// http://natureofcode.com

// Pendulum

// A simple pendulum simulation
// Given a pendulum with an angle theta (0 being the pendulum at rest) and a radius r
// we can use sine to calculate the angular component of the gravitational force.

// Gravity Force = Mass * Gravitational Constant;
// Pendulum Force = Gravity Force * sine(theta)
// Angular Acceleration = Pendulum Force / Mass = gravitational acceleration * sine(theta);

// Note this is an ideal world scenario with no tension in the
// pendulum arm, a more realistic formula might be:
// Angular Acceleration = (g / R) * sine(theta)

// For a more substantial explanation, visit:

var p;
var btnstate = false;
var ballSize = 30;
var ropeLenght = 4;
var mode = 1;
var myFontNormal;
var elapseT;
var cx,cy,cr,button, balltarget;
function setup() {
  createCanvas(940, 360);
  // Make a new Pendulum with an origin position and armlength
 resetPendulum();
  
  p.timer();//set timer;
  
 button = createButton('Get Time');
  button.position(19, 19);
  button.mousePressed(btnControl);
  button.id('btnC');

  input = createInput(ballSize);
  input.size(85,20);
  input.attribute('type','number');
  input.position(19, 95);
  input.changed(resizeBall);
  input.input(resizeBall);
  input2 = createInput(ropeLenght);
  input2.size(85,20);
  input2.attribute('type','number');
  input2.position(19, 155);
  input2.changed(resizeRope);
  input2.input(resizeRope);
  
  elapseT = createP('--:--');
  elapseT.position(40,245);
  elapseT.style('font-size', '25px');
  elapseT.style('font-family', 'Oswald');
  elapseT.style('color','#fD0');
  elapseT.style('letter-spacing','2px');
  elapseT.id('elapseT');
  elapseT.style('font-weight','bold');

  showdegree = createP('');
  showdegree.position(465,-23);
  showdegree.style('font-size', '25px');
  showdegree.style('font-family', 'Oswald');
  showdegree.style('color','#357');
  showdegree.style('letter-spacing','2px');
  showdegree.id('showdegree');
  showdegree.style('font-weight','bold');
}

function draw() {
  background(255); 
  fill('#357');

  rect(8,65,123,260,10,0,10,0);
  fill('#fff');

 
  p.go();
  noStroke()
  textSize(22);
  fill('#fff');
  
  textFont('Oswald');
  textStyle('bold')
  text('TIME',45,210);
  text('ELAPSE TIME',15,270);
  fill('#fD0');
  
  fill('#fff');
  textSize(15);
  text('Object Size (Kg)',19,90);
  text('Rope Lenght (m)',19,150);
  //console.log(p.period);
  textFont('Oswald');
  textStyle('bolder');
  textSize(22);
  p.showTimer();
  
}
function resizeBall(){ 
  ballSize = this.value()
  p = new Pendulum(createVector(width / 2, 0), ropeLenght,ballSize);    
}
function resizeRope(){
  ropeLenght = this.value();
  p = new Pendulum(createVector(width / 2, 0), ropeLenght,ballSize);    
}
function btnControl(){  
    select('#elapseT').html(select('#timec').html());
 if(!btnstate){    
   p.stopDragging();
  //  p.timer();
    p.stop();
    p.stopTimer()
    p.timer();
  }else{
    btnstate = false;   //not in used for now    
  }
}

function resetPendulum() {
   p = new Pendulum(createVector(width / 2, 0), ropeLenght,ballSize);     
}
function mousePressed() {
  p.clicked(mouseX, mouseY);
}

function mouseReleased() {
   balltarget = p.clickTarget();
  if (balltarget == 1) {    
    p.stopDragging();
    p.restarttimer();  
  }

}
