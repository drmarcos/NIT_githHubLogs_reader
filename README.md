# NIT_githHubLogs_reader
Sistema para leitura dos arquivos de log das ações feitas pelos participantes de um respoitório
Desenvolvido em php usando banco de dados Mysql.
- O objetivo deste projeto é contirbuir para o gerenciamento das ações dos participantes de um repositório, de forma a facilitar o "gestor" na obtenção de dados importantes na execussão dos trabalhos dentro deo Github.
- Este modelo foi produzido inicialmente a partir de dados de Respositório da Escola de Saúde Pública do Ceara (ESPCE) como um produto do Núcleo de Inovação Tecnológica (NIT)
Leitura de dados por informações(5) e ações executadas por participantes
Inicialmente faz uma leitura para buscar todas as formas de ações executadas durante o registro dos logs

Até o agora (28/06/2020) identifiquei as seguintes ações:
--------------------------------------------------------
account.plan_change
action
commit_comment.update
hook.config_changed
hook.create
hook.destroy
integration_installation.create
integration_installation.repositories_added
integration_installation.repositories_removed
issue_comment.destroy
issue_comment.update
org.add_member
org.audit_log_export
org.cancel_invitation
org.create
org.invite_member
org.oauth_app_access_approved
org.oauth_app_access_requested
org.remove_member
org.update_default_repository_permission
org.update_member
org.update_terms_of_service
organization_default_label.create
organization_default_label.destroy
organization_default_label.update
profile_picture.update
project.access
project.close
project.create
project.delete
project.link
project.open
project.rename
project.update_org_permission
project.update_team_permission
project.update_user_permission
protected_branch.create
protected_branch.destroy
protected_branch.dismissal_restricted_users_teams
protected_branch.dismiss_stale_reviews
protected_branch.policy_override
protected_branch.update_admin_enforced
protected_branch.update_pull_request_reviews_enfor
repo.add_member
repo.create
repo.destroy
repo.pages_create
repo.pages_destroy
repo.pages_https_redirect_enabled
repo.pages_source
repo.remove_member
repo.rename
repo.transfer
repo.update_member
repository_image.create
repository_image.destroy
repository_vulnerability_alert.dismiss
team.add_member
team.add_repository
team.create
team.remove_member
team.rename
team.update_repository_permission
