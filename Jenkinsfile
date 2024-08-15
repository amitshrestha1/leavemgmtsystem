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
        // Other stages...

        stage('Deploy to Azure VM') {
            steps {
                script {
                    withCredentials([sshUserPrivateKey(credentialsId: AZURE_VM_SSH_CREDENTIALS, keyFileVariable: 'SSH_KEY')]) {
                        sh '''
                        # Upload the artifact
                        sshpass -p ${SSH_PASSWORD} scp -o StrictHostKeyChecking=no -i ${SSH_KEY} ${ARTIFACT_FILE} ${AZURE_VM_USER}@${AZURE_VM_IP}:${DEPLOYMENT_PATH}

                        # SSH into the VM and perform installation and deployment tasks
                        sshpass -p ${SSH_PASSWORD} ssh -o StrictHostKeyChecking=no -i ${SSH_KEY} ${AZURE_VM_USER}@${AZURE_VM_IP} << 'EOF'
                            sudo apt-get update &&
                            sudo apt-get install -y lsb-release ca-certificates curl gnupg &&
                            curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg &&
                            echo "deb [arch=amd64 signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu jammy stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null &&
                            sudo apt-get update &&
                            sudo apt-get install -y docker-ce docker-ce-cli containerd.io docker-compose &&
                            mkdir -p /var/www/laravel-app &&
                            unzip -o ${DEPLOYMENT_PATH}/${ARTIFACT_FILE} -d /var/www/laravel-app &&
                            cd /var/www/laravel-app &&
                            sudo docker-compose up -d --build &&
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
            echo("Pipeline Complete")
        }
    }
}
