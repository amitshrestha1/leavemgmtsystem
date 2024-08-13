pipeline {
    agent any

    environment {
        DOCKER_IMAGE = 'amitshrestha1/leavemgmtsys:latest'
        DOCKERHUB_CREDENTIALS = 'dockerhub_id'
        AZURE_VM_SSH_CREDENTIALS = 'azure_vm'
        AZURE_VM_IP = '20.2.2.30'
        AZURE_VM_USER = 'testadmin'
        SSH_PASSWORD = 'Admin@123'
    }

    stages {
        stage('Checkout') {
            steps {
                sshagent(['Github']) {
                    checkout([$class: 'GitSCM',
                        branches: [[name: '*/dev']], // Replace 'dev' with your branch name
                        userRemoteConfigs: [[url: 'git@github.com:amitshrestha1/leavemgmtsystem']] // Replace with your SSH URL
                    ])
                }
            }
        }

        stage('Build Docker Image') {
            steps {
                script {
                    docker.build(DOCKER_IMAGE, '--build-arg user=jenkins --build-arg uid=1000 .')
                }
            }
        }

        stage('Push to Docker Hub') {
            steps {
                script {
                    withCredentials([usernamePassword(credentialsId: DOCKERHUB_CREDENTIALS, usernameVariable: 'DOCKER_USERNAME', passwordVariable: 'DOCKER_PASSWORD')]) {
                        sh '''
                        echo "$DOCKER_PASSWORD" | docker login -u "$DOCKER_USERNAME" --password-stdin
                        docker push $DOCKER_IMAGE
                        '''
                    }
                }
            }
        }

        stage('Test Docker Image') {
            steps {
                script {
                    docker.image(DOCKER_IMAGE).inside {
                        sh '''
                        docker-compose up -d --build
                        # Add commands to test your application here
                        curl http://localhost:8005
                        docker-compose down
                        '''
                    }
                }
            }
        }

        stage('Deploy to Azure VM') {
            steps {
                script {
                    withCredentials([sshUserPrivateKey(credentialsId: AZURE_VM_SSH_CREDENTIALS, keyFileVariable: 'SSH_KEY')]) {
                        sh '''
                        sshpass -p $SSH_PASSWORD ssh -o StrictHostKeyChecking=no -i $SSH_KEY $AZURE_VM_USER@$AZURE_VM_IP << EOF
                        docker stop my-app || true
                        docker rm my-app || true
                        docker run -d --name my-app -p 80:80 $DOCKER_IMAGE
                        EOF
                        '''
                    }
                }
            }
        }
    }

    post {
        always {
            // Cleanup actions if needed
            echo("Pipeline Complete")
        }
    }
}
