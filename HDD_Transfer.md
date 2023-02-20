# Transfer Linux to smaller HDD

1. Build partition identical to the smaller and max out the larger:
* 1 small around 537MB
* 1 extended for the rest
* ext4 in the extended

2. Image smaller partition and restore to pther small partition

3. If the bigger drive contains files that should be excluded from the cop, such as large drive images, prepare a text file listing the files not to include in the copy and state it for the `--exclude-from` argument (below text_file_listing_exclusions). Then
`rsync -avx --exclude-from 'text_file_listing_exclusions' /path/to/source /path/to/target`

4. `sudo mkdir /mnt/newdrive`

5. `sudo fdisk -l` and see which is the destination drive -> sdx

6. `sudo blkid` and note the UUID of the destination drive

7. `sudo mount /dev/sdx /mnt/newdrive`

8. `sudo nano /mnt/newdrive/etc/fstab` and search and replace the UUID by the new UUID found in step 6.

9. `sudo grub-install --bout-directory=/mnt/newdrive/boot /dev/sdx`

Should be OK.
