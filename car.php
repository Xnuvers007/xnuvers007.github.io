

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <title>Car | Game</title>
    </head>
    <body>
        <center><br><br>
     <font Size="6" Color="red">Car<br>Code By Tn.Error404</font>
    </center>
    <style>
        body {
    margin: 0;
}

canvas{
    background: #0a5;
}

button{
    background: transparent;
    border: none;
    color: white;
    height: 100vh;
    font-size: 2em;
    position: absolute;
    top: 0;
    margin: 0;
    width: 100px;
}

button:hover{
    outline: none;
    
}

#b1{
    left: 0;
    background: -webkit-linear-gradient(left, green, transparent);
}

#b2{
    right: 0;
    background: -webkit-linear-gradient(right, green, transparent);
}
    </style>
        <canvas></canvas>
        <button id="b1"><</button>
        <button id="b2">></button>
    </body>
    <script>
        window.onload = () =>{
    const canvas = document.querySelector("canvas"),
          b1 = document.querySelector("#b1"),
          b2 = document.querySelector("#b2"),
          c = canvas.getContext("2d"),
          h = innerHeight,
          w = innerWidth;
    let isOver = false,
        nextPos,
        enemies = [],
        score = 0;
    
    canvas.height = h;
    canvas.width = w;
    
    b1.addEventListener("click", () => {
    if(nextPos-63>a.x)
        nextPos-=63;
    });
    b2.addEventListener("click", () => {
    if(nextPos+63<a.x+a.width)
        nextPos+=63;
    });
    
    function Area(){
        this.x = (w-197)/2;
        this.y = 0;
        this.width = 197;
        
        this.draw = () =>{
            c.fillStyle = "black";
            c.fillRect(this.x, this.y, this.width, h);
            c.fillStyle = "white";
            c.fillRect(this.x,this.y,2,h);
            c.fillRect(this.x+65, this.y, 2, h);
            c.fillRect(this.x+2*65, this.y, 2, h);
            c.fillRect(this.x+this.width-2, this.y, 2, h);
        }
    }
    
    function Player(x,y,color){
         this.x = x;
         this.y = y;
         this.color = color;
        
         this.draw = () =>{
             c.fillStyle = this.color;
             c.fillRect(this.x, this.y, 40, 80);
             c.fillStyle = "yellow";
             c.fillRect(this.x,this.y, 5,5);
             c.fillRect(this.x+35,this.y, 5,5);
             c.fillStyle = "red";
             c.fillRect(this.x,this.y+75,5,5);
             c.fillRect(this.x+35,this.y+75,5,5);
             c.fillStyle = "cyan";
             c.beginPath();
             c.arc(this.x+20,this.y+40,19,0,2*Math.PI);
             c.fill();
             
             c.fillStyle = "darkblue";
             c.fillRect(this.x, this.y+40, 40, 30);
         };
         
         this.move = () =>{
             if(this.x>nextPos)
                 this.x-=1.5;
             else if(this.x<nextPos)
                 this.x+=1.5;
          }
          
          this.collision = (other) =>{
              return (this.x >= other.x || this.x+40>=other.x) && this.x <= other.x+40 && this.y <= other.y+80 && (this.y >= other.y || this.y+80 >=other.y);
          };
    }
    
    function Enemy(x,y,color){
        this.x = x;
        this.y = y;
        this.color = color;
        
        this.draw = () =>{
                 c.fillStyle = this.color;
             c.fillRect(this.x, this.y, 40, 80);
             c.fillStyle = "red";
             c.fillRect(this.x,this.y, 5,5);
             c.fillRect(this.x+35,this.y, 5,5);
             c.fillStyle = "yellow";
             c.fillRect(this.x,this.y+75,5,5);
             c.fillRect(this.x+35,this.y+75,5,5);
             c.fillStyle = "cyan";
             c.beginPath();
             c.arc(this.x+20,this.y+40,19,0,2*Math.PI);
             c.fill();
             
             c.fillStyle = "darkred";
             c.fillRect(this.x, this.y+15, 40, 30);
        };
        
        this.move = () =>{
            if(this.y<h){
                this.y+=2;
            }
            else
            {
                score++;
                enemies.shift();
            }
        };
    }
    
    function spawn_enemy(){
        let e = new Enemy(a.x+14+Math.floor(Math.random()*3)*63, -80, "purple");
        enemies.push(e);
    }
    
    function start(){
        a = new Area();
        p = new Player(a.x+77, h-150, "blue");
        e = new Enemy(a.x+77, 10, "purple");
        enemies.push(e);
        nextPos = p.x;
    }
    
    function draw_score(){
        c.fillStyle = "white";
        c.font = "25px Monospace";
        c.textAlign = "center";
        c.fillText("Score: " + score, w/2,
       50);
    }
    
    function update(){
        if(!isOver)
       {   
        requestAnimationFrame(update);
        c.clearRect(0,0,w,h);
        a.draw();
        p.move();
        for(let i=0;i<enemies.length;i++)
        {
            enemies[i].move();
            enemies[i].draw();
            if(p.collision(enemies[i])){
                isOver = true;
            }
        }
        p.draw();
        draw_score();
        }
        else{
            game_over();
        }
    }
    
    function game_over(){
        c.fillStyle = "red";
        c.textAlign = "center";
        c.font = "50px Monospace";
        c.fillText("Game over!", w/2, h/2);
        canvas.style.filter = "grayscale(50%)";
    }
    
    start();
    setInterval(spawn_enemy, 1800);
    update();
};
    </script>
</html>