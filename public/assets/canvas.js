
const canvas = document.querySelector('canvas')
const c = canvas.getContext('2d')

canvas.width = innerWidth
canvas.height = innerHeight

function randomIntFromRange(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min)
}

const colors = ['#2185C5', '#7ECEFD', '#FFF6E5', '#FF7F66']

// Event Listeners

addEventListener('resize', () => {
    canvas.width = innerWidth
    canvas.height = innerHeight

    init()
})

// Objects
function Star(x, y, radius, color) {
    this.x = x
    this.y = y
    this.radius = radius
    this.color = color
    this.velocity = {
    	x: (Math.random() - 0.5) * 8,
    	y: 2
    } 
    this.friction = 0.8
    this.gravity = 0.5
}

Star.prototype.draw = function() {
    c.save()
    c.beginPath()
    c.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false)
    c.fillStyle = this.color
    c.shadowColor = '#E3EAEF'
    c.shadowBlur = 20
    c.fill()
    c.closePath()
    c.restore()
}

Star.prototype.update = function() {
    this.draw()
    
    //when object reaches bottom
    if (this.y + this.radius + this.velocity.y > canvas.height) {
    	this.velocity.y = -this.velocity.y * this.friction
    	this.shoot()
    } else {
    	this.velocity.y += this.gravity
    }

    //hits screen
     if (this.x + this.radius + this.velocity.x > canvas.width || this.x - this.radius <= 0) {
    	this.velocity.x = -this.velocity.x * this.friction
    	this.shoot()
    } 

    this.y += this.velocity.y
    this.x += this.velocity.x
}

Star.prototype.shoot = function() {
	this.radius -= 3
	for (let i = 0; i<8; i++) {
		explosions.push(new Explosion(this.x, this.y, 2))
	}
}

function Explosion(x, y, radius, color) {
	Star.call(this, x, y, radius, color)
	 this.velocity = {
    	x: randomIntFromRange(-5,5),
    	y: randomIntFromRange(-15,15),
    }
    this.friction = 0.8
    this.gravity = 0.1
    this.ttl = 100
    this.opacity = 1
}

Explosion.prototype.draw = function() {
	c.save()
    c.beginPath()
    c.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false)
    c.fillStyle = `rgba(227, 234, 239, ${this.opacity})`
    c.shadowColor = '#E3EAEF'
    c.shadowBlur = 20
    c.fill()
    c.closePath()
    c.restore()
}

Explosion.prototype.update = function() {
    this.draw()
    
    //when object reaches bottom
    if (this.y + this.radius + this.velocity.y > canvas.height) {
    	this.velocity.y = -this.velocity.y * this.friction
    } else {
    	this.velocity.y += this.gravity
    }

    this.y += this.velocity.y
    this.x += this.velocity.x
    this.ttl -= 1
    this.opacity -= 1 / this.ttl
}


// Implementation
const backgroundGradient = c.createLinearGradient(0, 0, 0, canvas.height)
backgroundGradient.addColorStop(0, '#171e26')
backgroundGradient.addColorStop(1, '#3f586b')

let stars
let explosions
let backgrounStars
let trigger = 0
let randomspan = 75
function init() {
    stars = []
    explosions = []
    backgroundStars = []

    //for (let i = 0; i < 1; i++)  {
    //  stars.push(new Star(canvas.width / 2, 30, 30, '#E3EAEF')) }
    

    for (let i = 0; i < 100; i++) {
    	const x = Math.random() * canvas.width
    	const y = Math.random() * canvas.height
    	const radius = Math.random() * 3
    	backgroundStars.push(new Star(x, y, radius, 'white'))
    }
}

// Animation Loop
function animate() {
    requestAnimationFrame(animate)
    c.fillStyle = backgroundGradient
    c.fillRect(0, 0, canvas.width, canvas.height)

    stars.forEach((star, index) => {
    	star.update()
    	if (star.radius == 0) {
    		stars.splice(index, 1)
    	}
    })

    explosions.forEach((explosion, index) => {
    	explosion.update()
    	if (explosion.ttl == 0) {
    		explosions.splice(index, 1)
    	}
    })

    backgroundStars.forEach(backgroundStar => {
    	backgroundStar.draw()
    })

    trigger ++

    if (trigger % randomspan == 0) {
    	const radius = 6
    	const x = Math.max(radius, Math.random() * canvas.width - radius)
    	stars.push(new Star(x, -100, radius, 'white'))
    	randomspan = randomIntFromRange(75, 100)
    }
}

init()
animate()

   