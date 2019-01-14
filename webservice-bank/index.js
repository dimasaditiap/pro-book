const express = require("express");
const mysql = require("mysql");
var cors = require('cors');

const credentials = require('./credentials.js');

const app = express();
app.use(express.json());
app.use(cors());

const connection = mysql.createConnection(credentials);

connection.connect();

app.get("/customers/:username", (req, res) => {
  connection.query(
    `SELECT * FROM customers WHERE username = '${req.params.username}'`,
    (err, rows, fields) => {
      if (err) return res.status(500).send("Error when fetch customer");

      res.send(rows[0]);
    }
  );
});

app.put("/customers", (req, res) => {
  connection.query(
    `SELECT * FROM customers WHERE card_number = ${req.body.card_number}`,
    (err, rows, fields) => {
      if (err) return res.status(500).send("Error when check card number");

      // Check is card number valid (no one has it) beside us
      if (rows.length == 1 && rows[0].username !== req.body.username)
        return res.status(400).send("Card number already exists");

      connection.query(
        `
          UPDATE customers
          SET card_number = '${req.body.card_number}'
          WHERE username = '${req.body.username}'
        `,
        (err, rows, fields) => {
          if (err) return res.status(500).send("Error when update customer");

          res.send("Successfully added");
        }
      );
    }
  );
});

app.put("/customers/check", (req, res) => {
  connection.query(
    `SELECT * FROM customers WHERE card_number = ${req.body.card_number}`,
    (err, rows, fields) => {
      if (err) return res.status(500).send("Error when check card number");

      // Check is card number valid (no one has it) beside us
      if (rows.length == 1 && rows[0].username !== req.body.username)
        return res.send("0");

      res.send("1")
    }
  );
});

app.post("/customers/:card", (req, res) => {
  connection.query(
    `SELECT * FROM customers WHERE card_number = ${req.params.card}`,
    (err, rows, fields) => {
      if (err) return res.status(500).send("Error when fetch card");

      if (rows.length == 1) {
        res.send("0");
      } else {
        res.send("1");
      }
    }
  );
});

app.post("/customers", (req, res) => {
  connection.query(
    `SELECT * FROM customers WHERE card_number = '${req.body.card_number}'`,
    (err, rows, fields) => {
      if (err) {
        return res.status(500).send("Error when check card number");
      } 

      // Check is card number valid (no one has it)
      if (rows.length == 1)
        return res.status(400).send("Card number already exists");

      // Add new customer to database
      connection.query(
        `
        INSERT INTO customers (username, card_number) 
        VALUES ('${req.body.username}', '${req.body.card_number}')
      `,
        (err, rows, fields) => {
          if (err) return res.status(500).send("Error when add new customer");

          res.send("User added");
        }
      );
    }
  );
});

app.post("/transactions", (req, res) => {
  // Check if amount is <= sender balance
  connection.query(
    `
      SELECT balance FROM customers
      WHERE card_number = '${req.body.sender_cardnumber}'
    `,
    (err, rows, fields) => {
      if (err) return res.status(500).send("Error when check customer balance");

      if (rows[0].balance < req.body.amount)
        res.status(400).send("Sender balance is not enough");

      // Decrease sender balance by amount
      connection.query(
        `
          UPDATE customers SET balance = ${rows[0].balance - req.body.amount}
          WHERE card_number = ${req.body.sender_cardnumber}
        `,
        (err, rows, fields) => {
          if (err)
            return res.status(500).send("Error when decrease sender balance");

          // Increase receiver balance by amount
          connection.query(
            `
            UPDATE customers SET balance = balance + ${req.body.amount}
            WHERE card_number = ${req.body.receiver_cardnumber}
          `,
            (err, rows, fields) => {
              if (err)
                return res.status(500).send("Error increase receiver balance");

              // Add new transaction to database
              connection.query(
                `
                INSERT INTO transactions (sender_cardnumber, receiver_cardnumber, amount)
                VALUES (
                  ${req.body.sender_cardnumber}, 
                  ${req.body.receiver_cardnumber}, 
                  ${req.body.amount}
                )
              `,
                (err, rows, fields) => {
                  if (err)
                    return res.status(500).send("Error add new transaction");

                  res.send("Transaction success");
                }
              );
            }
          );
        }
      );
    }
  );
});

app.listen(3000, () => {
  console.log("Server is listening at port 3000");
});
