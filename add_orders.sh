#!/bin/bash

curl -X POST http://localhost:8080/api/orders -H "Content-Type: application/json" -d '{
    "id": 1,
    "product": "Product 1",
    "quantity": 100,
    "startTime": "2024-06-11T09:00:00",
    "endTime": "2024-06-11T17:00:00",
    "status": "In Progress"
}'
curl -X POST http://localhost:8080/api/orders -H "Content-Type: application/json" -d '{
    "id": 2,
    "product": "Product 2",
    "quantity": 200,
    "startTime": "2024-06-12T09:00:00",
    "endTime": "2024-06-12T17:00:00",
    "status": "Pending"
}'
curl -X POST http://localhost:8080/api/orders -H "Content-Type: application/json" -d '{
    "id": 3,
    "product": "Product 3",
    "quantity": 300,
    "startTime": "2024-06-13T09:00:00",
    "endTime": "2024-06-13T17:00:00",
    "status": "Completed"
}'
