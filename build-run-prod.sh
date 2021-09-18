docker build --tag history:latest -f docker/Dockerfile .
docker run -d -t -p 8080:8080 history:latest
