#!/bin/bash

curl -X POST http://localhost:8080/api/machines -H "Content-Type: application/json" -d '{"id": 1, "name": "Machine 1", "status": "Running"}'
curl -X POST http://localhost:8080/api/machines -H "Content-Type: application/json" -d '{"id": 2, "name": "Machine 2", "status": "Stopped"}'
curl -X POST http://localhost:8080/api/machines -H "Content-Type: application/json" -d '{"id": 3, "name": "Machine 3", "status": "Maintenance"}'
