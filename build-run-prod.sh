docker build --tag history:latest -f docker/Dockerfile .
docker run -d -t -p 8080:80 history:latest
