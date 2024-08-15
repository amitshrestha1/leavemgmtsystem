pipeline {
    agent any

    environment {
        DOCKER_IMAGE = 'amitshrestha1/leavemgmtsys:latest'
        DOCKERHUB_CREDENTIALS = 'dockerhub_id'
        AZURE_VM_SSH_CREDENTIALS = 'azure_vm'
        AZURE_VM_IP = '20.2.145.173'
        AZURE_VM_USER = 'testadmin'
        SSH_PASSWORD = 'Admin@123'
        ARTIFACT_FILE = 'laravel-app.zip'
        DEPLOYMENT_PATH = '/home/testadmin'
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

        // stage('Build Docker Image') {
        //     steps {
        //         script {
        //             docker.build(DOCKER_IMAGE, '--build-arg user=jenkins --build-arg uid=1000 .')
        //         }
        //     }
        // }

        // stage('Push to Docker Hub') {
        //     steps {
        //         script {
        //             withCredentials([usernamePassword(credentialsId: DOCKERHUB_CREDENTIALS, usernameVariable: 'DOCKER_USERNAME', passwordVariable: 'DOCKER_PASSWORD')]) {
        //                 sh '''
        //                 echo "$DOCKER_PASSWORD" | docker login -u "$DOCKER_USERNAME" --password-stdin
        //                 docker push $DOCKER_IMAGE
        //                 '''
        //             }
        //         }
        //     }
        // }

        // stage('Test Docker Image') {
        //     steps {
        //         script {
        //                 sh '''
        //                 docker-compose up -d --build
        //                 # Add commands to test your application here
        //                 curl http://localhost:8005
        //                 docker-compose down
        //                 '''
        //         }
        //     }
        // }
        stage('Zip Application'){
            steps{
                sh 'zip -r laravel-app.zip . -x "vendor/*"'
                archiveArtifacts artifacts: 'laravel-app.zip', allowEmptyArchive: false
            }
        }

        stage('Deploy to Azure VM') {
            steps {
                script {
                    withCredentials([sshUserPrivateKey(credentialsId: AZURE_VM_SSH_CREDENTIALS, keyFileVariable: 'SSH_KEY')]) {
                        sh '''
                        # Upload the artifact
                        sshpass -p ${SSH_PASSWORD} scp -o StrictHostKeyChecking=no -i ${SSH_KEY} ${ARTIFACT_FILE} ${AZURE_VM_USER}@${AZURE_VM_IP}:${DEPLOYMENT_PATH}

                        # SSH into the VM and perform installation and deployment tasks
                        sshpass -p ${SSH_PASSWORD} ssh -o StrictHostKeyChecking=no -i ${SSH_KEY} ${AZURE_VM_USER}@${AZURE_VM_IP} << EOF
                            # Install Docker
                            for pkg in docker.io docker-doc docker-compose docker-compose-v2 podman-docker containerd runc; do sudo apt-get remove $pkg; done &&
                            sudo apt-get update &&
                            sudo apt-get install ca-certificates curl &&
                            sudo install -m 0755 -d /etc/apt/keyrings &&
                            sudo curl -fsSL https://download.docker.com/linux/ubuntu/gpg -o /etc/apt/keyrings/docker.asc &&
                            sudo chmod a+r /etc/apt/keyrings/docker.asc &&

                            
                            echo \
                                "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.asc] https://download.docker.com/linux/ubuntu \
                                $(. /etc/os-release && echo "$VERSION_CODENAME") stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null &&
                            sudo apt-get update &&
                            
                            sudo apt-get install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin &&

                            sudo apt install docker-compose &&
                            # Create a directory for deployment
                            mkdir -p /var/www/laravel-app &&
                            
                            # Unzip the artifact
                            unzip -o ${DEPLOYMENT_PATH}${ARTIFACT_FILE} -d /var/www/laravel-app &&
                            
                            # Navigate to the application directory
                            cd /var/www/laravel-app &&
                            
                            # Run Docker Compose
                            sudo docker-compose up -d --build &&
                            
                            # Run Composer commands
                            sudo docker-compose exec -T app composer install --no-dev --no-interaction --optimize-autoloader &&
                            sudo docker-compose exec -T app php artisan migrate --seed &&
                            sudo docker-compose exec -T app php artisan optimize:clear
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
