pipeline {
    agent any

    environment {
        DOCKER_IMAGE = 'amitshrestha1/leavemgmtsys:latest'
        DOCKERHUB_CREDENTIALS = 'dockerhub_id'
        AZURE_VM_SSH_CREDENTIALS = 'azure_vm'
        AZURE_VM_IP = '20.2.193.110'
        AZURE_VM_USER = 'testadmin'
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
                        for pkg in docker.io docker-doc docker-compose docker-compose-v2 podman-docker containerd runc; do 
                            sudo apt-get remove -y $pkg; 
                        done

                        # Add Docker's official GPG key:
                        sudo apt-get update
                        sudo apt-get install -y ca-certificates curl
                        sudo install -m 0755 -d /etc/apt/keyrings
                        sudo curl -fsSL https://download.docker.com/linux/ubuntu/gpg -o /etc/apt/keyrings/docker.asc
                        sudo chmod a+r /etc/apt/keyrings/docker.asc

                        # Add the repository to Apt sources:
                        echo "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.asc] https://download.docker.com/linux/ubuntu \
                        $(. /etc/os-release && echo "$VERSION_CODENAME") stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

                        sudo apt-get update
                        sudo apt-get install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
                        sudo apt-get install unzip
                        # Deploy Laravel application
                        sudo mkdir -p /var/www/laravel-app
                        sudo unzip -o /home/testadmin/laravel-app.zip -d /var/www/laravel-app
                        cd /var/www/laravel-app
                        sudo docker compose up -d --build
                        sudo docker compose exec -T app composer install --no-dev --no-interaction --optimize-autoloader
                        sudo docker compose exec -T app php artisan migrate --seed
                        sudo docker compose exec -T app php artisan optimize:clear
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
