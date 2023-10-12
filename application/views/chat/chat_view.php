<main class="content">
    <div class="container p-0">
        <h1 class="h3 mb-3">Messages</h1>
        <div class="card">
            <div class="row g-0">
                <div class="col-12 col-lg-5 col-xl-3 border-right">
                    <div class="px-4 d-none d-md-block">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <input type="text" class="form-control my-3" placeholder="Search...">
                            </div>
                        </div>
                    </div>
                    <?php
                    foreach ($users as $user) {
                        ?>
                        <a href="<?= base_url('/chat') . '/chat_with_person/' . $user->id; ?>" class="list-group-item list-group-item-action border-0">
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1 ml-3">
                                    <?= $user->name ?>
                                    <div class="small"><span class="fas fa-circle chat-online"></span> Online</div>
                                </div>
                            </div>
                        </a>
                    <?php }
                    ?>	
                    <hr class="d-block d-lg-none mt-1 mb-0">
                </div>
                <div class="col-12 col-lg-7 col-xl-9">
                    <div class="position-relative">
                        <?php
                        foreach ($messages as $message) {
                            ?>
                            <div class="chat-messages p-4">
                                <div class="chat-message-right pb-4">
                                    <div>
                                        <div class="text-muted small text-nowrap mt-2"><?= $message->created_at; ?></div>
                                    </div>
                                    <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                        <div class="font-weight-bold mb-1"><?= $message->name; ?></div>
                                        <?= $message->message ?>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        ?>	
                    </div>
                    <?php echo form_open('chat/process/' . $id); ?>
                    <div class="flex-grow-0 py-3 px-4 border-top">
                        <div class="input-group">
                            <input type="text" name="message" class="form-control" placeholder="Escriba su mensaje">
                            <button class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('login_error'); ?>
                    <?php form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</main>