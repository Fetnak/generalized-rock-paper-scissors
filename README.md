# Generalized Rock-Paper-Scissors Game

This script implements a generalized rock-paper-scissors game with arbitrary moves and proof of fairness through cryptographically strong random keys and HMACs (calculated using SHA3-256 algorithm).

### Requirements

* PHP >=8.3.4
* Composer >=2.7.2

### Usage

Installation:
```
git clone https://github.com/Fetnak/generalized-rock-paper-scissors.git
cd generalized-rock-paper-scissors/src
php main.php Rock Paper Scissors
```

### Example Output

```
$ php main.php Rock Paper Scissors
HMAC: ee75cd65ddb65077a04fb6a965ad185ecb1717fec43a6eaa1357fdf7d402fed0 
1 - Rock
2 - Paper
3 - Scissors
? - help
0 - exit
Enter your move: 1
Your move: Rock
Computer move: Paper
HMAC key: d748be545ba002ee158a6312dbf08b350280cd3989b5d5b69d38f468859ed3c2
You win!
```
