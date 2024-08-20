pipeline {
    agent any

    environment {
        DOCKER_IMAGE = 'amitshrestha1/leavemgmtsys:latest'
        DOCKERHUB_CREDENTIALS = 'dockerhub_id'
        AZURE_VM_SSH_CREDENTIALS = 'azure_vm'
        AZURE_VM_IP = '20.2.147.200'
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
                        scp -o StrictHostKeyChecking=no -i ${SSH_KEY} ${ARTIFACT_FILE} ${AZURE_VM_USER}@${AZURE_VM_IP}:${DEPLOYMENT_PATH}

                        # SSH into the VM and perform installation and deployment tasks
                        ssh -o StrictHostKeyChecking=no -i ${SSH_KEY} ${AZURE_VM_USER}@${AZURE_VM_IP} <<'EOF'
                            sudo apt-get update &&
                            curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add - &&
    
                            # Add Docker's APT repository if not already present
                            if ! grep -q "^deb .*docker.com" /etc/apt/sources.list.d/docker.list; then
                                echo "deb [arch=$(dpkg --print-architecture) https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
                            fi &&
                            sudo apt-get update &&
                            sudo apt-get install -y docker.io docker-compose &&
                            mkdir -p /var/www/laravel-app &&
                            unzip -o ${DEPLOYMENT_PATH}/${ARTIFACT_FILE} -d /var/www/laravel-app &&
                            cd /var/www/laravel-app &&
                            sudo docker-compose up -d --build &&
                            sudo docker-compose exec -T app composer install --no-dev --no-interaction --optimize-autoloader &&
                            sudo docker-compose exec -T app php artisan migrate --seed &&
                            sudo docker-compose exec -T app php artisan optimize:clear
                        'EOF'
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
