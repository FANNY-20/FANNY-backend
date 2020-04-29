ansiColor('xterm') {

    properties([gitLabConnection('gitlab')])

    def branchName =  env.BRANCH_NAME
    if (branchName.startsWith('release/') || branchName.startsWith('hotfix/')) {
        branchName = 'release'
    } else if (branchName.startsWith('feature/')) {
        branchName = 'feature'
    }

    def authorName
    def authorEmail

    // Change these vars
    def imageGroup = 'stop-covid'
    def imageName = 'stop-covid'
    // end

    def devEndpoint = 'dev.soyhuce.lan'

    def rocketChannel = 'projet-stop-covid'
    def rocketAvatar = 'https://jenkins-old.soyhuce.lan/static/548e7230/images/headshot.png'

    /*def secrets = [
        [$class: 'VaultSecret', path: "secret/rise/monegapro/rollbar",
            secretValues: [
                [$class: 'VaultSecretValue', envVar: 'rollbarClientToken', vaultKey: 'client_token'],
                [$class: 'VaultSecretValue', envVar: 'rollbarServerToken', vaultKey: 'server_token']
            ]
        ],
    ]*/

    def vaultConfiguration = [
      $class: 'VaultConfiguration',
      vaultUrl: 'https://vault.soyhuce.lan:443',
      vaultCredentialId: 'vault-token'
    ]


    node('slave-internal') {
        gitlabCommitStatus {

            stage('stop previous build') {
                def previousBuild = currentBuild.previousBuild;
                if (previousBuild != null && previousBuild.result == null) {
                    previousBuild.rawBuild.getExecutor().interrupt(
                        Result.ABORTED,
                        new CauseOfInterruption.UserInterruption("Aborted")
                    )
                }
            }

            stage('checkout repository sources') {
                def scmVars = checkout scm
                def commitHash = scmVars.GIT_COMMIT

                authorName = sh (script: "git --no-pager show -s --format=\'%an\' ${commitHash}",
                  returnStdout: true
                )
                authorEmail = sh (
                    script: "git --no-pager show -s --format=\'%ae\' ${commitHash}",
                    returnStdout: true
                )
            }

            stage('install composer dependencies') {
                sh "/usr/bin/php7.4 /usr/bin/composer install"
            }

            stage('install yarn dependencies') {
                sh "yarn"
            }

            stage('build frontend assets') {
                sh "yarn prod"
            }

            if (branchName != 'master') {
                stage('unit test') {
                    def testProject = "stopcovid-stopcovid--testing-${BRANCH_NAME}_${BUILD_NUMBER}"

                    try {
                        sh "docker-compose -f docker-compose.test.yml -p ${testProject} build"
                        sh "docker-compose -f docker-compose.test.yml -p ${testProject} up -d"
                        sh "docker-compose -f docker-compose.test.yml -p ${testProject} exec -T backend './deploy.test.sh' ${branchName}"
                    } catch (Exception e) {
                        rocketSend(
                            attachments: [[
                                audioUrl: '',
                                authorIcon: '',
                                authorName: "${authorName} ${authorEmail}",
                                color: 'red',
                                imageUrl: '',
                                messageLink: '',
                                text: "Unit tests failed - ${e.message} :sob:",
                                thumbUrl: '',
                                title: "${imageGroup}/${imageName}:${env.BRANCH_NAME}",
                                titleLink: "${env.BUILD_URL}console",
                                videoUrl: ''
                            ]],
                            channel: rocketChannel,
                            avatar: rocketAvatar,
                            message: '',
                            rawMessage: true
                        )
                        error "Failed: ${e}"

                    } finally {
                        sh "docker-compose -f docker-compose.test.yml -p ${testProject} down"
                    }
                }
            }

            if (branchName == 'develop') {
                stage('sonarqube') {
                    def sonarProject = "stopcovid-stopcovid--sonar-${BRANCH_NAME}_${BUILD_NUMBER}"

                    try {
                        docker.withRegistry("https://harbor.soyhuce.lan", "jenkins-docker-registry") {
                            sh "docker-compose -f docker-compose.sonar.yml -p ${sonarProject} up"
                        }
                    } catch (Exception e) {
                        rocketSend(
                            attachments: [[
                                audioUrl: '',
                                authorIcon: '',
                                authorName: "${authorName} ${authorEmail}",
                                color: 'red',
                                imageUrl: '',
                                messageLink: '',
                                text: "Failed to run sonarqube - ${e.message} :sob:",
                                thumbUrl: '',
                                title: "${imageGroup}/${imageName}:${env.BRANCH_NAME}",
                                titleLink: "${env.BUILD_URL}console",
                                videoUrl: ''
                            ]],
                            channel: rocketChannel,
                            avatar: rocketAvatar,
                            message: '',
                            rawMessage: true
                        )
                        error "Failed: ${e}"
                    } finally {
                        sh "docker-compose -f docker-compose.sonar.yml -p ${sonarProject} down"
                    }

                }

                stage('install production composer dependencies') {
                    sh "/usr/bin/php7.4 /usr/bin/composer require fzaninotto/faker"
                    sh "/usr/bin/php7.4 /usr/bin/composer install --no-dev -o"
                }

                stage('internal deploy') {
                    def devProject = "stopcovid-stopcovid--develop-${BUILD_NUMBER}"

                    if (currentBuild.nextBuild != null) {
                        echo "Not deploying server, next build will do it"
                        return;
                    }

                    try {
                        // down previously deployed server
                        previousDeployed = sh (
                          script: "cat /home/jenkins/workspace/stopcovid/stopcovid/current-deployed.txt || echo 0",
                          returnStdout: true
                        ).trim()

                        sh "docker-compose -f docker-compose.lan.yml -p ${previousDeployed} down || echo 0"

                        // deploy docker
                        /*wrap([$class: 'VaultBuildWrapper', configuration: vaultConfiguration, vaultSecrets: secrets]) {
                            withEnv([
                              "ROLLBAR_SERVER_TOKEN=${rollbarServerToken}",
                            ]) {*/
                                sh "docker-compose -f docker-compose.lan.yml -p ${devProject} build"
                                sh "docker-compose -f docker-compose.lan.yml -p ${devProject} up -d"
                                sh "docker-compose -f docker-compose.lan.yml -p ${devProject} exec -T backend './deploy.lan.sh'"
                            /*}
                        }*/

								        // update reference on currently deployed server
                        sh "mkdir -p /home/jenkins/workspace/stopcovid/stopcovid"
                        sh "echo ${devProject} > /home/jenkins/workspace/stopcovid/stopcovid/current-deployed.txt"
                    } catch (Exception e) {
                        sh "docker-compose -f docker-compose.lan.yml -p ${devProject} down"
                        rocketSend(
                            attachments: [[
                                audioUrl: '',
                                authorIcon: '',
                                authorName: "${authorName} ${authorEmail}",
                                color: 'red',
                                imageUrl: '',
                                messageLink: '',
                                text: "Failed to deploy internal build - ${e.message} :sob:",
                                thumbUrl: '',
                                title: "${imageGroup}/${imageName}:${env.BRANCH_NAME}",
                                titleLink: "${env.BUILD_URL}console",
                                videoUrl: ''
                            ]],
                            channel: rocketChannel,
                            avatar: rocketAvatar,
                            message: '',
                            rawMessage: true
                        )
                        error "Failed: ${e}"
                    }
                }
            }

            if (branchName == 'release') {
               //
            }

            if (branchName == 'master') {
                //
            }
        }
    }
}
