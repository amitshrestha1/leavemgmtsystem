pipeline {
    agent any

    environment {
        DOCKER_IMAGE = 'amitshrestha1/leavemgmtsys:latest'
        DOCKERHUB_CREDENTIALS = 'dockerhub_id'
        AZURE_VM_SSH_CREDENTIALS = 'azure_vm'
        AZURE_VM_IP = '20.2.145.173'
        AZURE_VM_USER = 'testadmin'
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

        stage('Zip Application') {
            steps {
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
                        scp -o StrictHostKeyChecking=no -i ${SSH_KEY} ${ARTIFACT_FILE} ${AZURE_VM_USER}@${AZURE_VM_IP}:${DEPLOYMENT_PATH}

                        # SSH into the VM and perform installation and deployment tasks
                        ssh -o StrictHostKeyChecking=no -i ${SSH_KEY} ${AZURE_VM_USER}@${AZURE_VM_IP} << EOF
                            # Install Docker
                            sudo apt-get update &&
                            sudo apt-get install -y ca-certificates curl gnupg lsb-release &&
                            curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg &&
                            echo "deb [arch=\$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu \$(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null &&
                            sudo apt-get update &&
                            sudo apt-get install -y docker-ce docker-ce-cli containerd.io docker-compose-plugin &&
                            
                            # Create a directory for deployment
                            mkdir -p /var/www/laravel-app &&
                            
                            # Unzip the artifact
                            unzip -o ${DEPLOYMENT_PATH}/${ARTIFACT_FILE} -d /var/www/laravel-app &&
                            
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
